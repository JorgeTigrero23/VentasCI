<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckMenu
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
        $url = '';

        foreach ($request->segments() as $key => $value) {
            
            if(count($request->segments()) == 1)
            {
                $url = $url.$value;

            }else{

                if($key <= 1)
                    $url = $url.$value;

                if($key < 1)
                    $url = $url.'/';

            }

        }

        foreach(Auth::user()->options as $option) {

            if($option->path == $url)
                return $next($request);

        }

        return redirect('home');
    }
}
