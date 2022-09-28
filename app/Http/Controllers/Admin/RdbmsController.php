<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRdbmsRequest;
use App\Http\Requests\UpdateRdbmsRequest;
use App\Models\Rdbms;

class RdbmsController extends Controller
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
     * @param  \App\Http\Requests\StoreRdbmsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRdbmsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rdbms  $rdbms
     * @return \Illuminate\Http\Response
     */
    public function show(Rdbms $rdbms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rdbms  $rdbms
     * @return \Illuminate\Http\Response
     */
    public function edit(Rdbms $rdbms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRdbmsRequest  $request
     * @param  \App\Models\Rdbms  $rdbms
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRdbmsRequest $request, Rdbms $rdbms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rdbms  $rdbms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rdbms $rdbms)
    {
        //
    }
}
