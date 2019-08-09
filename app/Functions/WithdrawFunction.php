<?php
/**
 * Created by PhpStorm.
 * User: DOUBLE PRINCE
 * Date: 8/1/2019
 * Time: 1:47 AM
 */

namespace App\Functions;



use App\Cashout;
use App\Transaction;
use App\User;
use Carbon\Carbon;

trait WithdrawFunction{

    use ActivationFunction;

    /**
     *Disable Account withdraw till last week of the month
     * Check if account is activated before user can withdraw
     */
    public function checkCanWithdrawStatus(){
       $user = User::find(auth()->id());
        // Check if User has activated Account first

        if($this->checkActivation() === true){
             $current_week = Carbon::now()->isLastWeek();
            if($current_week === true){
                // Check for all transactions this month and see if amount is more than 400
                if($this->getMonthTransactionAmount() > 400){
//                    also check if user has witdrawn this month

                    if(Cashout::where('user_id','=',auth()->id())->where('created_at', '>=', Carbon::now()->startOfMonth())->count() < 1)
                    $user->can_withdraw = 1;
                    $user->save();
                }else{
                    $user->can_withdraw = 0;
                    $user->save();
                }
            }else{
                $user->can_withdraw = 0;
                $user->save();
            }
        }
        else{
            $user->can_withdraw = false;
            $user->save();
        }


    }

    /**
     * get the transactions that occur for the current month
     * @return int
     */
    public function getMonthTransactionAmount(){
        $transactions = Transaction::where('subscriber_id','=',auth()->id())->where('created_at', '>=', Carbon::now()->startOfMonth())->get();
        $total_amount = 0;
        foreach($transactions as $transaction){
            $total_amount += $transaction['amount'];
        }
        return $total_amount;
    }


}