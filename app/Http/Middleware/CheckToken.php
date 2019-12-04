<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Helpers\Token;

class CheckToken
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
        $saved_token = new Token();
        $token = $request->token;
        $verified_email = $saved_token->decode_token($token);
        $received_user = User::where('email', $verified_email)->first();
        $received_email = $received_user->email;

        if($received_email == $verified_email) {
            return $next($request);
        }
    }
}
