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
      return redirect()->back()->with("success", "User Successfully set as special");

    }

}
