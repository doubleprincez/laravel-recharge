<?php

namespace App\Http\Controllers;

use App\Websettings;
use Illuminate\Http\Request;

class WebsettingsController extends Controller
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
     * @param  \App\Websettings  $websettings
     * @return \Illuminate\Http\Response
     */
    public function show(Websettings $websettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Websettings  $websettings
     * @return \Illuminate\Http\Response
     */
    public function edit(Websettings $websettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Websettings  $websettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Websettings $websettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Websettings  $websettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Websettings $websettings)
    {
        //
    }
}
