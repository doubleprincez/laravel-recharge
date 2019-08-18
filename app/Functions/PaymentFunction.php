<?php


namespace App\Functions;

use App\Activation;
use App\Airvend;
use App\Cable;
use App\Data;
use App\Otherbonus;
use App\Recharge;
use App\SpecialUserBonus;
use App\Transaction;
use App\User;
use App\Wallet;

/**
 *
 */
trait PaymentFunction
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**Reward For new referrer once they pay Call this function and add the account
     * User info for it to fetch the ancestors
     *
     * @param $amount_paid
     * @param $node
     * @return mixed
     */
    public function rewardReferrer($amount_paid, $node,$trasaction_type)
    {
        // Get 50 percent of the paid amount and share to all Ancestors
        $FFPercent = $this->setPercent(50, (float)$amount_paid);

        // Get All Admin Set Bonus Percentage
        $bonuses = Otherbonus::firstOrFail();


        // Get all ancestors
        $ancestors = User::ancestorsOf($node)->pluck('id')->toArray();

        //  loop through them, giving them the percentage allocated

        foreach ($ancestors as $ancestor) {
            $this->setRefPayment($ancestor, $FFPercent, $bonuses);
        }
        // Reward 10 Special Users from the 50%
        $this->rewardSpecialUsers($FFPercent,$trasaction_type);

    }


    /**
     * Fetch Ancestor wallet and affect change to it
     *
     * @param $ref_user_id
     * @param $FFPercent
     * @param $bonuses
     */
    public function setRefPayment($ref_user_id, $FFPercent, $bonuses)
    {
        $pay_to = User::where('id', '=', $ref_user_id)->first();

        if ($pay_to->status === 1) {

            // Get Referrer Wallet
            $ref_wallet = Wallet::where('owner_id', '=', $pay_to->id)->firstOrFail();
            $ref_wallet->card_bonus += $this->setPercent($bonuses->card_bonus, $FFPercent);
            $ref_wallet->travelling_bonus += $this->setPercent($bonuses->travelling_bonus, $FFPercent);
            $ref_wallet->monthly_bonus += $this->setPercent($bonuses->monthly_bonus, $FFPercent);
            $ref_wallet->festival_bonus += $this->setPercent($bonuses->festival_bonus, $FFPercent);

            $ref_wallet->update();

        }

    }


    /**Get the percentage of an amount
     *
     * @param $percent
     * @param $total
     * @return float|int
     */
    public function setPercent($percent, $total)
    {
        return ($percent / 100) * $total;
    }

    public function checkWalletBalance($amount)
    {
        $wallet = Wallet::where('owner_id', '=', auth()->id())->first();
        $to_pay = $this->setPercent(config('app.payment_fee'), $amount);

        if ($wallet->wallet_balance > ($to_pay + $amount)) {

            return true;
        } else {
            return false;
        }
    }

    /**
     * Reward Special users 10% of the 50% of payment
     * @param $amount
     * @param $transaction_type
     */
    private function rewardSpecialUsers($amount, $transaction_type)
    {
        //Special Users Get 10% from every transaction
        $spec_users = Wallet::where('special', true)->get();
        // Get Special user's account bonus settings or create one
        $bonus_setting = $this->getSpecialUserBonusSettings(auth()->id());

        foreach ($spec_users as $spec_user) {
            if ($transaction_type === 'recharge_bonus') {
                $spec_user->special_bonus += $this->setPercent($bonus_setting->recharge_bonus, $amount);
            } elseif ($transaction_type == 'data_bonus') {
                $spec_user->special_bonus += $this->setPercent($bonus_setting->data_bonus, $amount);
            } elseif ($transaction_type == 'cable_bonus') {
                $spec_user->special_bonus += $this->setPercent($bonus_setting->cable_bonus, $amount);
            } elseif ($transaction_type == 'electricity_bonus') {
                $spec_user->special_bonus += $this->setPercent($bonus_setting->electricity_bonus, $amount);
            } elseif ($transaction_type == 'referrer_bonus') {
                $spec_user->special_bonus += $this->setPercent($bonus_setting->referrer_bonus, $amount);
            } elseif ($transaction_type == 'top_up') {
                $spec_user->special_bonus += $this->setPercent($bonus_setting->top_up, $amount);
            } elseif ($transaction_type == 'wallet-to-wallet') {
                $spec_user->special_bonus += $this->setPercent($bonus_setting->wallet_to_wallet, $amount);
            }elseif ($transaction_type == 'activation_bonus') {
                $spec_user->special_bonus += $this->setPercent($bonus_setting->activation_bonus, $amount);
            }

            $spec_user->update();
        }
    }

    private function getSpecialUserBonusSettings($user_id)
    {
        $settings = SpecialUserBonus::where('user_id', '=', (int)$user_id);
        if ($settings->count() > 0) {
            return $settings->first();
        } else {

            $settings = new SpecialUserBonus();
            $settings->user_id = $user_id;
            $settings->save();
            return $settings;
        }
    }

    private function documentTransaction($transaction)
    {
        // Check if transaction reference exist else create a new one
        $user = User::where('email', '=', $transaction->customer->email)->first();
        $t = Transaction::where('reference', '=', $transaction->reference);
        if ($t->count() > 0) {
            $trans = $t->first();
        } else {
            $trans = new Transaction();
        }
        $amount = ($transaction->amount / 100);

        $user->wallet->wallet_balance += $amount;
        $trans->subscriber_id = auth()->id();
        $trans->type = $transaction->metadata->transaction;
        $trans->reference = $transaction->reference;
        $trans->amount = $amount;
        if (isset($transaction->metadata->service_id))
            $trans->service_id = $transaction->metadata->service_id;
        $trans->reference = $transaction->reference;
        $trans->transaction_id = (int)$transaction->id;
        $trans->status = $transaction->status;

        if ($t->count() > 0) {
            $trans->update();
        } else {
            $trans->save();
            $user->wallet->update();
            // Share Reward to Referrers and special Users
            $this->rewardReferrer($amount, $user,'top_up');
        }

    }


    private function documentActivation($transaction)
    {
        // Check if transaction reference exist else create a new one
        $user = User::where('email', '=', $transaction->customer->email)->first();

        $t = Activation::where('transaction_id', '=', (int)$transaction->id);
        if ($t->count() > 0) {
            $trans = $t->first();
        } else {
            $trans = new Activation();
        }
        $prev = $this->getPrevPaymentAmount();
        $amount = $transaction->amount / 100;
        $new_amount = $prev + $amount;

        $balance = config('app.activation_fee') - $new_amount;
        $activation = new Activation();
        $activation->user_id = $user->id;
        $activation->installment = $transaction->customer->metadata['installment'] ? $transaction->customer->metadata['installment'] : false;
        $activation->amount = $amount;
        $activation->balance = $balance;
        $activation->customer_code = $transaction->customer->customer_code;
        $activation->reference = $transaction->reference;
        $activation->transaction_id = (int)$transaction->id;
        $activation->status = $transaction->status;
        $activation->paid_at = date('d-m-y h:m:s', strtotime($transaction->paid_at));
        if ($t->count() > 0) {
            $activation->update();
        } else {
            $activation->save();
            $this->rewardReferrer($amount, $user,'activation_bonus');
        }
        if ((config('app.activation_fee') - $new_amount) <= 1) {
            $user->verified = 1;
            $user->update();
        }

    }

    private function getPrevPaymentAmount()
    {
        $activation_payments = Activation::where('user_id', '=', auth()->id());
        if ($activation_payments->count() > 0) {
            $payments = $activation_payments->get()->pluck('amount');
            $total = 0;
            foreach ($payments as $payment) {
                $total += $payment;

            }
            return $total;
        }
    }


    private function getPaymentCredentials()
    {
        return Airvend::all();
    }

    private function prepareAirvendRequest($content)
    {
        $url = (string)config('app.airvend_url');
        return $this->sendAirvendRequest($url, $content);
    }

    /**
     * Compact request before preparing to send
     * @param $content
     * @return mixed|string
     */
    private function prepareVerifyAirvendRequest($content)
    {

        $url = (string)config('app.airvend_verify_url');
        return $this->sendAirvendRequest($url, $content);
    }


    private function sendAirvendRequest($url, $content)
    {

        $credentials = $this->getPaymentCredentials();
        if ($credentials && $credentials->count() > 0) {

            $credential = $credentials->first();
            $username = strtolower(trim($credential->username));
            $password = strtolower(trim($credential->password));
            $hash_key = trim($credential->hash_key);

            $content = json_encode($content);

            $before_hash = $content . $hash_key;

            $hash = hash("sha512", $before_hash);

            //////////////////////////////////////////////////////////////
            $curl = curl_init();
            // array("Content-Type: application/json","username:$username","password:$password","hash:$hash")
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "username:$username", "password:$password", "hash:$hash"));
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return json_encode(['confirmationCode' => $err->confirmationCode, 'error' => $err]);
            } else {
                return $response;
            }

        } else {
            return json_encode(['confirmationCode' => 310]);
        }

    }

    private function saveDataTransaction($content, $fee = null,$transaction_type)
    {
        // Check if record already exists
        $check = Data::where('reference', '=', $content->referenceID);
        if ($check->count() > 0) {
            $transaction = $check->first();
        } else {
            $transaction = new Transaction();
        }
        $transaction->subscriber_id = auth()->id();
        $transaction->type = $content->type;
        $transaction->transaction_id = $content->TransactionID;
        $transaction->reference = $content->referenceID;
        $transaction->service_id = $content->networkid;
        $transaction->account = $content->account;
        $transaction->amount = ($content->amount + $fee);

        if ($check->count() > 0) {
            $transaction->update();
        } else {
            // deduct from account
            $wallet = Wallet::where('owner_id', '=', auth()->id())->first();
            $wallet->wallet_balance -= ($content->amount + $fee);
            if($wallet->update()){
                $transaction->save();
            }else{
                $wallet->update();
                $transaction->save();
            }
            if ($fee != null && $fee != 0) {
                $this->rewardReferrer($content->amount, auth()->user(),$transaction_type);
            }
        }
    }

    private function saveRechargeTransaction($promise, $fee = null,$transaction_type)
    {
        // Check if record already exists
        $check = Recharge::where('reference', '=', $promise->referenceID);

        if ($check->count() > 0) {
            $transaction = $check->first();

        } else {
            $transaction = new Transaction();
        }

        $transaction->subscriber_id = auth()->id();
        $transaction->type = $promise->type;
        $transaction->transaction_id = $promise->TransactionID;
        $transaction->reference = $promise->referenceID;
        $transaction->service_id = $promise->networkid;
        $transaction->amount = ($promise->amount + $fee);
        $transaction->account = $promise->account;

        if ($check->count() > 0) {
            $transaction->update();
        } else {
            $wallet = Wallet::where('owner_id', '=', auth()->id())->first();
            $wallet->wallet_balance -= ($promise->amount + $fee);
            $wallet->update();
            $transaction->save();
            if ($fee != null && $fee != 0) {
                $this->rewardReferrer($promise->amount, auth()->user(),$transaction_type);
            }
        }
    }

    private function saveCableTransaction($promise, $fee = null,$transaction_type)
    {
        // Check if record already exists
        $check = Cable::where('reference', '=', $promise->referenceID);

        if ($check->count() > 0) {
            $transaction = $check->first();
        } else {
            $transaction = new Transaction();
        }

        $transaction->user_id = auth()->id();
        $transaction->transaction_id = $promise->TransactionID;
        $transaction->reference = $promise->referenceID;
        $transaction->account = $promise->account;
        $transaction->service_type = $promise->type;
        if ($transaction->amount != "") {
            $transaction->amount = $promise->amount + $fee;
        }
        $transaction->status = $promise->message;


        if ($check->count() > 0) {
            $transaction->update();
        } else {
            $wallet = Wallet::where('owner_id', '=', auth()->id())->first();
            $wallet->wallet_balance -= ($promise->amount + $fee);
            $wallet->update();
            $transaction->save();
            // Only Fund when special
            if ($fee != null && $fee != 0) {
                $this->rewardReferrer($promise->amount, auth()->user(),$transaction_type);
            }
        }
    }

