<?php

namespace App\Http\Controllers;

use App\Databonus;
use Illuminate\Http\Request;

class DatabonusController extends Controller
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
     * @param  \App\Databonus  $databonus
     * @return \Illuminate\Http\Response
     */
    public function show(Databonus $databonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Databonus  $databonus
     * @return \Illuminate\Http\Response
     */
    public function edit(Databonus $databonus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Databonus  $databonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Databonus $databonus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Databonus  $databonus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Databonus $databonus)
    {
        //
    }
}
