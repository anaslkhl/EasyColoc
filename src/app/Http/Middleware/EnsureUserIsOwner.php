<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $colocation = $request->route('colocation');

        if (!$colocation || $colocation->owner_id !== Auth::id()) {
            abort(403, 'Access denied (Owner only)');
        }

        return $next($request);
    }
}
