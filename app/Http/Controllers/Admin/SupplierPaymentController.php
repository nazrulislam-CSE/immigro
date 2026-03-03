<?php
// app/Http/Controllers/Admin/SupplierPaymentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupplierPayment;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierPaymentController extends Controller
{
    public function index(Request $request)
    {
        $supplier_id = $request->get('supplier_id');
        $date_from = $request->get('date_from');
        $date_to = $request->get('date_to');
        $payment_category = $request->get('payment_category');
        $visa_category = $request->get('visa_category');

        $query = SupplierPayment::with('supplier');

        if ($supplier_id) {
            $query->where('supplier_id', $supplier_id);
        }
        if ($date_from) {
            $query->whereDate('date', '>=', $date_from);
        }
        if ($date_to) {
            $query->whereDate('date', '<=', $date_to);
        }
        if ($payment_category) {
            $query->where('payment_category', $payment_category);
        }
        if ($visa_category) {
            $query->where('visa_category', $visa_category);
        }

        $payments = $query->orderBy('date', 'desc')->get();

        $suppliers = Supplier::all();

        // Optional summary
        $supplierSummary = [];
        foreach ($suppliers as $supplier) {
            $totalAmount = SupplierPayment::where('supplier_id', $supplier->id)->sum('total_amount');
            $totalPay = SupplierPayment::where('supplier_id', $supplier->id)->sum('total_pay');
            $due = $totalAmount - $totalPay;
            $supplierSummary[] = [
                'name' => $supplier->name,
                'total_amount' => $totalAmount,
                'total_pay' => $totalPay,
                'due' => $due,
            ];
        }

        $pageTitle = 'Supplier Payments';
        return view('admin.supplier.payments.index', compact('payments', 'suppliers', 'supplierSummary', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id'       => 'required|exists:suppliers,id',
            'payment_category'   => 'nullable|string|max:255',
            'total_amount'       => 'nullable|numeric',
            'total_pay'          => 'nullable|numeric',
            'due'                => 'nullable|numeric',
            'due_pay_date'       => 'nullable|date',
            'date'               => 'nullable|date',
            'payment_purpose'    => 'nullable|string',
            'applicable_fee'     => 'nullable|string|in:Advance,Documents',
            'visa_category'      => 'nullable|string|max:255',
        ]);

        SupplierPayment::create($validated);

        return redirect()->route('admin.supplier-payment.index')->with('success', 'Supplier payment added successfully.');
    }

    public function update(Request $request, $id)
    {
        $payment = SupplierPayment::findOrFail($id);

        $validated = $request->validate([
            'supplier_id'       => 'required|exists:suppliers,id',
            'payment_category'   => 'nullable|string|max:255',
            'total_amount'       => 'nullable|numeric',
            'total_pay'          => 'nullable|numeric',
            'due'                => 'nullable|numeric',
            'due_pay_date'       => 'nullable|date',
            'date'               => 'nullable|date',
            'payment_purpose'    => 'nullable|string',
            'applicable_fee'     => 'nullable|string|in:Advance,Documents',
            'visa_category'      => 'nullable|string|max:255',
        ]);

        $payment->update($validated);

        return redirect()->route('admin.supplier-payment.index')->with('success', 'Supplier payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = SupplierPayment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.supplier-payment.index')->with('success', 'Supplier payment deleted successfully.');
    }
}