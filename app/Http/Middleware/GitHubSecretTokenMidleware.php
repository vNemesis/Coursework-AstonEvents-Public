<?php

namespace App\Http\Middleware;

use Auth;
use Config;
use Closure;
use App\User;

class GitHubSecretTokenMiddleware
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
        $sig_check = 'sha1=' . hash_hmac('sha1', $request->getContent(), Config::get('github.webhook-secret-token'));
        if ($sig_check !== $request->header('x-hub-signature'))
            return response(['error' => 'Unauthorized'], 401);

        //Do you stuff

        return $next($request);
    }
}
