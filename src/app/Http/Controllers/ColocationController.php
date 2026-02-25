<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    //


    public function index()
    {
        $colocations = Colocation::all();
        return view('colocations', compact('colocations'));
    }

    public function create()
    {
        return view('colocationForm');
    }



    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:256',
            'description' => 'nullable|string|max:512'
        ]);


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
}
