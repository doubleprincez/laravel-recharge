<?php

namespace App\Http\Controllers;

use App\Functions\PaymentFunction;
use App\Wallet;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;



class DataController extends Controller
{
    use PaymentFunction;
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        try{
            $this->validate($request,[
                'type'=> 'required',
                'phone'=>'required',
                'networkID'=>'required',
                'amount'=>'required'
            ]);

            $type= filter_var(trim($request['type']),FILTER_SANITIZE_NUMBER_INT);
            $phone = filter_var(trim($request['phone']),FILTER_SANITIZE_NUMBER_INT);
            $networkID = filter_var(trim($request['networkID']),FILTER_SANITIZE_NUMBER_INT);
            $amount = filter_var(trim($request['amount']),FILTER_SANITIZE_NUMBER_INT);


        $data = array('details' => array(
            'ref'=>'',
            'account'=>$phone,
            'networkid'=>$networkID,
            'type'=>$type,
            'amount'=>$amount
        ));

            $data_response  = json_decode( $this->prepareAirvendRequest($data),false) ;

            if($data_response->confirmationCode === 200){
//            save to transaction table
              $this->saveDataTransaction($data_response['details']);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
