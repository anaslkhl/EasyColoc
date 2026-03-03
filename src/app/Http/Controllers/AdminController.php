<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //


    public function index()
    {
        $totalUsers = User::count();
        $totalColocations = Colocation::count();
        $totalExpenses = Expense::sum('amount');
        $bannedUsers = User::where('is_banned', true)->count();
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin', compact(
            'totalUsers',
            'totalColocations',
            'totalExpenses',
            'bannedUsers',
            'users'
        ));
    }

    public function toggleUser(User $user)
    {
        $user->is_banned = !$user->is_banned;
        $user->save();
        return back()->with('success', 'User status updated!');
    }
}
