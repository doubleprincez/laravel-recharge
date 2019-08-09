<?php

namespace App\Http\Controllers;

use App\Downlines;
use App\Functions\PaymentFunction;
use App\Functions\ReferralFunction;
use App\Functions\WithdrawFunction;
use App\User;
use Illuminate\Http\Request;

class DownlinesController extends Controller
{
    use ReferralFunction;

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

        $user = User::find(auth()->id());
//        $user->fixTree();
        $descendants = $this->getDescendantsTree($user);
       return view('user.downline')->with(['user'=>$user,'descendants'=>$descendants]);
    }

}
