<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        return Inertia::render('Pos/Index',[
            'categories' => Category::all(),
            'favorites' => Product::where('favorite','>',0)->get()

        ]);
    }
    public function search(Request $request){
        $request->validate([
            'query' => 'required',
        ]);
        $products = Product::with('category')->where('code',$request->input('query'))
        ->orWhere('barcode',$request->input('query'))
        ->get();
        return response()->json($products);

    }
}
