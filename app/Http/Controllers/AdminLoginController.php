<?php

namespace App\Http\Controllers;

use App\adminlogin;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
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


    public function updateadmin(Request $request, $id)
    {

      $admin=adminlogin::where('id', $id)->first();
      $admin->fullname=$request['fullname'];
      $admin->email=$request['email'];
      $admin->telephone=$request['phone'];
      $admin->save();
      return redirect()->back()->with("success", "User Succefully set as special");

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
     * @param  \App\adminlogin  $adminlogin
     * @return \Illuminate\Http\Response
     */
    public function show(adminlogin $adminlogin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\adminlogin  $adminlogin
     * @return \Illuminate\Http\Response
     */
    public function edit(adminlogin $adminlogin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\adminlogin  $adminlogin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adminlogin $adminlogin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\adminlogin  $adminlogin
     * @return \Illuminate\Http\Response
     */
    public function destroy(adminlogin $adminlogin)
    {
        //
    }
}
