<?php

namespace App\Http\Controllers;

use App\Functions\PaymentFunction;
use App\Wallet;
use Illuminate\Http\Request;


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

        try {
            if (auth()->user()->status === 1) {
                if (auth()->user()->verified === 1) {
                    $this->validate($request, [
                        'type' => 'required',
                        'phone' => 'required',
                        'networkID' => 'required',
                        'amount' => 'required'
                    ]);
                    $type = filter_var(trim($request->type), FILTER_SANITIZE_NUMBER_INT);
                    $phone = filter_var(trim($request->phone), FILTER_SANITIZE_NUMBER_INT);
                    $networkID = filter_var(trim($request->networkID), FILTER_SANITIZE_NUMBER_INT);
                    $amount = filter_var(trim($request->amount), FILTER_SANITIZE_NUMBER_INT);
                    $special = (int)filter_var(trim($request->special), FILTER_SANITIZE_NUMBER_INT);

                    if ($special === 1) {
                        $get_fee = config('app.payment_fee');
                        $set_fee = $this->setPercent($get_fee, $amount);

                    } else {
                        $set_fee = 0;
                    }
                    $token = str_random(25);
                    $code = 'EN' . $token . substr(strftime("%Y", time()), 2);


                    $data = array('details' => array(
                        'ref' => $code,
                        'account' => $phone,
                        'networkid' => $networkID,
                        'type' => $type,
                        'amount' => $amount
                    ));
                    $wallet = Wallet::where('owner_id', '=', auth()->id())->first();

                    if ($wallet->wallet_balance > $amount) {
                        $data_response = json_decode($this->prepareAirvendRequest($data), false);
                        if ($data_response->confirmationCode === 200) {

//            save to transaction table
                            $this->saveDataTransaction($data_response->details, $set_fee, 'data_bonus');
                            return redirect('home')->with([$data_response, ['success' => 'Purchase Successful']]);
                        } elseif ($data_response->confirmationCode === 301) {
                            return redirect()->back()->with('error', 'No Admin Credentials Set Yet');
                        } else {
                            return redirect()->back()->with('error', $data_response->details->message);
                        }
                    } else {
                        return redirect()->back()->with('error', 'insufficient Balance ');
                    }
                } else {
                    return redirect('/activate')->with(session('error', 'Activate Your Account to Continue'));
                }
            } else {
                return redirect('/home')->with(session('error'), 'Account Disabled');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage() . ', line: ' . $e->getLine());
        }


    }


}
