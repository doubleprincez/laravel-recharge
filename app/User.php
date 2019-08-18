<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * @property mixed gender
 * @property mixed name
 * @property mixed mobile
 * @property string wallet_id
 * @property string referral_code
 * @property mixed email
 * @property string password
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','wallet_id','referral_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setParentAttribute($value)
    {
        try {
            $this->setParentIdAttribute($value);
        } catch (\Exception $e) {
        }
    }

    public function wallet(){
        return $this->hasOne(Wallet::class,'owner_id','id');
    }
    public function referrer(){
        return $this->belongsTo(User::class,'parent_id','id');
    }

    public function referred_by(){
       $x = User::where('id','=',auth()->id())->with('referrer')->first();
       if($x->referrer && $x->referrer->count() > 0){
           return $x->referrer->name;
       }else{
           return "No One";
       }
    }

    public function wallet_total(){
        $wallet =  Wallet::where('owner_id','=',auth()->id())->firstOrFail();
       return $total = number_format( $wallet->monthly_bonus + $wallet->festival_bonus,2);
    }

    public function my_wallet(){
        return  $wallet =  Wallet::where('owner_id','=',auth()->id())->firstOrFail();
    }

    public function special_user(){
        $wallet =  Wallet::where('owner_id','=',auth()->id())->with('wallet.owner')->firstOrFail();
        return $wallet->special === true;
    }

    public function account(){
        return $this->hasOne(AccountDetails::class,'user_id','id');
    }
}
