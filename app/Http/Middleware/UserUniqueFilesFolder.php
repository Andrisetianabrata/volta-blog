<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UserUniqueFilesFolder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) : Response
    {
        if (Auth::check()) {
            if (Auth::user()->type == 1) {
                Config::set('elfinder.dir', ["storage"]);
            }else{
                $folderName =  Str::slug(str_replace(['@', '.'],'-',Auth::user()->email)).'-folder';
                // dd($folderName);
                if (!Storage::disk('public')->exists($folderName)) {
                    Storage::disk('public')->makeDirectory($folderName, 0755, true, true);
                }
                Config::set('elfinder.dir', ["storage/$folderName"]);
            }
        }
        return $next($request);
    }
}
