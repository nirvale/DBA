<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDatacenterRequest;
use App\Http\Requests\UpdateDatacenterRequest;
use App\Models\Datacenter;

class DatacenterController extends Controller
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
     * @param  \App\Http\Requests\StoreDatacenterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDatacenterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Datacenter  $datacenter
     * @return \Illuminate\Http\Response
     */
    public function show(Datacenter $datacenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Datacenter  $datacenter
     * @return \Illuminate\Http\Response
     */
    public function edit(Datacenter $datacenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDatacenterRequest  $request
     * @param  \App\Models\Datacenter  $datacenter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDatacenterRequest $request, Datacenter $datacenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Datacenter  $datacenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Datacenter $datacenter)
    {
        //
    }
}
