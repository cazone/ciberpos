<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Shopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Shopping::with('product')
        ->whereDay('created_at', '=', date('d'))
        ->where('user_id',auth()->user()->id)->get();
        return Inertia::render('Shopping/Index',[
            'products'=>$products,


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'price'=>'required',
            'amount'=>'required',
            'percent'=>'required',
            'product_id'=>'required',

        ]);

        try {
            DB::beginTransaction();

            Shopping::create([
                'price'=>$request->price,
                'amount'=>$request->amount,
                'percent'=>$request->percent,
                'product_id'=>$request->product_id,
                'total'=>$request->price * $request->amount,
                'user_id'=>auth()->user()->id,
            ]);

            $product = Product::where('id',$request->product_id)->first();
            $product->quantity = $product->quantity + $request->amount;
            $product->price = ($request->isUpdatePrice) ? $request->total : $product->price;
            $product->save();

            DB::commit();



            return redirect()->back()->with('success','Shopping created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('success',$e->getMessage());
            //throw $th;
        }





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function show(Shopping $shopping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shopping $shopping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shopping $shopping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shopping $shopping)
    {

        try {
            DB::beginTransaction();

            Product::where('id',$shopping->product_id)->update([
                'quantity'=>DB::raw('quantity - '.$shopping->amount),
            ]);

            $shopping->delete();

            DB::commit();
            return redirect()->back()->with('success','Shopping delete successfully');

} catch (\Exception $e) {
    DB::rollback();
    return redirect()->back()->with('success',$e->getMessage());
    //throw $th;
}
    }


}
