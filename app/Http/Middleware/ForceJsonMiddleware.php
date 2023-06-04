<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonMiddleware
{
    public function handle(Request $request,Closure $next)
    {
        $request->headers->set('Accept','application/json');
        return $next($request);
    }
}
