<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $colocation = $request->route('colocation') ?? $request->route('colocation_id');

        if ($colocation) {
            if (is_numeric($colocation)) {
                $colocation = \App\Models\Colocation::find($colocation);
            }

            if (!$colocation || (! $colocation->users->contains($user->id) && $colocation->owner_id !== $user->id)) {
                abort(403, 'Access denied (Members only)');
            }
        }

        return $next($request);
    }
}
