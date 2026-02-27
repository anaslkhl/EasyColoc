<?php

namespace App\Http\Controllers;

use App\Models\Expense;

use App\Models\Membership;
use App\Models\Settlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class settlementController extends Controller
{
    //




    private function createSettlements($expense)
    {
        $members = $expense->members;
        $share = $expense->amount / $members->count();

        foreach ($members as $member) {
            if ($member->id == $expense->owner_id) continue;

            Settlement::create([
                'colocation_id' => $expense->colocation_id,
                'debtor_id' => $member->id,
                'creditor_id' => $expense->owner_id,
                'amount' => $share,
                'status' => 'Pending',
            ]);
        }
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
        $settlement = Settlement::findOrFail($id);

        if (Auth::id() !== $settlement->from_user) {
            abort(403, 'Unauthorized');
        }

        $settlement->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with('success', 'Payment marked as paid.');
    }
}
