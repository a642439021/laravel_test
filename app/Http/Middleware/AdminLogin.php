<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    public function handle($request, Closure $next)
    {

        if(!session('backend_user')){
            $tmp = $this->getContrllerInfo();
            if($tmp['method']!='backendLogin'){
                return redirect()->route('backend_login');
            }
        }
        return $next($request);
    }
    public function getContrllerInfo()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);
        $class = substr(strrchr($class,"\\"),1);
        return ['controller' => $class, 'method' => $method];
    }
}
