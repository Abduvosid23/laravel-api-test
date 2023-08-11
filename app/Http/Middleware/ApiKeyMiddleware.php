<?php

namespace App\Http\Middleware;

use Closure;

class ApiKeyMiddleware
{
    public function handle($request, Closure $next)
    {
        $apiKey = config('api.api_key'); // Retrieve the API key from the configuration
        $key = $request->input('key');

        if ($key !== $apiKey) {
            return response()->json(['error' => 'Invalid key'], 401);
        }

        return $next($request);
    }
}
