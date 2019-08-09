<?php

namespace App\Http\Controllers;

use App\Otherbonus;
use Illuminate\Http\Request;

class OtherbonusController extends Controller
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
     * @param  \App\Otherbonus  $otherbonus
     * @return \Illuminate\Http\Response
     */
    public function show(Otherbonus $otherbonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Otherbonus  $otherbonus
     * @return \Illuminate\Http\Response
     */
    public function edit(Otherbonus $otherbonus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Otherbonus  $otherbonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Otherbonus $otherbonus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Otherbonus  $otherbonus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Otherbonus $otherbonus)
    {
        //
    }
}
