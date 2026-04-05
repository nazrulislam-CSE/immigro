<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Income;
use Carbon\Carbon;

class IncomeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Income List';
        $incomes = Income::with('client')->latest()->get();
        return view('admin.account.income.index', compact('incomes', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Create Income';
        $clients = Client::latest()->get();
        return view('admin.account.income.create', compact('clients', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'        => 'nullable|exists:clients,id',
            'income_category'  => 'nullable|string|max:255',
            'total_amount'     => 'required|numeric|min:0',
            'payment_amount'   => 'required|numeric|min:0',
            'date'             => 'nullable|date',
            'payment_date'     => 'nullable|date',
            'payment_method'   => 'nullable|string|max:100',
            'received_by'      => 'nullable|string|max:255',
            'comments'         => 'nullable|string',
        ]);

        $income = new Income();
        $income->client_id        = $request->client_id;
        $income->income_category  = $request->income_category;
        $income->total_amount     = $request->total_amount;
        $income->payment_amount   = $request->payment_amount;
        $income->due_amount       = $request->total_amount - $request->payment_amount;
        $income->date             = $request->date ? Carbon::parse($request->date) : Carbon::today();
        $income->payment_date     = $request->payment_date ? Carbon::parse($request->payment_date) : null;
        $income->payment_method   = $request->payment_method;
        $income->received_by      = $request->received_by;
        $income->comments         = $request->comments;
        $income->save();

        flash()->addSuccess('Income created successfully.');
        return redirect()->route('admin.income.list');
    }

    public function show($id)
    {
        $pageTitle = 'Income Details';
        $income = Income::with('client')->findOrFail($id);
        return view('admin.account.income.show', compact('income', 'pageTitle'));
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Income';
        $income = Income::findOrFail($id);
        $clients = Client::latest()->get();
        return view('admin.account.income.edit', compact('income', 'clients', 'pageTitle'));
    }

    public function update(Request $request, $id)
    {
        $income = Income::findOrFail($id);

        $request->validate([
            'client_id'        => 'nullable|exists:clients,id',
            'income_category'  => 'nullable|string|max:255',
            'total_amount'     => 'required|numeric|min:0',
            'payment_amount'   => 'required|numeric|min:0',
            'date'             => 'nullable|date',
            'payment_date'     => 'nullable|date',
            'payment_method'   => 'nullable|string|max:100',
            'received_by'      => 'nullable|string|max:255',
            'comments'         => 'nullable|string',
        ]);

        $income->client_id        = $request->client_id;
        $income->income_category  = $request->income_category;
        $income->total_amount     = $request->total_amount;
        $income->payment_amount   = $request->payment_amount;
        $income->due_amount       = $request->total_amount - $request->payment_amount;
        $income->date             = $request->date ? Carbon::parse($request->date) : Carbon::today();
        $income->payment_date     = $request->payment_date ? Carbon::parse($request->payment_date) : null;
        $income->payment_method   = $request->payment_method;
        $income->received_by      = $request->received_by;
        $income->comments         = $request->comments;
        $income->save();

        flash()->addSuccess('Income updated successfully.');
        return redirect()->route('admin.income.list');
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();

        flash()->addError('Income deleted successfully.');
        return redirect()->route('admin.income.list');
    }

    public function voucher($id)
    {
        $income = Income::with('client')->findOrFail($id);
        $pageTitle = 'Income Voucher';
        return view('admin.account.income.voucher', compact('income', 'pageTitle'));
    }
}