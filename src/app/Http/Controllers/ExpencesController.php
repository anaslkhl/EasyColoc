<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpencesController extends Controller
{
    //

    public function expences()
    {

        return view('expences', [
            'expenses' => Expense::with(['user', 'category', 'colocation'])->get(),
            'categories' => Category::all(),
            'users' => User::all(),
            'colocations' => Colocation::all()
        ]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'colocation_id' => 'required|exists:colocations,id',
        ]);


        $expense = Expense::create([
            'title' => $request->name,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'colocation_id' => $request->colocation_id
        ]);

        return back()->with('success', 'Expense added Successfully');
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
