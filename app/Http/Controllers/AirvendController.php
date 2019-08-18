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

}
