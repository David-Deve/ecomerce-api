<?php

namespace App\Http\Middleware;

use App\Models\Activity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if(app()->runningInConsole()){
            return $response;
        }
        $user = Auth::user();

        $route = $request->route();
        $action = $route?->getActionName();
        $routeName = $route?->getName();
        $uri= $request->path();

        Activity::create([
            'user_id'=> optional($user)->id,
            'user_name'=> optional($user)->name,
            'method'      => $request->method(),
            'route'       => $uri,
            'action_name' => $routeName ?: $action ?: 'unknown',
            'payload'     => json_encode($request->except(['password', 'password_confirmation'])),
        ]);
        return $response;
    }
}
