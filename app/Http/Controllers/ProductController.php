<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Product/Index',[
            'products'=>Product::paginate(10),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Product/Create',[
                'categories' => Category::all()

        ]);
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
            'name_product'=>'required',
            'price'=>'required',
            'category_id'=>'required',
            'code'=>'required',
            'quantity'=>'required',
            'minimum_qty'=>'required',
            'unit'=>'required',
           
        ]);

        Product::create($request->all());

        return redirect()->route('category.index')->with('success','Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit',[
            'product'=>$product,

  
            

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_product'=>'required',
            'price'=>'required',
            'category_id'=>'required',
            'code'=>'required',
            'quantity'=>'required',
            'minimum_qty'=>'required',
            'unit'=>'required',
           
        ]);

        $product->update($request->all());
       
        return redirect()->route('product.index')->with('success','Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
            $product->delete();
        return redirect()->back()->with(['success'=> 'Producto Eliminado']);
    }
}
