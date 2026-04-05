<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function index()
    {
        $pageTitle = 'Expense List';
        $expenses = Expense::latest()->get();
        return view('admin.account.expense.index', compact('expenses', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Create Expense';
        return view('admin.account.expense.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'             => 'nullable|date',
            'expense_category' => 'nullable|string|max:255',
            'expense_amount'   => 'required|numeric|min:0',
            'payment_method'   => 'nullable|string|max:100',
            'paid_by'          => 'nullable|string|max:255',
            'comments'         => 'nullable|string',
        ]);

        $expense = new Expense();
        $expense->date             = $request->date ? Carbon::parse($request->date) : Carbon::today();
        $expense->expense_category = $request->expense_category;
        $expense->expense_amount   = $request->expense_amount;
        $expense->payment_method   = $request->payment_method;
        $expense->paid_by          = $request->paid_by;
        $expense->comments         = $request->comments;
        $expense->save();

        flash()->addSuccess('Expense created successfully.');
        return redirect()->route('admin.expense.list');
    }

    public function show($id)
    {
        $pageTitle = 'Expense Details';
        $expense = Expense::findOrFail($id);
        return view('admin.account.expense.show', compact('expense', 'pageTitle'));
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Expense';
        $expense = Expense::findOrFail($id);
        return view('admin.account.expense.edit', compact('expense', 'pageTitle'));
    }

    public function update(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);

        $request->validate([
            'date'             => 'nullable|date',
            'expense_category' => 'nullable|string|max:255',
            'expense_amount'   => 'required|numeric|min:0',
            'payment_method'   => 'nullable|string|max:100',
            'paid_by'          => 'nullable|string|max:255',
            'comments'         => 'nullable|string',
        ]);

        $expense->date             = $request->date ? Carbon::parse($request->date) : Carbon::today();
        $expense->expense_category = $request->expense_category;
        $expense->expense_amount   = $request->expense_amount;
        $expense->payment_method   = $request->payment_method;
        $expense->paid_by          = $request->paid_by;
        $expense->comments         = $request->comments;
        $expense->save();

        flash()->addSuccess('Expense updated successfully.');
        return redirect()->route('admin.expense.list');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        flash()->addError('Expense deleted successfully.');
        return redirect()->route('admin.expense.list');
    }

    public function voucher($id)
    {
        $expense = Expense::findOrFail($id);
        $pageTitle = 'Expense Voucher';
        return view('admin.account.expense.voucher', compact('expense', 'pageTitle'));
    }
}