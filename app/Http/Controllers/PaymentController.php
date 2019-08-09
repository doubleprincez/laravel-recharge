<?php

namespace App\Http\Controllers;


use App\Functions\PaymentFunction;
use http\Url;
use Unicodeveloper\Paystack\Paystack;

class PaymentController extends Controller
{

    use PaymentFunction;

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        if (auth()->user()->status === 1) {
            if (auth()->user()->verified === 1) {
                return (new Paystack)->getAuthorizationUrl()->redirectNow();
            } else {
                return redirect('/activate')->with(session('error', 'Activate Your Account to Continue'));
            }
        } else {
            return redirect('/home')->with(session('error'), 'Account Disabled');
        }

    }

    /**
     * Obtain Paystack payment information
     *
     * @throws \Unicodeveloper\Paystack\Exceptions\PaymentVerificationFailedException
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = (new Paystack)->getPaymentData();

        $json_reply = json_decode(json_encode($paymentDetails))->data;

        if ($json_reply->gateway_response === 'Successful') {

            if ($json_reply->metadata->transaction === "topup") {
                $this->documentTransaction($json_reply);
            } elseif ($json_reply->metadata->transaction === "activate") {
                $this->documentActivation($json_reply);
            }

        }
        return view('user.callback')->with(['response' => $json_reply]);
    }


    public function activationGateway()
    {
        if (auth()->user()->status === 1) {
            if (auth()->user()->verified === 0) {
                return (new Paystack)->getAuthorizationUrl()->redirectNow();
            }
        }
    }
}
