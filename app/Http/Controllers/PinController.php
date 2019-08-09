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
   public function index(Request $request){

       try{
           $type= filter_var(trim($request['pin_type']),FILTER_SANITIZE_NUMBER_INT);
           $networkID = filter_var(trim($request['pin_network_Id']),FILTER_SANITIZE_NUMBER_INT);
           $amount = filter_var(trim($request['pin_amount']),FILTER_SANITIZE_NUMBER_INT);
           $phone = filter_var(trim($request['pin_phone']),FILTER_SANITIZE_NUMBER_INT);

           $data = array('details' => array(
               'ref'=>'',
               'account'=>$phone,
               'networkid'=>$networkID,
               'type'=>$type,
               'amount'=>$amount
           ));

            $data_response  = json_decode( $this->prepareAirvendRequest($data),false);


           if($data_response->confirmationCode === 200){
//            save to transaction table
               $this->savePinTransaction($data_response['details']);
               return redirect('home')->with([$data_response,['success'=>'Purchase Successful']]);
           }elseif($data_response->confirmationCode  === 301){
               return redirect()->back()->with('error','No Admin Credentials Set Yet');
           }else{
               return redirect()->back()->with('error',$data_response->details->message);
           }
       }catch(\Exception $e){
           return redirect()->back()->with('error',$e->getMessage(). ', line: '.$e->getLine());
       }
   }

}
