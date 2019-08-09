<?php

namespace App\Http\Controllers;

use App\Functions\ReferralFunction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    use ReferralFunction;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getAccountDetails(Request $request){
        if($request->has('phone')){
            $phone = filter_var(trim($request['phone']),FILTER_SANITIZE_STRING);
            $user_name = User::where('mobile','=',$phone);
            if($user_name->count() > 0){
                if($user_name->first()->verified === 1){
                    $activated = true;
                    return response()->json(['activated'=>$activated]);
                }
                else{
                    $activated = false;
                    return response()->json(['name'=>$user_name->first()->name,'email'=>$user_name->first()->email,'phone'=>$user_name->first()->mobile,'activated'=>$activated]);
                }
            }else{
                return response()->json(['error'=>'Not Found']);
            }

        }
    }
}
