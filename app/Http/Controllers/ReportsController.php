<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
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



        $labels = $reportDay->pluck('date');
        $data = $reportDay->pluck('total');
        return Inertia::render('Reports/IndexDay',[
            'reportDay' => $reportDay,
            'labels' => $labels,
            'data' => $data,

        ]);
    }
}
