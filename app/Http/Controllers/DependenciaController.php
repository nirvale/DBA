<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDependenciaRequest;
use App\Http\Requests\UpdateDependenciaRequest;
use App\Models\Dependencia;

class DependenciaController extends Controller
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
     * @param  \App\Http\Requests\StoreDependenciaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDependenciaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dependencia  $dependencia
     * @return \Illuminate\Http\Response
     */
    public function show(Dependencia $dependencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dependencia  $dependencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Dependencia $dependencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDependenciaRequest  $request
     * @param  \App\Models\Dependencia  $dependencia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDependenciaRequest $request, Dependencia $dependencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dependencia  $dependencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependencia $dependencia)
    {
        //
    }
}
