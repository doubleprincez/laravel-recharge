<?php

namespace App\Http\Controllers;

use App\Networkbonus;
use Illuminate\Http\Request;

class NetworkbonusController extends Controller
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
     * @param  \App\Networkbonus  $networkbonus
     * @return \Illuminate\Http\Response
     */
    public function show(Networkbonus $networkbonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Networkbonus  $networkbonus
     * @return \Illuminate\Http\Response
     */
    public function edit(Networkbonus $networkbonus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Networkbonus  $networkbonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Networkbonus $networkbonus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Networkbonus  $networkbonus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Networkbonus $networkbonus)
    {
        //
    }
}
