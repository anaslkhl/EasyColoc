<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\ColocationInvitation;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function send(Request $request, Colocation $colocation)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        Mail::to($user->email)->send(
            new ColocationInvitation($colocation, Auth::user())
        );

        return back()->with('success', 'Invitation sent 🚀');
    }

    public function accept(Colocation $colocation)
    {
        $colocation->users()->attach(Auth::id(), [
            'role' => 'member',
            'joined_at' => now()
        ]);

        return redirect()->route('colocations')->with('success', 'Joined colocation 🎉');
    }

    public function decline(Colocation $colocation)
    {
        return redirect()->route('home')->with('info', 'Invitation declined');
    }
}
