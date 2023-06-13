<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        return Inertia::render('Pos/Index',[


        ]);
    }
    public function search(Request $request){
        $request->validate([
            'query' => 'required',
        ]);
        $products = Product::where('code',$request->input('query'))
        ->orWhere('barcode',$request->input('query'))
        ->get();
        return response()->json($products);

    }
}
