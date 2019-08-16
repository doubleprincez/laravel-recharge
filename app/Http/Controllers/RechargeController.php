<?php

namespace App\Http\Controllers;

use App\Functions\PaymentFunction;
use App\Recharge;
use Illuminate\Http\Request;
use App\Wallet;
use App\user;

class RechargeController extends Controller
{
    use PaymentFunction;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     *
     */

    public function index(Request $request)
    {

        try{
            $type= filter_var(trim($request['recharge_type']),FILTER_SANITIZE_NUMBER_INT);
            $phone = filter_var(trim($request['recharge_phone']),FILTER_SANITIZE_NUMBER_INT);
            $networkID = filter_var(trim($request['recharge_network_id']),FILTER_SANITIZE_NUMBER_INT);
            $amount = filter_var(trim($request['recharge_amount']),FILTER_SANITIZE_NUMBER_INT);
            $special = (int)filter_var(trim($request['special']),FILTER_SANITIZE_NUMBER_INT);

            if($special === 1){
                $get_fee = config('app.payment_fee');
                $set_fee = $this->setPercent($get_fee,$amount);

            }else{
                $set_fee = 0;
            }
            $token = str_random(25);
            $code = 'EN'. $token . substr(strftime("%Y", time()),2);

           $data = array('details' => array(
                'ref'=>$code,
                'account'=>$phone,
                'networkid'=>$networkID,
                'type'=>$type,
                'amount'=>$amount
            ));

            $wallet = Wallet::where('owner_id', '=', auth()->id())->first();

            if ($wallet->wallet_balance > $amount) {

                          $data_response  = json_decode($this->prepareAirvendRequest($data),false);

                          if($data_response->confirmationCode === 200){
              //            save to transaction table
                              $this->saveRechargeTransaction($data_response->details,$set_fee,$phone);
                              return redirect('home')->with([$data_response,['success'=>'Purchase Successful']]);
                          }elseif($data_response->confirmationCode  === 301){
                              return redirect()->back()->with('error','No Admin Credentials Set Yet');
                          }else{
                              return redirect()->back()->with('error',$data_response->details->message);
                          }
            }

            else{
                return redirect()->back()->with('error','insufficient Balance ');
            }



        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage(). ', line: '.$e->getLine());
        }
    }

}
