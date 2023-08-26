<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\BoxCut;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function getDay(){
        $reportDay = InvoiceDetail::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total) as total'))
        ->whereMonth('created_at', '=', date('m'))
        ->groupBy('date')
        ->get();

        $boxCut = BoxCut::select( DB::raw('sum(cash) as total'),DB::raw('DATE(created_at) as date'), DB::raw('sum(outlay) as outlay'),
        DB::raw('sum(invoice) + sum(sale)  as sale'))
        ->whereMonth('created_at', '=', date('m'))
        ->groupBy('date')
        ->get();



        $labels = $boxCut->pluck('date');
        $sale = $boxCut->pluck('sale');
        $outlay = $boxCut->pluck('outlay');

        $data = $boxCut->pluck('total');
        return Inertia::render('Reports/IndexDay',[
            'reportDay' => $boxCut,
            'labels' => $labels,
            'data' => $data,
            'sale'=> $sale,
            'outlay'=> $outlay

        ]);
    }
}
