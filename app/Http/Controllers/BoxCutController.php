<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\BoxCut;
use App\Models\Outlay;
use App\Models\Invoice;
use Illuminate\Http\Request;

class BoxCutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function resume (){

            $sale     = Sale::where('user_id', auth()->user()->id)->whereDay('created_at', '=', date('d'))->sum('total');
            $invoice  = Invoice::where('user_id', auth()->user()->id)->whereDay('created_at', '=', date('d'))->sum('total');
            $outlay   = Outlay::where('user_id', auth()->user()->id)->whereDay('created_at', '=', date('d'))->sum('total');


            $result =[
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

        $boxcut = BoxCut::create([
            'sale' => $request->sale,
            'invoice' => $request->invoice,
            'outlay'    => $request->outlay,
            'cash'  => $request->cash,
            'total'     => $request->total,
            'user_id'  => auth()->user()->id,
        ]);

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
