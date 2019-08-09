<?php

namespace App\Http\Controllers;

use App\Airvend;
use Illuminate\Http\Request;

class AirvendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Airvend  $airvend
     * @return \Illuminate\Http\Response
     */
    public function show(Airvend $airvend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Airvend  $airvend
     * @return \Illuminate\Http\Response
     */
    public function edit(Airvend $airvend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Airvend  $airvend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Airvend $airvend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Airvend  $airvend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Airvend $airvend)
    {
        //
    }
}
