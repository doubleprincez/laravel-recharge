<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class StoreReferralCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lifespan = (7 * 24 * 60);

        $response = $next($request);

        // From the referral link get referrer ID and store in cookie

        if ($request->has('ref')){
            $code = $request->get('ref');
            $referrer = User::where('referral_code','=',$code)->first();

            $response->cookie('ref', $referrer->id, $lifespan);
        }

        return $response;
    }

}
