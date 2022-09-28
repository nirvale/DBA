<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOsRequest;
use App\Http\Requests\UpdateOsRequest;
use App\Models\Os;

class OsController extends Controller
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
     * @param  \App\Http\Requests\StoreOsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Os  $os
     * @return \Illuminate\Http\Response
     */
    public function show(Os $os)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Os  $os
     * @return \Illuminate\Http\Response
     */
    public function edit(Os $os)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOsRequest  $request
     * @param  \App\Models\Os  $os
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOsRequest $request, Os $os)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Os  $os
     * @return \Illuminate\Http\Response
     */
    public function destroy(Os $os)
    {
        //
    }
}
