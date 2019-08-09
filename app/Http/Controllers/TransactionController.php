<?php

namespace App\Http\Controllers;

use App\AccountDetails;
use App\Cashout;
use App\Transaction;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class TransactionController extends Controller
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
       $transactions = Transaction::where('subscriber_id','=',auth()->id())->get();
         return view('user.transactions')->with(['transactions'=>$transactions]);
    }

    public function cashout_show(){
        $prev = Cashout::where('user_id','=',auth()->id())->get();
        return view('user.cashout')->with(['cashouts'=>$prev]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function cashout_create(Request $request){

        try {
        if(auth()->user()->status===1){
            if(auth()->user()->can_withdraw === 1){
                $this->validate($request,[
                    'bank'=>'required',
                    'account_number'=>'required',
                    'account_type'=>'required'
                ]);
                $bank =trim($request['bank']);
                $account_number = trim($request['account_number']);

                $account_type = trim($request['account_type']);

                if(auth()->user()->wallet->special === 1){
                    $amount =  auth()->user()->wallet_total()+auth()->user()->wallet->special_bonus;
                }else{
                    $amount = auth()->user()->wallet_total();
                }
                // Create New Ref Id
                $ref_id = Uuid::generate();
                // Create new account Details
                $account = $this->updateBankDetails($bank,$account_number,$account_type);

                $this->createCashout($ref_id,$account->id,$amount);

                return redirect()->back()->with([session('success')=>'Cashout Booked Successfully']);

            }else{
                return redirect()->back()->with([session('error')=>'Cannot Cash out now']);
            }

        }else{
            return view('home')->with([session('error')=>'Cashout is blocked, Contact Administrator']);
        }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
//            return ['error'=>$e->getMessage(),'line'=>$e->getLine()];
        }
    }

    /**
     * @param $ref
     * @param $account_id
     * @param $amount
     */
    private function createCashout($ref, $account_id, $amount){
        $cashout = new Cashout();
        $cashout->ref_id  = $ref;
        $cashout->user_id = auth()->id();
        $cashout->account_detail_id = $account_id;
        $cashout->amount = $amount;
        if($cashout->save())
        $this->resetWallet();
        $user = User::find(auth()->id());
        $user->can_withdraw = 0;
        $user->update();
    }


    /**
     * @param $bank
     * @param $number
     * @param $type
     * @return AccountDetails
     */
    private function updateBankDetails($bank, $number, $type){
        $account = AccountDetails::where('user_id','=',auth()->id());
        if($account->count() > 0){
            // update account
            $update = $account->first();
            $update->user_id = auth()->id();
            $update->bank = $bank;
            $update->account_number = $number;
            $update->account_type = $type;
            $update->update();
        }else{
            //create new account
            $update = new AccountDetails();
            $update->user_id = auth()->id();
            $update->bank = $bank;
            $update->account_number = $number;
            $update->account_type = $type;
            $update->save();

        }
        return $update;
    }

    /**
     *
     */
    private function resetWallet(){
        $wallet = Wallet::where('owner_id','=',auth()->id())->firstOrFail();
        $wallet->travelling_bonus = 0.0;
        $wallet->festival_bonus = 0.0;
        $wallet->monthly_bonus = 0.0;
        if(auth()->user()->wallet->special === 1){
            $wallet->special_bonus = 0.0;
        }
        $wallet->update();
    }
}
