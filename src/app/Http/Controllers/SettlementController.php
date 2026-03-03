<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settlement;
use Illuminate\Support\Facades\Auth;


class settlementController extends Controller
{
    //



    public function index()
    {
        $user = Auth::user();

        $owes = $user->settlementsAsDebtor()->where('status', 'pending')->get();
        $owedTo = $user->settlementsAsCreditor()->where('status', 'pending')->get();

        $totalOwes = $owes->sum('amount');
        $totalOwed = $owedTo->sum('amount');

        $summary = [
            'you_are_owed' => $totalOwed,
            'you_owe' => $totalOwes,
            'net' => $totalOwed - $totalOwes,
        ];

        $settlements = $owes->merge($owedTo);

        return view('settlements', compact(
            'summary',
            'settlements'
        ));
    }


    public function showSettlements($colocationId)
    {
        $settlements = Settlement::with(['fromUser', 'toUser'])
            ->where('colocation_id', $colocationId)
            ->orderBy('status', 'asc')
            ->get();

        return view('settlements.index', compact('settlements'));
    }


    public function markPaid($id)
    {
        $settlement = \App\Models\Settlement::findOrFail($id);
        $user = Auth::user();

        if ($settlement->to_user != $user->id && $settlement->from_user != $user->id) {
            abort(403, 'Vous ne pouvez pas marquer ce règlement comme payé.');
        }

        if ($settlement->status == 'paid') {
            return redirect()->back()->with('error', 'Ce règlement est déjà payé.');
        }

        $settlement->status = 'paid';
        $settlement->paid_at = now();
        $settlement->save();

        return redirect()->back()->with('success', 'Règlement marqué comme payé.');
    }
}
