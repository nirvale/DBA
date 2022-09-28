<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorebackupRequest;
use App\Http\Requests\UpdatebackupRequest;
use App\Models\backup;

class BackupController extends Controller
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
     * @param  \App\Http\Requests\StorebackupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebackupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function show(backup $backup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function edit(backup $backup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebackupRequest  $request
     * @param  \App\Models\backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebackupRequest $request, backup $backup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function destroy(backup $backup)
    {
        //
    }
}
