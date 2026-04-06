<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;

class AccountStatementController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'Account Statement';
        
        // Date filters
        $fromDate = $request->from_date 
            ? Carbon::parse($request->from_date) 
            : Carbon::today()->startOfMonth();

        $toDate = $request->to_date 
            ? Carbon::parse($request->to_date) 
            : Carbon::today();
        
        // Fetch incomes
        $incomes = Income::with('client')
            ->whereBetween('date', [$fromDate, $toDate])
            ->get();
        
        // Fetch expenses
        $expenses = Expense::whereBetween('date', [$fromDate, $toDate])
            ->get();
        
        // Combine transactions
        $transactions = collect();
        
        foreach ($incomes as $income) {
            $transactions->push([
                'date' => $income->date,
                'type' => 'Income',
                'category' => $income->income_category,
                'client' => $income->client->client_name ?? 'N/A',
                'amount' => $income->payment_amount,
                'due' => $income->due_amount,
                'payment_method' => $income->payment_method,
                'reference' => 'Income #'.$income->id,
            ]);
        }
        
        foreach ($expenses as $expense) {
            $transactions->push([
                'date' => $expense->date,
                'type' => 'Expense',
                'category' => $expense->expense_category,
                'client' => 'N/A',
                'amount' => -$expense->expense_amount,
                'due' => 0,
                'payment_method' => $expense->payment_method,
                'reference' => 'Expense #'.$expense->id,
            ]);
        }
        
        // Sort by date
        $transactions = $transactions->sortBy('date')->values();
        
        // ✅ FIXED: Running balance (IMPORTANT)
        $balance = 0;
        $transactions = $transactions->map(function ($txn) use (&$balance) {
            $balance += $txn['amount'];
            $txn['balance'] = $balance;
            return $txn;
        });
        
        // Summary
        $totalIncome = $incomes->sum('payment_amount');
        $totalExpense = $expenses->sum('expense_amount');
        $netBalance = $totalIncome - $totalExpense;
        
        return view('admin.account.statement.index', compact(
            'pageTitle', 'transactions', 'fromDate', 'toDate',
            'totalIncome', 'totalExpense', 'netBalance'
        ));
    }
}