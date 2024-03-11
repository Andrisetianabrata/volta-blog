<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if($request->routeIs('author.*')){
                session()->flash('fail', 'Anda harus masuk dahulu');
                return route('author.login', ['fail'=>true, 'ReturnUrl'=>URL::current()]);
            }
        }
    }
}
