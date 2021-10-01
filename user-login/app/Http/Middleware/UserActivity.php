<?php

namespace App\Http\Middleware;



use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserActivity

{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = now()->addMinutes(2); /* keep online for 2 min */
            Cache::put('user-is-online-'.Auth::user()->id,true, $expiresAt);
            Cache::pull('user-is-online');
            /* last seen */
            User::where('id', Auth::user()->id)->update(['last_seen' => now()]);
        }
        return $next($request);

    }

}
