<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Settlement;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function dashboard()
    {
        $user = Auth::user();

        $colocation = Colocation::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['users', 'expenses', 'settlements'])->first();

        $isOwner = $colocation && $colocation->owner_id === $user->id;

        $totalPaid = Expense::where('colocation_id', $colocation->id ?? null)
            ->where('user_id', $user->id)
            ->sum('amount');

        $totalOwes = Settlement::where('colocation_id', $colocation->id ?? null)
            ->where('from_user', $user->id)
            ->where('status', 'pending')
            ->sum('amount');

        $totalOwedToUser = Settlement::where('colocation_id', $colocation->id ?? null)
            ->where('to_user', $user->id)
            ->where('status', 'pending')
            ->sum('amount');

        $balance = $totalOwedToUser - $totalOwes;

        return view('dashboard', compact(
            'user',
            'colocation',
            'isOwner',
            'totalPaid',
            'totalOwes',
            'totalOwedToUser',
            'balance'
        ));
    }
}
