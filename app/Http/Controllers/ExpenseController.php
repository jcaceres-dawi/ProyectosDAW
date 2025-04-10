<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $expenses = Expense::where('user_id', auth()->id())->paginate(10);

        return view('expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expense.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric'],
            'expense_date' => ['required', 'date'],
            'is_paid' => ['required', 'boolean'],
        ]);

        $request->user()->expenses()->create($validated);

        return redirect(route('expense.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return view('expense.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        return view('expense.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric'],
            'expense_date' => ['required', 'date'],
            'is_paid' => ['required', 'boolean'],
        ]);

        $expense->update($validated);

        return redirect(route('expense.index'))->with('status', 'Gasto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        Expense::destroy($expense->id);

        return redirect(route('expense.index'))->with('status', 'Gasto eliminado correctamente');
    }
}
