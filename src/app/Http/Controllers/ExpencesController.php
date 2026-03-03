<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\settlementController;
use App\Models\Settlement;
use Illuminate\Support\Facades\Auth;

class ExpencesController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();

        $colocationIds = $user->memberships()->pluck('colocation_id');

        $expenses = Expense::whereIn('colocation_id', $colocationIds)
            ->with(['category', 'user', 'colocation'])
            ->get();

        $colocations = Colocation::whereIn('id', $colocationIds)->get();

        $users = User::whereHas('memberships', function ($q) use ($colocationIds) {
            $q->whereIn('colocation_id', $colocationIds);
        })->get();

        $categories = Category::whereIn('colocation_id', $colocationIds)->get();

        return view('expences', compact('expenses', 'colocations', 'users', 'categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'colocation_id' => 'required|exists:colocations,id',
        ]);

        $expense = Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'colocation_id' => $request->colocation_id,
        ]);

        $this->createSettlements($expense);

        return redirect()->route('settlements.index')->with('success', 'Expense and settlements created!');
    }

    private function createSettlements(Expense $expense)
    {
        $members = $expense->colocation->users;

        if ($members->count() <= 1) return;

        $share = $expense->amount / $members->count();
        foreach ($members as $member) {
            if ($member->id == $expense->user_id) continue;
            Settlement::create([
                'colocation_id' => $expense->colocation_id,
                'from_user' => $member->id,
                'to_user' => $expense->user_id,
                'amount' => $share,
                'status' => 'Pending',
            ]);
        }
    }


    public function myExpenses()
    {
        $user = Auth::user();
        $expenses = Expense::with(['colocation.users'])
            ->whereHas('colocation.users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();
    }

    public function details($id)
    {
        $expense = Expense::with(['user', 'category', 'colocation'])->findOrFail($id);

        return view('expenseDetails', [
            'expense' => $expense
        ]);
    }
}
