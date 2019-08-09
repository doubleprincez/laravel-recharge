<?php

namespace App\Http\Controllers;

use App\Functions\PaymentFunction;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
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
     * @return array
     */
    public function index(Request $request)
    {
        try {
            $this->validate($request, [
                'amount' => 'required',
                'wallet_id' => 'required'
            ]);

            $wallet_id = trim($request['wallet_id']);

            $amount = (int)trim($request['amount']);

            // checks if current logged in user owns the wallet
            if($receiver_wallet = $this->getWallet($wallet_id)){
                if ((int)$receiver_wallet->owner_id !== (int)auth()->id()) {

                    $sender_wallet = auth()->user()->wallet;

                    $fee = $this->setPercent(config('app.payment_fee'), $amount);

                    // check if the amount in the wallet is up to amount requested
                    if (($amount + $fee) < $sender_wallet->wallet_balance) {

                        // Ready to Make transfer
                        if ($this->wallet_to_wallet_transfer($amount, $sender_wallet, $receiver_wallet, $fee)) {

                            return redirect()->back()->with('success', 'Transfer to:' . $receiver_wallet->owner->name . ' was successful!');
                        } else {
                            return redirect()->back()->with('error', 'Unable to complete transaction');
                        }


                    } else {
                        return redirect()->back()->with('error', 'Account Balance too low for transaction');
                    }


                } else {
                    return redirect()->back()->with('error', 'You cant credit your own account');
                }
            }else{
                return redirect()->back()->with('error','Account Wallet Not Found');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage() . $e->getCode() . ', line: ' . $e->getLine());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return bool
     */
    public function getWallet($id)
    {
        $user = User::where('wallet_id', '=', $id)->with('wallet');
        if($user->count() > 0){
            return $user->first()->wallet;
        }else{
            return false;
        }
    }


    public function wallet_to_wallet_transfer($amount, $sender_wallet, $receiver_wallet, $fee)
    {

        $sender_wallet->wallet_balance;
        $sender_wallet->wallet_balance -= ($amount + $fee);
        $receiver_wallet->wallet_balance += $amount;
        $receiver_wallet->update();
        $sender_wallet->update();
        $user = User::find(auth()->id());
        $this->rewardReferrer($amount, $user);
        $this->rewardSpecialUsers($amount);
        $this->saveWalletTransaction(auth()->user(), $receiver_wallet, $amount);
        return true;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
