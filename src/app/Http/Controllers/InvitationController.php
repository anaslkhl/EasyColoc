<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\ColocationInvitation;
use App\Models\Invitation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function invite(Colocation $colocation)
    {
        return view('colocationsInvite', compact('colocation'));
    }

    public function send(Request $request, Colocation $colocation)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();


        $invitation = $colocation->invitations()->create([
            'email' => $user->email,
            'token' => Str::uuid(),
            'status' => 'pending',
            'expires_at' => now()->addDays(1),
        ]);

        Mail::to($user->email)->send(
            new ColocationInvitation($colocation, Auth::user(), $invitation)
        );

        return back()->with('success', 'Invitation sent 🚀');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->where('expires_at', '>', now())
            ->firstOrFail();

        $user = User::where('email', $invitation->email)->firstOrFail();

        $invitation->colocation->users()->attach($user->id, [
            'role' => 'member',
            'joined_at' => now()
        ]);

        $invitation->update(['status' => 'accepted']);

        return redirect()->route('colocations.index')->with('success', 'You joined the colocation 🎉');
    }

    public function decline($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->where('expires_at', '>', now())
            ->firstOrFail();

        $invitation->update(['status' => 'refused']);

        return redirect()->route('home')->with('info', 'Invitation declined');
    }
}
