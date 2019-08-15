<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Cable;
use App\Data;
use App\Recharge;
use App\User;
use App\adminlogin;
use App\wallet;
use DB;


class AdminDashboardController extends Controller
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
      $users=DB::table('users')
      ->join('wallets','wallets.owner_id','=','users.id')
      ->select('users.id','users.name','users.mobile','users.created_at','Users.email','users.status','users.gender','users.wallet_id','wallets.wallet_balance','wallets.card_bonus','wallets.travelling_bonus','wallets.monthly_bonus','wallets.festival_bonus','wallets.special','wallets.special_bonus')
      ->get()->toArray();
      $information = User::with('referrer');
      return view('admin.dashboard')->with(['info' => $information, 'users' => $users]);
    }

    public function add()
    {

        return view('admin.adminplus');
    }

    public function save(Request $request)
    {
      $admin =new adminlogin();
      $admin->fullname=trim(strip_tags($request['name']));
      $admin->telephone=trim(strip_tags($request['phone']));
      $admin->email=trim(strip_tags($request['email']));
      $admin->password=Hash::make(trim(strip_tags($request['password'])));
      $admin->save();
      return redirect()->back()->with("success", "User Succefully set as special");


    }

    public function admins()
    {
      $admin=adminlogin::all();
        return view('admin.adminaction')->with(['info' => $admin]);
    }



    public function adminpassword(Request $request, $id)
    {
      $admin=adminlogin::where('id', $id)->first();
      $admin->password=Hash::make(trim(strip_tags($request['adminpassword'])));
      $admin->save();
      return redirect()->back()->with("success", "User Succefully set as special");
    }

    public function special($id)
    {

      $wallet=wallet::where('owner_id', $id)->first();
      $wallet->special='1';
      $wallet->save();
      return redirect()->back()->with("success", "User Succefully set as special");

    }


    public function specialunset($id)
    {

      $wallet=wallet::where('owner_id', $id)->first();
      $wallet->special='0';
      $wallet->save();
      return redirect()->back()->with("success", "User Succefully Unset as special");

    }





    public function userdestroy($id)
    {
      $user=user::where('id', $id)->first();
      $user->destroy();
      return redirect()->back()->with("success", "User Succefully deleted");
    }

    public function userupdate(Request $request, $id)
    {
      $user=user::where('id', $id)->first();
      $user =new user();
      $user->name=trim(strip_tags($request['name']));
      $user->mobile=trim(strip_tags($request['phone']));
      $user->email=trim(strip_tags($request['email']));
      $user->password=Hash::make(trim(strip_tags($request['password'])));
      $user->update();
      return redirect()->back()->with("success", "User Succefully Updated");
    }

    public function serve(){
      return view('admin.services');
    }


    public function resetcard($id){
      $wallet=wallet::where('owner_id', $id)->first();
      $wallet->card_bonus=0;
      $wallet->save();
      return redirect()->back()->with("success", "Successfully Reseted User Card bonus");

    }




    public function updatecard(request $request, $id){
      $wallet=wallet::where('owner_id', $id)->first();
      $wallet->card_bonus=$request['cbonus'];
      $wallet->save();
      return redirect()->back()->with("success", "Successfully Updated User Card bonus");

    }

    public function resetmonthly($id){
      $wallet=wallet::where('owner_id', $id)->first();
      $wallet->monthly_bonus=0;
      $wallet->save();
      return redirect()->back()->with("success", "Successfully Reseted User Monthly bonus");
    }




    public function updatemonthly(Request $request, $id){
      $wallet=wallet::where('owner_id', $id)->first();
      $wallet->monthly_bonus=$request['mbonus'];
      $wallet->save();
      return redirect()->back()->with("success", "Successfully updated User Monthly bonus");
    }

    public function resettravelling($id){
      $wallet=wallet::where('owner_id', $id)->first();
      $wallet->travelling_bonus=0;
      $wallet->save();
      return redirect()->back()->with("success", "Successfully Reseted User Travelling bonus");
    }

    public function updatetravelling(request $request, $id){
      $wallet=wallet::where('owner_id', $id)->first();
      $wallet->travelling_bonus=$request['tbonus'];
      $wallet->save();
      return redirect()->back()->with("success", "Successfully Updated User Travelling bonus");
    }

  public function resetfestival($id){
    $wallet=wallet::where('owner_id', $id)->first();
    $wallet->travelling_bonus=0;
    $wallet->save();
    return redirect()->back()->with("success", "Successfully Reseted User Festival bonus");

  }

  public function updatefestival(Request $request, $id){
    $wallet=wallet::where('owner_id', $id)->first();
    $wallet->travelling_bonus=$request['fbonus'];
    $wallet->save();
    return redirect()->back()->with("success", "Successfully Updated User Festival bonus");

  }


    public function webSettings()
    {
        return view('admin.websettings');
    }

    public function usBonus()
    {
        return view('admin.generalbonus');
    }

    public function spcBonus()
    {

      $special=DB::table('users')
      ->join('wallets','wallets.owner_id','=','users.id')
      ->select('users.id','users.name','users.mobile','users.created_at','Users.email','users.status','users.gender','users.wallet_id','wallets.wallet_balance','wallets.card_bonus','wallets.travelling_bonus','wallets.monthly_bonus','wallets.festival_bonus','wallets.special','wallets.special_bonus','wallets.specialpcent')
      ->where('wallets.special', 1)
      ->get()->toArray();
        return view('admin.specialbonus')->with(['special' => $special]);
    }

    public function airtime()
    {
        $recharges = Recharge::orderBy('created_at', 'asc')->get();
        $airtimes = Recharge::with('user');
        $mtn = $airtimes->where('network_id', '=', '3');
        $airtel = $airtimes->where('network_id', '=', '1');
        $glo = $airtimes->where('network_id', '=', '2');
        $data = Data::with('user');
        $most_purchased = (int)Recharge::select('network_id')
            ->groupBy('network_id')
            ->orderByRaw('COUNT(*) DESC')
            ->first()->network_id;
        $value = "";
        switch ($most_purchased) {
            case $most_purchased === 1:
                $value = "Airtel";
                break;

            case $most_purchased === 2:
                $value = "MTN";
                break;
            case $most_purchased === 3:

                $value = "Glo";
                break;
            case $most_purchased === 4:
                $value = "9Mobile";
                break;
        }

        $most_purchase_by = User::where('id', '=', Cable::select('user_id')
            ->groupBy('user_id')
            ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

        return view('admin.airtime')->with([
            'airtimes' => $airtimes,
            'mtn' => $mtn,
            'airtel' => $airtel,
            'glo' => $glo,
            'data' => $data,
            'most_purchased' => $value,
            'most_purchase_by' => $most_purchase_by,
            'recharges' => $recharges
        ]);
    }

    public function cable()
    {

        $all = Cable::all();
        $most_purchased =  Cable::select('service_type')
           ->groupBy('service_type')
       ->orderByRaw('COUNT(*) DESC')->first()->service_type;

        $value = "";
        switch ($most_purchased) {
            case (int)$most_purchased === 30:
                $value = "DSTV";
                break;
            case (int)$most_purchased === 40:
                $value = "GOTV";
                break;
            case (int)$most_purchased === 24:
                $value = "Startimes";
                break;
            case (int)$most_purchased === 90:

                $value = "Spectranet";
                break;
            case (int)$most_purchased === 50:
                $value = "Smile Recharge";
                break;
        }
        $most_purchase_by = User::where('id', '=', Cable::select('user_id')
            ->groupBy('user_id')
            ->orderByRaw('COUNT(*) DESC')->first()->user_id )->first();
        return view('admin.cable')->with([
            'subscriptions'=>$all,
            'most_purchased'=>$value,
            'most_purchase_by'=>$most_purchase_by
        ]);
    }

    public function dataPurchase()
    {
        return view('admin.data');
    }

    public function electric()
    {
        return view('admin.electricity');
    }
}
