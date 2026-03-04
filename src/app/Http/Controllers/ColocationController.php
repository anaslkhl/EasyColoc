<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use App\Models\Membership;
use App\Models\Settlement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    //


    public function index()
    {
        $userId = Auth::id();

        $colocation = Colocation::with([
            'users',
            'activeMembers',
            'categories'
        ])->whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })
            ->first();
        $isOwner = (bool) $colocation;

        return view('colocations', compact(
            'colocation',
            'isOwner'
        ));
    }

    public function create()
    {
        return view('colocationForm');
    }



    public function save(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:256',
            'description' => 'nullable|string|max:512'
        ]);


        $hasActive = Colocation::where('owner_id', $user->id)
            ->where('status', 'active')
            ->exists();

        if ($hasActive) {
            return back()->with('error', 'You already have an active colocation.');
        }



        $colocation = Colocation::create([
            'name' => $request->name,
            'description' => $request->description ?? '',
            'owner_id' => Auth::id()
        ]);

        $colocation->memberships()->create([
            'user_id' => Auth::id(),
            'role' => 'owner',
            'joined_at' => now(),
        ]);

        return redirect('/colocations')->with('Succes', 'Colocation added Successfully');
    }

    public function cancel(Colocation $colocation)
    {
        $user = Auth::user();

        if ($colocation->owner_id !== $user->id) {
            abort(403, 'Seul le propriétaire peut annuler cette colocation.');
        }

        $colocation->status = 'canceled';
        $colocation->save();

        return redirect()->route('colocation.index')->with('success', 'La colocation a été annulée avec succès.');
    }

    public function exit()
    {
        $user = Auth::user();
        $hasUnpaidDebts = Settlement::where('from_user', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($hasUnpaidDebts) {
            $user->reputation = -1;
            $user->save();
        }
        Membership::where('user_id', $user->id)->delete();

        return redirect('/dashboard')
            ->with('success', 'You have exited the colocation.');
    }
}
