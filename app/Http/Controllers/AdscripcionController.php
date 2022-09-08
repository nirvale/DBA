<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdscripcionRequest;
use App\Http\Requests\UpdateAdscripcionRequest;
use App\Models\Adscripcion;

class AdscripcionController extends Controller
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
     * @param  \App\Http\Requests\StoreAdscripcionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdscripcionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adscripcion  $adscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(Adscripcion $adscripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adscripcion  $adscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Adscripcion $adscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdscripcionRequest  $request
     * @param  \App\Models\Adscripcion  $adscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdscripcionRequest $request, Adscripcion $adscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adscripcion  $adscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adscripcion $adscripcion)
    {
        //
    }
}
