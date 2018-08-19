<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class Amministrazione
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        if (!Auth::check() AND Session::get('user') != true) {
              
            return redirect('davide/richiesta');
      }
        
        return $this->nocache($next($request));
  }

  protected function nocache($response)
  {
      $response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
      $response->headers->set('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
      $response->headers->set('Pragma','no-cache');

      return $response;
  }
}
