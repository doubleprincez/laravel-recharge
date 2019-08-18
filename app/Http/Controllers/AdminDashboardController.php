<?php

namespace App\Http\Controllers;

use App\adminlogin;
use App\Cable;
use App\Data;
use App\Electricity;
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
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $users = DB::table('users')
                ->join('wallets', 'wallets.owner_id', '=', 'users.id')
                ->select('users.id', 'users.name', 'users.mobile', 'users.created_at', 'Users.email', 'users.status', 'users.isAdmin', 'users.gender', 'users.wallet_id', 'wallets.wallet_balance', 'wallets.card_bonus', 'wallets.travelling_bonus', 'wallets.monthly_bonus', 'wallets.festival_bonus', 'wallets.special', 'wallets.special_bonus')
                ->get()->toArray();

            $info_day = User::whereDate('created_at', '=', date('d'));
            $info_month = User::whereMonth('created_at', '=', date('m'));
            $info_year = User::whereYear('created_at', '=', date('Y'));


            if (auth()->user()->isAdmin != 1) {
                return redirect()->route('home');
            } else if (auth()->user()->isAdmin == 1) {
                return view('admin.dashboard')->with(['info_day' => $info_day, 'info_month' => $info_month, 'info_year' => $info_year, 'users' => $users]);
            } else {
                return redirect()->route('home');
            }

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
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

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
                return redirect()->back()->with("error", $e->getMessage());
            }

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
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $admin = adminlogin::where('id', $id)->first();
            $admin->password = Hash::make(trim(strip_tags($request['adminpassword'])));
            $admin->save();
            return redirect()->back()->with("success", "User Successfully set as special");
        }
    }

    public function special($id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->special = '1';
            $wallet->save();
            return redirect()->back()->with("success", "User Successfully set as special");
        }
    }


    public function specialunset($id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->special = '0';
            $wallet->save();
            return redirect()->back()->with("success", "User Successfully Unset as special");
        }
    }

    public function updatespecialbonus(Request $request, $id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->specialpcent = trim(strip_tags($request['percent']));
            $wallet->save();
            return redirect()->back()->with("success", "User Bonus Successfully updated");
        }
    }

    public function updatebonus(Request $request, $id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->specialpcent = trim(strip_tags($request['percent']));
            $wallet->save();
            return redirect()->back()->with("success", "User Bonus Successfully updated");
        }
    }

    public function userdestroy($id)
    {
        $user = user::where('id', $id)->first();
        $user->destroy();
        return redirect()->back()->with("success", "User Successfully deleted");
    }

    public function userupdate(Request $request, $id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $user = user::where('id', $id)->first();
//        $user = new user();
            $user->name = trim(strip_tags($request['name']));
            $user->mobile = trim(strip_tags($request['phone']));
            $user->email = trim(strip_tags($request['email']));
            $user->password = Hash::make(trim(strip_tags($request['password'])));
            $user->update();
            return redirect()->back()->with("success", "User Successfully Updated");
        }
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
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->card_bonus = 0;
            $wallet->save();
            return redirect()->back()->with("success", "Successfully Reset User Card bonus");
        }
    }


    public function updatecard(request $request, $id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->card_bonus = $request['cbonus'];
            $wallet->save();
            return redirect()->back()->with("success", "Successfully Updated User Card bonus");

        }
    }

    public function resetmonthly($id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->monthly_bonus = 0;
            $wallet->save();
            return redirect()->back()->with("success", "Successfully Reset User Monthly bonus");
        }
    }

    public function updatemonthly(Request $request, $id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->monthly_bonus = $request['mbonus'];
            $wallet->save();
            return redirect()->back()->with("success", "Successfully updated User Monthly bonus");
        }
    }

    public function resettravelling($id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->travelling_bonus = 0;
            $wallet->save();
            return redirect()->back()->with("success", "Successfully Reset User Travelling bonus");
        }
    }

    public function updatetravelling(request $request, $id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->travelling_bonus = $request['tbonus'];
            $wallet->save();
            return redirect()->back()->with("success", "Successfully Updated User Travelling bonus");
        }
    }

    public function resetfestival($id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->travelling_bonus = 0;
            $wallet->save();
            return redirect()->back()->with("success", "Successfully Reset User Festival bonus");

        }
    }

    public function updatefestival(Request $request, $id)
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $wallet = wallet::where('owner_id', $id)->first();
            $wallet->travelling_bonus = $request['fbonus'];
            $wallet->save();
            return redirect()->back()->with("success", "Successfully Updated User Festival bonus");

        }
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

            $information = User::with('referrer');

            return view('admin.specialbonus')->with(['info' => $information, 'special' => $special]);
        } else {
            return redirect()->route('home');
        }


    }

    public function airtime()
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $recharges = Recharge::all();

            $airtimes_day = Recharge::whereDate('created_at', '=', date('d'));
            $airtimes_month = Recharge::whereMonth('created_at', '=', date('m'));
            $airtimes_year = Recharge::whereYear('created_at', '=', date('Y'));
            $mtn_day = $airtimes_day->where('network_id', '=', '3');
            $mtn_month = $airtimes_month->where('network_id', '=', '3');
            $mtn_year = $airtimes_year->where('network_id', '=', '3');

            $airtel_day = $airtimes_day->where('network_id', '=', '1');
            $airtel_month = $airtimes_month->where('network_id', '=', '1');
            $airtel_year = $airtimes_year->where('network_id', '=', '1');

            $glo_day = $airtimes_day->where('network_id', '=', '2');
            $glo_month = $airtimes_year->where('network_id', '=', '2');
            $glo_year = $airtimes_year->where('network_id', '=', '2');

            if (Recharge::count() > 0) {
                $most_purchased_day = (int)Recharge::select('network_id')->whereDate('created_at', '=', date('d'))
                    ->groupBy('network_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()->network_id;

                $most_purchased_month = (int)Recharge::select('network_id')->whereMonth('created_at', '=', date('m'))
                    ->groupBy('network_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()->network_id;
                $most_purchased_year = (int)Recharge::select('network_id')->whereYear('created_at', '=', date('Y'))
                    ->groupBy('network_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()->network_id;


                $value_day = "";
                switch ($most_purchased_day) {
                    case $most_purchased_day === 1:
                        $value_day = "Airtel";
                        break;

                    case $most_purchased_day === 2:
                        $value_day = "MTN";
                        break;
                    case $most_purchased_day === 3:

                        $value_day = "Glo";
                        break;
                    case $most_purchased_day === 4:
                        $value_day = "9Mobile";
                        break;
                }

                $value_month = "";
                switch ($most_purchased_month) {
                    case $most_purchased_month === 1:
                        $value_month = "Airtel";
                        break;

                    case $most_purchased_month === 2:
                        $value_month = "MTN";
                        break;
                    case $most_purchased_month === 3:

                        $value_month = "Glo";
                        break;
                    case $most_purchased_month === 4:
                        $value_month = "9Mobile";
                        break;
                }

                $value_year = "";
                switch ($most_purchased_year) {
                    case $most_purchased_year === 1:
                        $value_year = "Airtel";
                        break;

                    case $most_purchased_year === 2:
                        $value_year = "MTN";
                        break;
                    case $most_purchased_year === 3:

                        $value_year = "Glo";
                        break;
                    case $most_purchased_year === 4:
                        $value_year = "9Mobile";
                        break;
                }


                $most_purchase_by_day = User::where('id', '=', Cable::select('user_id')
                    ->whereDate('created_at', '=', date('d'))->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

                $most_purchase_by_month = User::where('id', '=', Cable::select('user_id')
                    ->whereMonth('created_at', '=', date('m'))->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

                $most_purchase_by_year = User::where('id', '=', Cable::select('user_id')
                    ->whereYear('created_at', '=', date('Y'))->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

            } else {
                $value_day = null;
                $value_month = null;
                $value_year = null;
                $most_purchase_by_day = null;
                $most_purchase_by_month = null;
                $most_purchase_by_year = null;
            }

            return view('admin.airtime')->with([
                'airtimes_day' => $airtimes_day,
                'airtimes_month' => $airtimes_month,
                'airtimes_year' => $airtimes_year,
                'mtn_day' => $mtn_day,
                'mtn_month' => $mtn_month,
                'mtn_year' => $mtn_year,
                'airtel_day' => $airtel_day,
                'airtel_month' => $airtel_month,
                'airtel_year' => $airtel_year,
                'glo_day' => $glo_day,
                'glo_month' => $glo_month,
                'glo_year' => $glo_year,
                'most_purchased_day' => $value_day,
                'most_purchased_month' => $value_month,
                'most_purchased_year' => $value_year,
                'most_purchase_by_day' => $most_purchase_by_day,
                'most_purchase_by_month' => $most_purchase_by_month,
                'most_purchase_by_year' => $most_purchase_by_year,
                'recharges' => $recharges
            ]);
        }
    }

    public function cable()
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $all = Cable::all();

            $dstv_day = Cable::where('service_type', '=', 30)->whereDate('created_at', '=', date('d'));
            $dstv_month = Cable::where('service_type', '=', 30)->whereMonth('created_at', '=', date('m'));
            $dstv_year = Cable::where('service_type', '=', 30)->whereYear('created_at', '=', date('Y'));

            $gotv_day = Cable::where('service_type', '=', 40)->whereDate('created_at', '=', date('d'));
            $gotv_month = Cable::where('service_type', '=', 40)->whereMonth('created_at', '=', date('m'));
            $gotv_year = Cable::where('service_type', '=', 40)->whereYear('created_at', '=', date('Y'));

            if (Cable::count() > 0) {
                $most_purchased_day = Cable::select('service_type')->whereDate('created_at', '=', date('d'))
                    ->groupBy('service_type')
                    ->orderByRaw('COUNT(*) DESC')->first()->service_type;

                $most_purchased_month = Cable::select('service_type')->whereMonth('created_at', '=', date('m'))
                    ->groupBy('service_type')
                    ->orderByRaw('COUNT(*) DESC')->first()->service_type;

                $most_purchased_year = Cable::select('service_type')->whereYear('created_at', '=', date('Y'))
                    ->groupBy('service_type')
                    ->orderByRaw('COUNT(*) DESC')->first()->service_type;

                $value_day = "";
                switch ($most_purchased_day) {
                    case (int)$most_purchased_day === 30:
                        $value_day = "DSTV";
                        break;
                    case (int)$most_purchased_day === 40:
                        $value_day = "GOTV";
                        break;
                    case (int)$most_purchased_day === 24:
                        $value_day = "Startimes";
                        break;
                    case (int)$most_purchased_day === 90:

                        $value_day = "Spectranet";
                        break;
                    case (int)$most_purchased_day === 50:
                        $value_day = "Smile Recharge";
                        break;
                }

                $value_month = "";
                switch ($most_purchased_month) {
                    case (int)$most_purchased_month === 30:
                        $value_month = "DSTV";
                        break;
                    case (int)$most_purchased_month === 40:
                        $value_month = "GOTV";
                        break;
                    case (int)$most_purchased_month === 24:
                        $value_month = "Startimes";
                        break;
                    case (int)$most_purchased_month === 90:

                        $value_month = "Spectranet";
                        break;
                    case (int)$most_purchased_month === 50:
                        $value_month = "Smile Recharge";
                        break;
                }

                $value_year = "";
                switch ($most_purchased_year) {
                    case (int)$most_purchased_year === 30:
                        $value_year = "DSTV";
                        break;
                    case (int)$most_purchased_year === 40:
                        $value_year = "GOTV";
                        break;
                    case (int)$most_purchased_year === 24:
                        $value_year = "Startimes";
                        break;
                    case (int)$most_purchased_year === 90:

                        $value_year = "Spectranet";
                        break;
                    case (int)$most_purchased_year === 50:
                        $value_year = "Smile Recharge";
                        break;
                }

                $most_purchase_by_day = User::where('id', '=', Cable::select('user_id')->whereDate('created_at', '=', date('d'))
                    ->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

                $most_purchase_by_month = User::where('id', '=', Cable::select('user_id')->whereMonth('created_at', '=', date('m'))
                    ->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

                $most_purchase_by_year = User::where('id', '=', Cable::select('user_id')->whereYear('created_at', '=', date('Y'))
                    ->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

            } else {
                $value_day = null;
                $value_month = null;
                $value_year = null;
                $most_purchase_by_day = null;
                $most_purchase_by_month = null;
                $most_purchase_by_year = null;
            }
            return view('admin.cable')->with([
                'subscriptions' => $all,
                'dstv_day' => $dstv_day,
                'dstv_month' => $dstv_month,
                'dstv_year' => $dstv_year,
                'gotv_day' => $gotv_day,
                'gotv_month' => $gotv_month,
                'gotv_year' => $gotv_year,
                'most_purchased_day' => $value_day,
                'most_purchased_month' => $value_month,
                'most_purchased_year' => $value_year,
                'most_purchase_by_day' => $most_purchase_by_day,
                'most_purchase_by_month' => $most_purchase_by_month,
                'most_purchase_by_year' => $most_purchase_by_year
            ]);
        }
    }

    public function dataPurchase()
    {
        if (auth()->user()->isAdmin != 1) {

            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $data = Data::all();

            $data_day = Data::whereDate('created_at', '=', date('d'));
            $data_month = Data::whereMonth('created_at', '=', date('m'));
            $data_year = Data::whereYear('created_at', '=', date('Y'));
            $mtn_day = $data_day->where('network_id', '=', '3');
            $mtn_month = $data_month->where('network_id', '=', '3');
            $mtn_year = $data_year->where('network_id', '=', '3');

            $airtel_day = $data_day->where('network_id', '=', '1');
            $airtel_month = $data_month->where('network_id', '=', '1');
            $airtel_year = $data_year->where('network_id', '=', '1');

            $glo_day = $data_day->where('network_id', '=', '2');
            $glo_month = $data_year->where('network_id', '=', '2');
            $glo_year = $data_year->where('network_id', '=', '2');


            if (Data::count() > 0) {
                $most_purchased_day = (int)Data::select('network_id')->whereDate('created_at', '=', date('d'))
                    ->groupBy('network_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()->network_id;

                $most_purchased_month = (int)Data::select('network_id')->whereMonth('created_at', '=', date('m'))
                    ->groupBy('network_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()->network_id;
                $most_purchased_year = (int)Data::select('network_id')->whereYear('created_at', '=', date('Y'))
                    ->groupBy('network_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()->network_id;
                $value_day = "";
                switch ($most_purchased_day) {
                    case $most_purchased_day === 1:
                        $value_day = "Airtel";
                        break;

                    case $most_purchased_day === 2:
                        $value_day = "MTN";
                        break;
                    case $most_purchased_day === 3:

                        $value_day = "Glo";
                        break;
                    case $most_purchased_day === 4:
                        $value_day = "9Mobile";
                        break;
                }

                $value_month = "";
                switch ($most_purchased_month) {
                    case $most_purchased_month === 1:
                        $value_month = "Airtel";
                        break;

                    case $most_purchased_month === 2:
                        $value_month = "MTN";
                        break;
                    case $most_purchased_month === 3:

                        $value_month = "Glo";
                        break;
                    case $most_purchased_month === 4:
                        $value_month = "9Mobile";
                        break;
                }

                $value_year = "";
                switch ($most_purchased_year) {
                    case $most_purchased_year === 1:
                        $value_year = "Airtel";
                        break;

                    case $most_purchased_year === 2:
                        $value_year = "MTN";
                        break;
                    case $most_purchased_year === 3:

                        $value_year = "Glo";
                        break;
                    case $most_purchased_year === 4:
                        $value_year = "9Mobile";
                        break;
                }


                $most_purchase_by_day = User::where('id', '=', Cable::select('user_id')
                    ->whereDate('created_at', '=', date('d'))->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

                $most_purchase_by_month = User::where('id', '=', Cable::select('user_id')
                    ->whereMonth('created_at', '=', date('m'))->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

                $most_purchase_by_year = User::where('id', '=', Cable::select('user_id')
                    ->whereYear('created_at', '=', date('Y'))->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

            } else {
                $value_day = null;
                $value_month = null;
                $value_year = null;
                $most_purchase_by_day = null;
                $most_purchase_by_month = null;
                $most_purchase_by_year = null;
            }

            return view('admin.data')->with([
                'data_day' => $data_day,
                'data_month' => $data_month,
                'data_year' => $data_year,
                'mtn_day' => $mtn_day,
                'mtn_month' => $mtn_month,
                'mtn_year' => $mtn_year,
                'airtel_day' => $airtel_day,
                'airtel_month' => $airtel_month,
                'airtel_year' => $airtel_year,
                'glo_day' => $glo_day,
                'glo_month' => $glo_month,
                'glo_year' => $glo_year,
                'data' => $data,
                'most_purchased_day' => $value_day,
                'most_purchased_month' => $value_month,
                'most_purchased_year' => $value_year,
                'most_purchase_by_day' => $most_purchase_by_day,
                'most_purchase_by_month' => $most_purchase_by_month,
                'most_purchase_by_year' => $most_purchase_by_year
            ]);

        } else {

            return redirect()->route('home');


        }

    }

    public function electric()
    {
        if (auth()->user()->isAdmin != 1) {
            return redirect()->route('home');
        } else if (auth()->user()->isAdmin == 1) {

            $electricity = Electricity::with('user');

            $electricity_day = Electricity::whereDate('created_at', '=', date('d'));
            $electricity_month= Electricity::whereMonth('created_at', '=', date('m'));
            $electricity_year = Electricity::whereYear('created_at', '=', date('Y'));
            $ikeja_day = $electricity_day->where('service_type', '=', '10')->orWhere('service_type','=','11');
            $ikeja_month = $electricity_month->where('service_type', '=', '10')->orWhere('service_type','=','11');
            $ikeja_year = $electricity_year->where('service_type', '=', '10')->orWhere('service_type','=','11');

            $ibadan_day = $electricity_day->where('service_type', '=', '12');
            $ibadan_month = $electricity_month->where('service_type', '=', '12');
            $ibadan_year = $electricity_year->where('service_type', '=', '12');

            $eko_day = $electricity_day->where('service_type', '=', '13')->orWhere('service_type','=','14');
            $eko_month = $electricity_month->where('service_type', '=', '13')->orWhere('service_type','=','14');
            $eko_year = $electricity_year->where('service_type', '=', '13')->orWhere('service_type','=','14');

            $port_day = $electricity_day->where('service_type', '=', '15')->orWhere('service_type','=','16');
            $port_month = $electricity_month->where('service_type', '=', '15')->orWhere('service_type','=','16');
            $port_year = $electricity_year->where('service_type', '=', '15')->orWhere('service_type','=','16');

            $enugu_day = $electricity_day->where('service_type', '=', '21')->orWhere('service_type','=','22');
            $enugu_month = $electricity_month->where('service_type', '=', '21')->orWhere('service_type','=','22');
            $enugu_year = $electricity_year->where('service_type', '=', '21')->orWhere('service_type','=','22');

            $abuja_day = $electricity_day->where('service_type', '=', '24');
            $abuja_month = $electricity_month->where('service_type', '=', '24');
            $abuja_year = $electricity_year->where('service_type', '=', '24');

            if (Electricity::count() > 0) {
                $most_purchased_day = (int)Electricity::select('service_type')->whereDate('created_at', '=', date('d'))
                    ->groupBy('service_type')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()->network_id;

                $most_purchased_month = (int)Electricity::select('service_type')->whereMonth('created_at', '=', date('m'))
                    ->groupBy('network_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()->network_id;

                $most_purchased_year = (int)Electricity::select('service_type')->whereYear('created_at', '=', date('Y'))
                    ->groupBy('network_id')
                    ->orderByRaw('COUNT(*) DESC')
                    ->first()->network_id;


                $value_day = "";

                switch ($most_purchased_day) {
                    case $most_purchased_day === 10:
                        $value_day = "Ikeja Postpaid";
                        break;
                    case $most_purchased_day === 11:
                        $value_day = "Ikeja Prepaid";
                        break;
                    case $most_purchased_day === 12:
                        $value_day = "Ibadan Prepaid";
                        break;
                    case $most_purchased_day === 13:
                        $value_day = "Eko Postpaid";
                        break;
                    case $most_purchased_day === 14:
                        $value_day = "Eko Prepaid";
                        break;
                    case $most_purchased_day === 15:
                        $value_day = "Portharcourt Postpaid";
                        break;
                    case $most_purchased_day === 16:
                        $value_day = "Portharcourt Prepaid";
                        break;
                    case $most_purchased_day === 21:
                        $value_day = "Enugu Postpaid";
                        break;
                    case $most_purchased_day === 22:
                        $value_day = "Enugu Prepaid";
                        break;
                    case $most_purchased_day === 24:
                        $value_day = "Abuja Prepaid";
                        break;


                }

                $value_month = "";
                switch ($most_purchased_month) {
                    case $most_purchased_month === 10:
                        $value_month = "Ikeja Postpaid";
                        break;
                    case $most_purchased_month === 11:
                        $value_month = "Ikeja Prepaid";
                        break;
                    case $most_purchased_month === 12:
                        $value_month = "Ibadan Prepaid";
                        break;
                    case $most_purchased_month === 13:
                        $value_month = "Eko Postpaid";
                        break;
                    case $most_purchased_month === 14:
                        $value_month = "Eko Prepaid";
                        break;
                    case $most_purchased_month === 15:
                        $value_month = "Portharcourt Postpaid";
                        break;
                    case $most_purchased_month === 16:
                        $value_month = "Portharcourt Prepaid";
                        break;
                    case $most_purchased_month === 21:
                        $value_month = "Enugu Postpaid";
                        break;
                    case $most_purchased_month === 22:
                        $value_month = "Enugu Prepaid";
                        break;
                    case $most_purchased_month === 24:
                        $value_month = "Abuja Prepaid";
                        break;
                }

                $value_year = "";
                switch ($most_purchased_year) {
                    case $most_purchased_year === 10:
                        $value_year = "Ikeja Postpaid";
                        break;
                    case $most_purchased_year === 11:
                        $value_year = "Ikeja Prepaid";
                        break;
                    case $most_purchased_year === 12:
                        $value_year = "Ibadan Prepaid";
                        break;
                    case $most_purchased_year === 13:
                        $value_year = "Eko Postpaid";
                        break;
                    case $most_purchased_year === 14:
                        $value_year = "Eko Prepaid";
                        break;
                    case $most_purchased_year === 15:
                        $value_year = "Portharcourt Postpaid";
                        break;
                    case $most_purchased_year === 16:
                        $value_year = "Portharcourt Prepaid";
                        break;
                    case $most_purchased_year === 21:
                        $value_year = "Enugu Postpaid";
                        break;
                    case $most_purchased_year === 22:
                        $value_year = "Enugu Prepaid";
                        break;
                    case $most_purchased_year === 24:
                        $value_year = "Abuja Prepaid";
                        break;
                }


                $most_purchase_by_day = User::where('id', '=', Electricity::select('user_id') ->whereDate('created_at', '=', date('d'))->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

                $most_purchase_by_month = User::where('id', '=', Electricity::select('user_id')
                    ->whereMonth('created_at', '=', date('m'))->groupBy('user_id')
                    ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

                $most_purchase_by_year = User::where('id', '=', Electricity::select('user_id')
                    ->whereYear('created_at', '=', date('Y'))->groupBy('user_id')  ->orderByRaw('COUNT(*) DESC')->first()->user_id)->first();

            } else {
                $value_day = null;
                $value_month = null;
                $value_year = null;
                $most_purchase_by_day = null;
                $most_purchase_by_month = null;
                $most_purchase_by_year = null;
            }

            return view('admin.electricity')->with([
                'electricity'=>$electricity->get(),
                'electricity_day'=>$electricity_day,
                'electricity_month'=>$electricity_month,
                'electricity_year'=>$electricity_year,
                'ikeja_day'=>$ikeja_day,
                'ikeja_month'=>$ikeja_month,
                'ikeja_year'=>$ikeja_year,
                'ibadan_day'=>$ibadan_day,
                'ibadan_month'=>$ibadan_month,
                'ibadan_year'=>$ibadan_year,
                'eko_day'=>$eko_day,
                'eko_month'=>$eko_month,
                'eko_year'=>$eko_year,
                'port_day'=>$port_day,
                'port_month'=>$port_month,
                'port_year'=>$port_year,
                'enugu_day'=>$enugu_day,
                'enugu_month'=>$enugu_month,
                'enugu_year'=>$enugu_year,
                'abuja_day'=>$abuja_day,
                'abuja_month'=>$abuja_month,
                'abuja_year'=>$abuja_year,
                'most_purchase_day'=>$value_day,
                'most_purchase_month'=>$value_month,
                'most_purchase_year'=>$value_year,
                'most_purchase_by_day'=>$most_purchase_by_day,
                'most_purchase_by_month'=>$most_purchase_by_month,
                'most_purchase_by_year'=>$most_purchase_by_year
            ]);
        } else {
            return redirect()->route('home');
        }

    }
}
