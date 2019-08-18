<?php

namespace App\Http\Controllers;

use App\Functions\PaymentFunction;
use Illuminate\Http\Request;

class PinController extends Controller
{
    use PaymentFunction;

   public function __construct()
   {
       $this->middleware('auth');
   }
//   public function index(Request $request){
//
//       try{
//           $type= filter_var(trim($request['pin_type']),FILTER_SANITIZE_NUMBER_INT);
//           $networkID = filter_var(trim($request['pin_network_Id']),FILTER_SANITIZE_NUMBER_INT);
//           $amount = filter_var(trim($request['pin_amount']),FILTER_SANITIZE_NUMBER_INT);
//           $phone = filter_var(trim($request['pin_phone']),FILTER_SANITIZE_NUMBER_INT);
//           $special = (int)filter_var(trim($request['special']),FILTER_SANITIZE_NUMBER_INT);
//           if($special === 1){
//               $get_fee = config('app.payment_fee');
//               $set_fee = $this->setPercent($get_fee,$amount);
//
//           }else{
//               $set_fee = 0;
//           }
//
//           $data = array('details' => array(
//               'ref'=>'',
//               'account'=>$phone,
//               'networkid'=>$networkID,
//               'type'=>$type,
//               'amount'=>$amount
//           ));
//
//            $data_response  = json_decode( $this->prepareAirvendRequest($data),false);
//
//
//           if($data_response->confirmationCode === 200){
////            save to transaction table
//               $this->savePinTransaction($data_response['details'],$set_fee,'pin_bonus');
//               return redirect('home')->with([$data_response,['success'=>'Purchase Successful']]);
//           }elseif($data_response->confirmationCode  === 301){
//               return redirect()->back()->with('error','No Admin Credentials Set Yet');
//           }else{
//               return redirect()->back()->with('error',$data_response->details->message);
//           }
//       }catch(\Exception $e){
//           return redirect()->back()->with('error',$e->getMessage(). ', line: '.$e->getLine());
//       }
//   }

}