//    private function savePinTransaction($promise ,$fee=null){
//        // Check if record already exists
//        $check = Pin::where('reference', '=', $promise->referenceID);
//        if ($check->count() > 0) {
//            $pin = $check->first();
//        } else {
//            $pin = new Pin();
//        }
//
//        $pin->user_id = auth()->id();
//        $pin->type = $promise->type;
//        $pin->transaction_id = $promise->TransactionID;
//        $pin->reference = $promise->referenceID;
//        $pin->service_id = $promise->networkid;
//        $pin->service_type = $promise->type;
//        $pin->service_code;
//        $pin->amount = ($promise->amount+$fee);
//
//        if ($check->count() > 0) {
//            $pin->update();
//        } else {
//            $wallet = Wallet::where('owner_id', '=', auth()->id())->first();
//            $wallet->balance -= ($promise->amount+$fee);
//            $wallet->update();
//            $pin->save();
//            if($fee!=null && $fee!= 0)
//            $this->rewardReferrer($promise->amount, auth()->user());
//        }
//    }

    private function saveWalletTransaction($current_user, $receiver_wallet, $amount, $fee = null)
    {
        $transaction = new Transaction();
        $transaction->subscriber_id = $current_user->id; // Sender Id
        $transaction->type = "wallet"; // wallet to wallet
        $transaction->transaction_id = md5($current_user->id); // md5 of sender ID
        $transaction->reference = time(); // Current Time
        $transaction->amount = $amount;
        $transaction->status = "success";
        $transaction->service_id = $receiver_wallet->id; // service id = wallet of receiver id
        $transaction->save();
        if ($fee != null && $fee != 0) {
            $this->rewardReferrer($amount, auth()->user());
        }

    }
}
