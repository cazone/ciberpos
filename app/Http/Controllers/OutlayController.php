<?php

namespace App\Http\Controllers;

use App\Models\Outlay;
use Illuminate\Http\Request;

class OutlayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name_outlay' => 'required',
            'total' => 'required',
        ]);

         $outlay =  Outlay::create([
            'name_outlay' => $request->name_outlay,
            'total' => $request->total,
            'user_id' => auth()->user()->id
        ]);
        return $this->sendResponse(   $outlay, 'Outlay successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outlay  $outlay
     * @return \Illuminate\Http\Response
     */
    public function show(Outlay $outlay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outlay  $outlay
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlay $outlay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlay  $outlay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlay $outlay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outlay  $outlay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlay $outlay)
    {
        //
    }
}
