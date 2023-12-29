<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValidateHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Validate header Content-Type: application/json
        if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('patch')) {
            if (!$request->isJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Request Content-Type header is invalid. (Expected: application/json)',
                    'error_code' => Response::HTTP_BAD_REQUEST,
                    'data' => (object) [],
                ], Response::HTTP_BAD_REQUEST);
            }
            // Validate header Accept: application/json
            if (!$request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Request Accept header is invalid. (Expected: application/json)',
                    'error_code' => Response::HTTP_BAD_REQUEST,
                    'data' => (object) [],
                ], Response::HTTP_BAD_REQUEST);
            }
        }

        return $next($request);
    }
}
