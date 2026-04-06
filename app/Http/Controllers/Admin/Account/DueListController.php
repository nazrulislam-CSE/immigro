<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use Carbon\Carbon;

class DueListController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'Due List';
        
        $query = Income::with('client')->where('due_amount', '>', 0);
        
        // Search by client name
        if ($request->client) {
            $query->whereHas('client', function($q) use ($request) {
                $q->where('client_name', 'like', '%'.$request->client.'%');
            });
        }
        
        // Filter by date range (based on payment date or due date?)
        if ($request->from_date) {
            $query->whereDate('date', '>=', Carbon::parse($request->from_date));
        }
        if ($request->to_date) {
            $query->whereDate('date', '<=', Carbon::parse($request->to_date));
        }
        
        $dues = $query->orderBy('due_amount', 'desc')->get();
        $totalDue = $dues->sum('due_amount');
        
        return view('admin.account.dues.index', compact('pageTitle', 'dues', 'totalDue'));
    }
}