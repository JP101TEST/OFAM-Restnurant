<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post')) {
            return $next($request);
        } else {
            dd(session('User'),session('User')[0]->employees_id);

            if (empty(session('User'))) {
                return redirect()->route('login');
            } else {
                return view('management.management_oder_food_list');
            }
        }
    }
}
