<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SkipSessionForAssets
{
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();

        // Skip session for assets
        if (
            str_starts_with($path, 'css/') ||
            str_starts_with($path, 'js/') ||
            str_starts_with($path, 'images/') ||
            str_starts_with($path, 'build/') ||
            str_contains($path, '.css') ||
            str_contains($path, '.js') ||
            str_contains($path, '.png') ||
            str_contains($path, '.jpg') ||
            str_contains($path, '.jpeg') ||
            str_contains($path, '.svg') ||
            str_contains($path, '.ico')
        ) {
            config(['session.driver' => 'array']);
        }

        return $next($request);
    }
}
