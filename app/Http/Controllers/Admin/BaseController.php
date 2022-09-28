<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBaseRequest;
use App\Http\Requests\UpdateBaseRequest;
use App\Models\Base;

class BaseController extends Controller
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
     * @param  \App\Http\Requests\StoreBaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBaseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Base  $base
     * @return \Illuminate\Http\Response
     */
    public function show(Base $base)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Base  $base
     * @return \Illuminate\Http\Response
     */
    public function edit(Base $base)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBaseRequest  $request
     * @param  \App\Models\Base  $base
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBaseRequest $request, Base $base)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Base  $base
     * @return \Illuminate\Http\Response
     */
    public function destroy(Base $base)
    {
        //
    }
}
