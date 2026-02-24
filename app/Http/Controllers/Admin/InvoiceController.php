<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('client')->get();
        $clients = Client::all(); // for dropdown in modal
        $pageTitle = 'Invoices List';
        return view('admin.invoices.index', compact('invoices', 'clients', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'       => 'required|exists:clients,id',
            'mobile'          => 'nullable|string|max:20',
            'country_name'    => 'nullable|string|max:255',
            'total_amount'    => 'nullable|numeric',
            'advance_pay'     => 'nullable|numeric',
            'due'             => 'nullable|numeric',
            'processing_time' => 'nullable|string|max:255',
        ]);

        Invoice::create($validated);

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice created successfully.');
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $validated = $request->validate([
            'client_id'       => 'required|exists:clients,id',
            'mobile'          => 'nullable|string|max:20',
            'country_name'    => 'nullable|string|max:255',
            'total_amount'    => 'nullable|numeric',
            'advance_pay'     => 'nullable|numeric',
            'due'             => 'nullable|numeric',
            'processing_time' => 'nullable|string|max:255',
        ]);

        $invoice->update($validated);

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice deleted successfully.');
    }

    // AJAX endpoint to get client details
    public function getClientInfo($id)
    {
        $client = Client::find($id);
        if ($client) {
            return response()->json([
                'mobile' => $client->phone_number,
                'country_name' => $client->country_name,
            ]);
        }
        return response()->json(['error' => 'Client not found'], 404);
    }

    public function getClientDue($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        // Sum of due from all invoices of this client (excluding the current one if editing)
        $totalDue = Invoice::where('client_id', $id)->sum('due');

        return response()->json([
            'previous_due' => number_format($totalDue, 2),
        ]);
    }
}