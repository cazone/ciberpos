<?php

namespace App\Http\Controllers;

use App\Imports\BexicaCollectionImport;
use App\Imports\EntregasImport;
use App\Imports\RecepcionImport;
use App\Models\Archivos;
use App\Models\Entrega;
use App\Models\Invoice;
use App\Models\Outlay;
use App\Models\Prestamo;
use App\Models\Recepcion;
use App\Models\Sale;
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
        $invoice  = Invoice::whereMonth('created_at', '=', date('m'))->where('user_id', auth()->user()->id);
        $sales    = Sale::whereMonth('created_at', '=', date('m'))->where('user_id', auth()->user()->id);
        $outlay   = Outlay::whereMonth('created_at', '=', date('m'))->where('user_id', auth()->user()->id);

        return Inertia::render('Dashboard',[
            'sales' => $sales->sum('total') + $invoice->sum('total'),
            'mes' => date('m'),
            'sales_day' => $sales->whereDay('created_at', '=', date('d'))->sum('total') + $invoice->whereDay('created_at', '=', date('d'))->sum('total'),
            'outlay_day' => $outlay->whereDay('created_at', '=', date('d'))->sum('total') ,
            'outlay' => $outlay->sum('total'),
        ]);
    }

}
