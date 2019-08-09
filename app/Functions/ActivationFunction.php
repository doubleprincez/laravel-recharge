<?php
/**
 * Created by PhpStorm.
 * User: DOUBLE PRINCE
 * Date: 8/1/2019
 * Time: 2:38 AM
 */
namespace App\Functions;

use App\Activation;
use App\User;

trait ActivationFunction{

use PaymentFunction;

    /**
     * Check if the amount paid by the user is complete
     * Set User as Verified if payment is completed
     *
     * @return bool
     */
    public function checkActivation(){
        if(auth()->user()->status ===1){
            // Check  and get Activation payment for user
           $prev = $this->getPrevPaymentAmount();

                // If user has paid in full send true else false
                if($prev >=  config('app.activation_fee')){
                    $user = User::find(auth()->id());
                    $user->verified = 1;
                    $user->update();
                    return true;
                }else{
                    return false;
                }

        }else{
            return false;
        }
    }


    /**
     * @return mixed
     */
    public function getPayments(){
       return $payments = Activation::where('user_id','=',auth()->id());
    }


    /**
     * Check User installments else return false
     * @return mixed
     */
    public function getOneTimePayment(){
        $trans = Activation::where('user_id','=',auth()->id());
        if($trans->count() > 0){
            return $trans->get();
        }else{
            return false;
        }
    }


    /**
     * Return user One time payment else return false
     * @return mixed
     */
    public function getAllInstallments(){
        $trans = Activation::where('user_id','=',auth()->id());
        if($trans->count() > 0){
            return $trans->get();
        }
        else{
            return false;
        }
    }




}