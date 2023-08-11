<?php

namespace App\Http\Middleware;

use Closure;
use App\Rules\TokenValidationRule;

class TokenValidationMiddleware
{
    public function handle($request, Closure $next)
    {
        $key = $request->input('key');

        $rule = new TokenValidationRule();

        if (!$rule->passes('key', $key)) {
            return response()->json(['error' => 'Invalid key'], 401);
        }

        return $next($request);
    }
}
