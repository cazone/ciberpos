<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
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
            'products' => 'required',
            'discount' => 'required',
            'subtotal' => 'required',
            'total' => 'required',
        ]);



        try {
            DB::beginTransaction();

            $invoice = Invoice::create([
                'discount' => $request->discount,
                'subtotal' => $request->subtotal,
                'total' => $request->total,
                'user_id' => auth()->user()->id
            ]);

            foreach ($request->products as $product) {
                $invoice->invoiceDetails()->create([
                    'price' => $product['price'],
                    'amount' => $product['amount'],
                    'discount' => $product['discount'],
                    'subtotal' => $product['subtotal'],
                    'total' => $product['total'],
                    'product_id' => $product['id'],
                    'user_id' => auth()->user()->id
                ]);
            }

            DB::commit();
            return $this->sendResponse($invoice, 'Fuel Type created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendError($e->getMessage());
            //throw $th;
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
