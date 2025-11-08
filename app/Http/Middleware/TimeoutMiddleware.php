<?php

namespace App\Http\Middleware;

use Closure;

class TimeoutMiddleware
{
    public function handle($request, Closure $next)
    {
        // Define timeouts per route
        $timeoutConfig = [
            '/timeout/limiteExcedido' => 3, 
            '/timeout/limiteOk' => 5, 
        ];

        $path = $request->path();
        $timeout = $timeoutConfig["/$path"] ?? 10;

        // Start execution time tracking
        $startTime = microtime(true);

        // Set PHP execution time limit
        set_time_limit($timeout);
        ini_set('max_execution_time', $timeout);

        // Execute request
        $response = $next($request);

        // Check elapsed time
        $elapsedTime = microtime(true) - $startTime;

        // If timeout is exceeded, return timeout response
        if ($elapsedTime > $timeout) {
            return response()->json(['error' => 'Request timeout exceeded'], 408);
        }

        // Force return response even if script is still running
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

        return $response;
    }
}

?>