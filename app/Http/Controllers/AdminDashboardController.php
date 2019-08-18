<?php

namespace App\Http\Controllers;

use App\adminlogin;
use App\Cable;
use App\Data;
use App\Otherbonus;
use App\Recharge;
use App\User;
use App\wallet;
use auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;


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
        $users = DB::table('users')
            ->join('wallets', 'wallets.owner_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.mobile', 'users.created_at', 'Users.email', 'users.status', 'users.isAdmin', 'users.gender', 'users.wallet_id', 'wallets.wallet_balance', 'wallets.card_bonus', 'wallets.travelling_bonus', 'wallets.monthly_bonus', 'wallets.festival_bonus', 'wallets.special', 'wallets.special_bonus')
            ->get()->toArray();

        $information = User::with('referrer');

        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {
            return view('admin.dashboard')->with(['info' => $information, 'users' => $users]);
        } else {
            return redirect()->route('home');
        }

    }

    public function add()
    {

        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {
            return view('admin.adminplus');
        } else {
            return redirect()->route('home');
        }


    }

    public function save(Request $request)
    {
        try {
            $wallet_id = Uuid::generate(1)->string;

            $ref_code = md5(Uuid::generate(4)->string);
            $admin = new user();
            $admin->name = trim(strip_tags($request['name']));
            $admin->mobile = trim(strip_tags($request['phone']));
            $admin->email = trim(strip_tags($request['email']));
            $admin->wallet_id = $wallet_id;
            $admin->referral_code = $ref_code;
            $admin->password = Hash::make(trim(strip_tags($request['password'])));
            $admin->isAdmin = 1;
            $admin->verified = 1;
            $admin->save();
            return redirect()->back()->with("success", "User Successfully set as special");

        } catch (\Exception $e) {
            return redirect()->back()->with("error",$e->getMessage());
        }

    }

    public function admins()
    {

        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {
            $admin = adminlogin::all();
            return view('admin.adminaction')->with(['info' => $admin]);
        } else {
            return redirect()->route('home');
        }

    }


    public function adminpassword(Request $request, $id)
    {
        $admin = adminlogin::where('id', $id)->first();
        $admin->password = Hash::make(trim(strip_tags($request['adminpassword'])));
        $admin->save();
        return redirect()->back()->with("success", "User Successfully set as special");
    }

    public function special($id)
    {

        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->special = '1';
        $wallet->save();
        return redirect()->back()->with("success", "User Successfully set as special");

    }


    public function specialunset($id)
    {

        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->special = '0';
        $wallet->save();
        return redirect()->back()->with("success", "User Successfully Unset as special");

    }


    public function updatespecialbonus(Request $request, $id)
    {
        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->specialpcent = trim(strip_tags($request['percent']));
        $wallet->save();
        return redirect()->back()->with("success", "User Bonus Successfully updated");
    }

    public function updatebonus(Request $request, $id)
    {

        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->specialpcent = trim(strip_tags($request['percent']));
        $wallet->save();
        return redirect()->back()->with("success", "User Bonus Successfully updated");
    }


    public function userdestroy($id)
    {
        $user = user::where('id', $id)->first();
        $user->destroy();
        return redirect()->back()->with("success", "User Successfully deleted");
    }

    public function userupdate(Request $request, $id)
    {
        $user = user::where('id', $id)->first();
//        $user = new user();
        $user->name = trim(strip_tags($request['name']));
        $user->mobile = trim(strip_tags($request['phone']));
        $user->email = trim(strip_tags($request['email']));
        $user->password = Hash::make(trim(strip_tags($request['password'])));
        $user->update();
        return redirect()->back()->with("success", "User Successfully Updated");
    }

    public function serve()
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {
            return view('admin.services');
        } else {
            return redirect()->route('home');
        }

    }


    public function resetcard($id)
    {
        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->card_bonus = 0;
        $wallet->save();
        return redirect()->back()->with("success", "Successfully Reset User Card bonus");

    }


    public function updatecard(request $request, $id)
    {
        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->card_bonus = $request['cbonus'];
        $wallet->save();
        return redirect()->back()->with("success", "Successfully Updated User Card bonus");

    }

    public function resetmonthly($id)
    {
        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->monthly_bonus = 0;
        $wallet->save();
        return redirect()->back()->with("success", "Successfully Reset User Monthly bonus");
    }


    public function updatemonthly(Request $request, $id)
    {
        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->monthly_bonus = $request['mbonus'];
        $wallet->save();
        return redirect()->back()->with("success", "Successfully updated User Monthly bonus");
    }

    public function resettravelling($id)
    {
        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->travelling_bonus = 0;
        $wallet->save();
        return redirect()->back()->with("success", "Successfully Reset User Travelling bonus");
    }

    public function updatetravelling(request $request, $id)
    {
        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->travelling_bonus = $request['tbonus'];
        $wallet->save();
        return redirect()->back()->with("success", "Successfully Updated User Travelling bonus");
    }

    public function resetfestival($id)
    {
        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->travelling_bonus = 0;
        $wallet->save();
        return redirect()->back()->with("success", "Successfully Reset User Festival bonus");

    }

    public function updatefestival(Request $request, $id)
    {
        $wallet = wallet::where('owner_id', $id)->first();
        $wallet->travelling_bonus = $request['fbonus'];
        $wallet->save();
        return redirect()->back()->with("success", "Successfully Updated User Festival bonus");

    }


    public function webSettings()
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {
            return view('admin.websettings');
        } else {
            return redirect()->route('home');
        }

    }

    public function usBonus()
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {
            $bonus = Otherbonus::first();
            return view('admin.generalbonus')->with(['bonus' => $bonus]);
        } else {
            return redirect()->route('home');
        }

    }

    public function spcBonus()
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {
            $special = DB::table('users')
                ->join('wallets', 'wallets.owner_id', '=', 'users.id')
                ->select('users.id', 'users.name', 'users.mobile', 'users.created_at', 'Users.email', 'users.status', 'users.gender', 'users.wallet_id', 'wallets.wallet_balance', 'wallets.card_bonus', 'wallets.travelling_bonus', 'wallets.monthly_bonus', 'wallets.festival_bonus', 'wallets.special', 'wallets.special_bonus', 'wallets.specialpcent')
                ->where('wallets.special', 1)
                ->get()->toArray();
            return view('admin.specialbonus')->with(['special' => $special]);
        } else {
            return redirect()->route('home');
        }


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
        $most_purchased = Cable::select('service_type')
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
            ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();
        return view('admin.cable')->with([
            'subscriptions' => $all,
            'most_purchased' => $value,
            'most_purchase_by' => $most_purchase_by
        ]);
    }

    public function dataPurchase()
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {
            return view('admin.data');
        } else {

            return redirect()->route('home');


        }

    }

    public function electric()
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {
            return view('admin.electricity');
        } else {
            return redirect()->route('home');
        }

    }
}
