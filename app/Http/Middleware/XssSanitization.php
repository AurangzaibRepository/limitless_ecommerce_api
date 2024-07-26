<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * To sanitize the input parameters
 */
class XssSanitization
{
    public function handle(Request $request, Closure $next): Response
    {
        $parameters = $request->all();

        array_walk_recursive($parameters, function (&$parameter) {
            $parameter = strip_tags($parameter);
        });

        $request->merge($parameters);

        return $next($request);
    }
}
