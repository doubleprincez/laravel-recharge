<?php

namespace App\Http\Controllers;

use App\Functions\PaymentFunction;
use Illuminate\Http\Request;
use App\Wallet;
use App\user;

class CablesController extends Controller
{
    use PaymentFunction;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request)
    {
try {
  $type= filter_var(trim($request['type']),FILTER_SANITIZE_NUMBER_INT);
  $customer_name = filter_var(trim($request['customer_name']));
  $account = filter_var(trim($request['account']));
  $amount = filter_var(trim($request['amount']),FILTER_SANITIZE_NUMBER_INT);
  $special = (int)filter_var(trim($request['special']),FILTER_SANITIZE_NUMBER_INT);
  // Set Fee when user requests have special field
  if($special === 1){
     $get_fee = config('app.payment_fee');
     $set_fee = $this->setPercent($get_fee,$amount);

  }else{
     $set_fee = 0;
  }

  $token = str_random(25);
  $code = 'EN'. $token . substr(strftime("%Y", time()),2);
    $data = array('details' => array(
      'customer_name'=>$customer_name,
      'customer_number'=>str_random(16),
      'account'=>$account,
        'ref'=>$code,
        'amount'=>$amount,
        'type'=>$type,
    ));
$wallet = Wallet::where('owner_id', '=', auth()->id())->first();
if ($wallet->wallet_balance > $amount) {
  $data_response  = json_decode( $this->prepareAirvendRequest($data),false) ;

  if($data_response->confirmationCode === 200){

//            save to transaction table
      $this->saveCableTransaction($data_response->details,$set_fee);

          return redirect('home')->with([$data_response,['success'=>'Purchase Successful']]);
  }elseif($data_response->confirmationCode  === 301){
      return redirect()->back()->with('error','No Admin Credentials Set Yet');
  }elseif ($data_response->confirmationCode === 405){
      return redirect()->back()->with('error','Service unavailable');
  }else{
      return redirect()->back()->with('error',$data_response->details->message);
  }

}

else {
  return redirect()->back()->with('error','insufficient Balance ');

}

}




 catch (\Exception $e) {
   return redirect()->back()->with('error',$e->getMessage(). ', line: '.$e->getLine());


}


    }

}
