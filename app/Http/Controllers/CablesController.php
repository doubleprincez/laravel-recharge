<?php

namespace App\Http\Controllers;

use App\Functions\PaymentFunction;
use Illuminate\Http\Request;

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
        try{
            $this->validate($request,[
                'cable'=> 'required',
                'customer_number'=>'required',
                'amount'=>'required'
            ]);

            $type= filter_var(trim($request['type']),FILTER_SANITIZE_NUMBER_INT);
            $mobile_number = filter_var(trim($request['customer_number']),FILTER_SANITIZE_NUMBER_INT);
            $networkID = filter_var(trim($request['networkID']),FILTER_SANITIZE_NUMBER_INT);
            $amount = filter_var(trim($request['amount']),FILTER_SANITIZE_NUMBER_INT);


            $data = array('details' => array(
                'ref'=>'',
                'account'=>$mobile_number,
                'amount'=>$amount,
                'type'=>$type,
            ));

             $data_response  = json_decode( $this->prepareAirvendRequest($data),false) ;

            if($data_response->confirmationCode === 200){

//            save to transaction table
                $this->saveCableTransaction($data_response['details']);
                return redirect('home')->with([$data_response,['success'=>'Purchase Successful']]);
            }elseif($data_response->confirmationCode  === 301){
                return redirect()->back()->with('error','No Admin Credentials Set Yet');
            }elseif ($data_response->confirmationCode === 405){
                return redirect()->back()->with('error','Service unavailable');
            }else{
                return redirect()->back()->with('error',$data_response->details->message);
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage(). ', line: '.$e->getLine());
        }

    }

}
