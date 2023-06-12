<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        return Inertia::render('Pos/Index',[
     

        ]);
    }
}
