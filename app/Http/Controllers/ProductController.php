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

        $products = Product::query()
        ->with('category')
        ->filter(request()->only("search"))
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return Inertia::render('Product/Index',[
            'products'=>$products ,

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
                'categories' => Category::all(),
                'clave' => Product::all()->last()->id + 1,


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
            'code'=>['required', 'unique:products'],
            'quantity'=>'required',
            'minimum_qty'=>'required',
            'unit'=>'required',
            'barcode'=>['required', 'unique:products'],


        ]);

        Product::create($request->all());

        return redirect()->route('product.index')->with('success','Producto creado correctamente');
    }


    public function search(Request $request){

        $products = Product::with('category')->where('name_product','LIKE','%'.$request->search.'%')
        ->orWhere('code','LIKE','%'.$request->search.'%')
        ->orWhere('barcode','LIKE','%'.$request->search.'%')
        ->limit(10)->get();
        return $this->sendResponse($products, 'Search successfully.');


    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show( $product)
    {

        $products = Product::with('category')
        ->where('code',$product)
        ->orWhere('barcode',$product)->first();
        return $this->sendResponse($products , 'Search successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $productd
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit',[
            'product'=>$product,
            'categories' => Category::all()




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
