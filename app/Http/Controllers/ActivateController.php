<?php

namespace App\Http\Controllers;

use App\Functions\ActivationFunction;

class ActivateController extends Controller
{
    use ActivationFunction;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Check if User is verified
        if (auth()->user()->verified !== 1) {
            if ($this->checkActivation()=== false) {
                $payments = $this->getPayments();
                // check if user is paying by installment
                if ($payments->count() > 0) {
                    // Check if user has done any payment before ie fresh registration
                        // get all installments and send array else get one time payment amount
                         $trans = $this->getAllInstallments();
                            return view('user.activate')->with(['prev_transactions' => $trans]);
                }else{
                    return view('user.activate');
                }


            } else {
                return view('home')->with([session('success') => 'Account is Activated']);
            }

        } else {
            return view('home')->with([session('success') => 'Account is Activated']);
        }
    }

    public function confirm()
    {
        return view('user.callback');
    }
}
