<?php

namespace App\Http\Controllers;

use App\Imports\BexicaCollectionImport;
use App\Imports\EntregasImport;
use App\Imports\RecepcionImport;
use App\Models\Archivos;
use App\Models\Entrega;
use App\Models\Invoice;
use App\Models\Prestamo;
use App\Models\Recepcion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use File;

use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $sales  = Invoice::whereMonth('created_at', '=', date('m'));

        return Inertia::render('Dashboard',[
            'sales' => $sales->sum('total'),
            'mes' => date('m'),
            'sales_day' => $sales->whereDay('created_at', '=', date('d'))->sum('total'),
        ]);
    }

}
