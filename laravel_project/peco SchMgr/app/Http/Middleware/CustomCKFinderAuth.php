<?php

namespace App\Http\Middleware;

use Closure;

class CustomCKFinderAuth
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
        config(['ckfinder.authentication' => function () {

            require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
            $app = require $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/app.php';
            $response = $app->make('Illuminate\Contracts\Http\Kernel')->handle(Illuminate\Http\Request::capture());
            $cookie = $_COOKIE[$app['config']['session']['cookie']] ?? false;

            if ($cookie) {
                $id = $app['encrypter']->decrypt($cookie, false);
                $session = $app['session']->driver();
                $session->setId($id);
                $session->start();
            }

            if (!$app['auth']->check()) {
                header('HTTP/1.0 403 Forbidden');exit();
            }

            

        }]);
        return $next($request);
    }

}


            /*
        if(auth()->guest()){
        return false;
        }else{
        return auth()->user()->is_admin;
        }

         */