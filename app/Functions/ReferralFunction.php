<?php
/**
 * Created by PhpStorm.
 * User: DOUBLE PRINCE
 * Date: 8/1/2019
 * Time: 1:03 AM
 */
namespace App\Functions;

use App\Otherbonus;
use App\User;
use Illuminate\Support\Facades\Cookie;

trait ReferralFunction{


    /***
     * Get the Person that referred the current user
     * @param $id
     * @return mixed
     */
    public function getReferrer($id){
        return User::find($id);
    }


    /**
     * @param $event
     * @return string
     */
    public function storeNewReferred($event){

       $user = User::where('id','=',auth()->id())->first();

        if($event && $event!='' && (int)$event != auth()->id()){

            $referrer= User::find($event);

                // Check if the referrer has gotten 10 referred ... if yes make user a new root
                if($referrer->descendants->count() <= 10){

                    $referrer->appendNode($user);
                    $referrer->save();
                    Cookie::queue(Cookie::forget('ref'));
             }

            $this->updateTree();
        }

    }


    /** Fetching Ancestors of Current User
     *
     * @return mixed
     */
    public function getAllAncestors(){
        // Get all ancestors
        return User::find(auth()->id())->ancestors()->withDepth()->pluck('id')->toArray();

    }

    // Required to keep the referral tree updated
    public function updateTree(){
        User::fixTree();
        $this->updateReferralsLevel();
        User::fixTree();
    }


    public function updateReferralsLevel(){
        // get all ancestors and their depth
        $ancestors = $this->getAncestors(auth()->id());

        // use ancestors depth to determine their level
        foreach($ancestors as $ancestor){
            $ancestor->referral_level = $ancestor->depth + 2;
            $ancestor->save();
        }
        return true;
    }

    public function getAncestors($node){
        return User::withDepth()->reversed()->whereAncestorOf($node)->get();
    }

    public function getDescendants($node){
      return  User::whereDescendantOf($node)->withDepth()->get();
    }

    public function getDescendantsTree($node){
      return  User::whereDescendantOf($node)->withDepth()->get()->toTree();
    }


}