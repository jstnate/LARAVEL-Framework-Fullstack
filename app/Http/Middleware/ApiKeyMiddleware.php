<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->header('x-api-key')) {
            return response()->json([
                'message' => 'Missing API key',
            ], 403);
        }

        $apiKey = ApiKey::where('key', $request->header('x-api-key'))->first();

        if (!$apiKey) {
            return response()->json([
                'message' => 'Invalid API key',
            ], 403);
        }

        $request->setUserResolver(function () use ($apiKey) {
            return $apiKey->user;
        });

        return $next($request);
    }
}
