<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTipodcRequest;
use App\Http\Requests\UpdateTipodcRequest;
use App\Models\Tipodc;

class TipodcController extends Controller
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
     * @param  \App\Http\Requests\StoreTipodcRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipodcRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipodc  $tipodc
     * @return \Illuminate\Http\Response
     */
    public function show(Tipodc $tipodc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipodc  $tipodc
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipodc $tipodc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipodcRequest  $request
     * @param  \App\Models\Tipodc  $tipodc
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipodcRequest $request, Tipodc $tipodc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipodc  $tipodc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipodc $tipodc)
    {
        //
    }
}
