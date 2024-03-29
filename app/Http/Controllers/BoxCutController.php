<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\BoxCut;
use App\Models\Outlay;
use App\Models\Invoice;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use App\Traits\TelegramServices;
use Illuminate\Support\Facades\DB;

class BoxCutController extends Controller
{
    use TelegramServices;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxCut = BoxCut::with('user')->select('id', DB::raw('sum(cash) as cash'),DB::raw('sum(sale) as sale'),
        DB::raw('sum(outlay) as outlay'), DB::raw('sum(invoice) as invoice'),'created_at', 'user_id')
        ->groupBy('created_at', 'id', 'user_id')->orderBy('created_at', 'desc')->get();

        return $this->sendResponse($boxCut, 'BoxCut successfully.');


    }

    public function sendWhatsapp($message)
    {
        $user = ['150327013', '6071627574'];
        foreach ($user as $key => $value) {
            $this->makeRequest('GET', '/sendMessage', [
                'chat_id' => $value,
                'text' => $message,
                'parse_mode' => 'html'
            ]);
        }

        // dd();

        //             $twilio = new Client('AC0bc253ba36563231d08d3ecf1c52d534', 'de480c3dc19e9704550050479956c736');
        //             $user = ['+525585493795', '+525530202888'
        //         ];
        //         foreach ($user as $key => $value) {
        //             $twilio->messages
        //                                     ->create("whatsapp:".$value, // to
        //                                        [
        //                                            "from" => "whatsapp:+12542683908",
        //                                            "body" =>  $message
        //                                        ]
        //                               );

        //                             }

    }
    public function resume()
    {

        $sale     = Sale::where('user_id', auth()->user()->id)
            ->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->sum('total');
        $invoice  = Invoice::where('user_id', auth()->user()->id)
            ->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->sum('total');
        $outlay   = Outlay::where('user_id', auth()->user()->id)
            ->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->sum('total');



        $result = [
            'invoice'   => $invoice,
            'outlay' => $outlay,
            'sale'   => $sale,
            'total'  => $sale + $invoice - $outlay

        ];

        return $this->sendResponse($result, 'Resumen successfully.');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cash' => 'required',

        ]);

        $boxcutByUser = BoxCut::where('user_id', '=', auth()->user()->id)
            ->whereMonth('created_at', '=', date('m'))
            ->whereDay('created_at', '=', date('d'))->get();


        if ($boxcutByUser->count() == 0) {
            $boxcut = BoxCut::create([
                'sale' => $request->sale,
                'invoice' => $request->invoice,
                'outlay'    => $request->outlay,
                'cash'  => $request->cash,
                'total'     => $request->total,
                'user_id'  => auth()->user()->id,
            ]);
        } else {
            $boxcut =   $boxcutByUser->first()->update([
                'sale' => $request->sale,
                'invoice' => $request->invoice,
                'outlay'    => $request->outlay,
                'cash'  => $request->cash,
                'total'     => $request->total,
                'user_id'  => auth()->user()->id,
            ]);
        }




        $copiasTotal = InvoiceDetail::with('product', 'product.category')
            ->whereHas('product.category', function ($query) {
                return $query->where('name', '=', 'Copias');
            })

            ->where('user_id', auth()->user()->id)->whereDay('created_at', '=', date('d'))->sum('total');

        $user = auth()->user()->name;
        $total = $request->sale + $request->invoice   - $request->outlay;
        $text = sprintf(
            "Hola, este es el corte de %s \n Día: %s \n Venta POS: $%s \n Venta directa: $%s \n Gastos : $%s \n Copias : $%s \n Total : $%s \n Total  Efectivo: $%s",
            $user,
            date('d/m/Y'),
            $request->invoice,
            $request->sale,
            $request->outlay,
            $copiasTotal,
            $total - $copiasTotal,
            $request->cash
        );
        $this->sendWhatsapp($text);

        return $this->sendResponse($boxcut, 'BoxCut successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoxCut  $boxCut
     * @return \Illuminate\Http\Response
     */
    public function show(BoxCut $boxCut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoxCut  $boxCut
     * @return \Illuminate\Http\Response
     */
    public function edit(BoxCut $boxCut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BoxCut  $boxCut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoxCut $boxCut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoxCut  $boxCut
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoxCut $boxCut)
    {
        //
    }
}
