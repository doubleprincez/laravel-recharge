<?php

namespace App\Http\Controllers;

use App\Functions\PaymentFunction;
use Illuminate\Http\Request;
use App\Wallet;
use App\user;

class ElectricitiesController extends Controller
{
    use PaymentFunction;

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        try {
            $type = filter_var(trim($request['type']), FILTER_SANITIZE_NUMBER_INT);
            $customer_name = filter_var(trim($request['customer_name']), FILTER_SANITIZE_STRING);
            $customer_type = filter_var(trim($request['customer_type']), FILTER_SANITIZE_STRING);
            $customer_address = filter_var(trim($request['customer_address']), FILTER_SANITIZE_STRING);
            $customer_phone = filter_var(trim($request['customer_phone']), FILTER_DEFAULT);
            $account = filter_var(trim($request['account']), FILTER_DEFAULT);
            $amount = filter_var(trim($request['amount']), FILTER_SANITIZE_NUMBER_INT);
            $special = (int)filter_var(trim($request['special']),FILTER_SANITIZE_NUMBER_INT);

            if($special === 1){
                $get_fee = config('app.payment_fee');
                $set_fee = $this->setPercent($get_fee,$amount);

            }else{
                $set_fee = 0;
            }

            if ($type == '10' || $type == '11' || $type == '15' || $type == '16') {

                // verify account first
                $info = $this->verify($account, $type);

               $marchant_info = json_decode($info, false);

                if ($marchant_info->confirmationCode === 503) {
                    return redirect()->back()->with('error', 'Service Not Available,Try again later');
                }
                elseif ($marchant_info->confirmationCode === 200) {
                        if ($marchant_info->message->customerstatus == 'OPEN') {
                            $customer_number = $marchant_info->message->customername;
                            $data = array('details' => array(
                                'ref:',
                                'type:'.$type,
                                'customername:'.$customer_name,
                                'contacttype:'.$customer_type,
                                'customeraddress:'.$customer_address,
                                'customerphone:'.$customer_phone,
                                'customernumber:'.$customer_number,
                                'account:'.$account,
                                'amount:'.$amount,
                            ));
                            $data_response = json_decode($this->prepareAirvendRequest($data),false);

                            if ($data_response->confirmationCode === 200) {

//            save to transaction table
                                $this->saveCableTransaction($data_response['details'],$set_fee);
                                return redirect('home')->with([$data_response, ['success' => 'Purchase Successful']]);
                            }
                            elseif ($data_response->confirmationCode === 301) {
                                return redirect()->back()->with('error', 'No Admin Credentials Set Yet');
                            }
                            else{
                                return redirect()->back()->with('error', $data_response->confirmationMessage);
                            }
                        }
                        else {
                            return redirect()->back()->with('error', 'Account not active');
                        }
                    } else {
                        return redirect()->back()->with('error', 'Transaction Not Authorized, Contact Admin');
                    }

            }
            else {
                // Check if account status is OPEN and get the customer number
                $data = array('details' => array(
                    'ref' => '',
                    'type' => $type,
                    'customername' => $customer_name,
                    'contacttype' => $customer_type,
                    'customeraddress' => $customer_address,
                    'customerphone' => $customer_phone,
                    'account' => $account,
                    'amount' => $amount,
                ));


              }
              $wallet = Wallet::where('owner_id', '=', auth()->id())->first();
              if ($wallet->wallet_balance > $amount) {
                $data_response = json_decode($this->prepareAirvendRequest($data),false);
                if ($data_response->confirmationCode === 200) {
                    $this->saveCableTransaction($data_response['details']);
                    return redirect('home')->with([$data_response, ['success' => 'Purchase Successful']]);
                }
                elseif ($data_response->confirmationCode === 301) {
                    return redirect()->back()->with('error', 'No Admin Credentials Set Yet');
                }
                else{
                    return redirect()->back()->with('error',$data_response->details->message);
                }
            }
            else{
              return redirect()->back()->with('error','insufficient Balance ');

            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage() . $e->getCode() . ', line: ' . $e->getLine());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $account
     * @param $type
     * @return \Illuminate\Http\Response
     */
    public function verify($account, $type)
    {
        $data = array('details' => array(
            'ref'=>'',
            'type'=>$type,
            'account'=>$account,
        ));
        return $this->prepareVerifyAirvendRequest($data);
    }

}
