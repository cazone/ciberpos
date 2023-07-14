<?php

namespace App\Http\Controllers;

use App\Imports\BexicaCollectionImport;
use App\Imports\EntregasImport;
use App\Imports\RecepcionImport;
use App\Models\Archivos;
use App\Models\Entrega;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
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
        if (auth()->user()->hasRole('Admin')){
            $invoice  = Invoice::whereMonth('created_at', '=', date('m'));
            $sales    = Sale::with('user')->whereMonth('created_at', '=', date('m'));
            $outlay   = Outlay::with('user')->whereMonth('created_at', '=', date('m'));
            $invoices = InvoiceDetail::with('product', 'user')->whereDay('created_at', '=', date('d'))->orderBy('id', 'desc')->paginate(10);
            $salesRows = $sales->whereDay('created_at', '=', date('d'))->orderBy('created_at', 'desc')->get();
            $salesTotal = $sales->whereDay('created_at', '=', date('d'))->sum('total');
            $invoiceTotal = $invoice->whereDay('created_at', '=', date('d'))->sum('total');
            $outlayTotal = $outlay->whereDay('created_at', '=', date('d'))->sum('total');
            $outlayRows = $outlay->whereDay('created_at', '=', date('d'))->orderBy('created_at', 'desc')->get();

        }else{
        $invoice  = Invoice::whereMonth('created_at', '=', date('m'))->where('user_id', auth()->user()->id);
        $sales    = Sale::with('user')->whereMonth('created_at', '=', date('m'))->where('user_id', auth()->user()->id);
        $outlay   = Outlay::with('user')->whereMonth('created_at', '=', date('m'))->where('user_id', auth()->user()->id);
        $invoices = InvoiceDetail::with('product', 'user')->whereDay('created_at', '=', date('d'))->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        $salesRows = $sales->whereDay('created_at', '=', date('d'))->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $salesTotal = $sales->whereDay('created_at', '=', date('d'))->where('user_id', auth()->user()->id)->sum('total');
        $invoiceTotal = $invoice->whereDay('created_at', '=', date('d'))->where('user_id', auth()->user()->id)->sum('total');
        $outlayTotal = $outlay->whereDay('created_at', '=', date('d'))->where('user_id', auth()->user()->id)->sum('total');
        $outlayRows = $outlay->whereDay('created_at', '=', date('d'))->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

    }

        return Inertia::render('Dashboard',[
            'salesRows' =>  $salesRows ,
            'salesTotal' => $salesTotal,
            'sales' => $sales->sum('total') + $invoice->sum('total'),
            'mes' => date('m'),
            'sales_day' => $sales->whereDay('created_at', '=', date('d'))->sum('total') + $invoice->whereDay('created_at', '=', date('d'))->sum('total'),
            'outlay_day' => $outlay->whereDay('created_at', '=', date('d'))->sum('total') ,
            'outlay' => $outlay->sum('total'),
            'outlayTotal' => $outlayTotal,
            'outlayRows' => $outlayRows,
            'invoices' => $invoices,
            'invoiceTotal' => $invoiceTotal,
        ]);
    }

}
