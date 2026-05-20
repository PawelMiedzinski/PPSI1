<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BanMiddleware
{

    public function handle(
        Request $request,
        Closure $next
    ): Response
    {

        if(

            auth()->check()

            &&

            auth()->user()->is_banned

        ){

            auth()->logout();

            return redirect('/')

            ->with(

                'error',

                'Twoje konto zostało zablokowane.'

            );

        }

        return $next($request);

    }

}