<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\Client;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        $refunds = Refund::with('client')->get();
        $clients = Client::all();
        $pageTitle = 'Refunds List';
        return view('admin.refunds.index', compact('refunds', 'clients', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'       => 'required|exists:clients,id',
            'refund_amount'   => 'nullable|numeric',
            'payment_method'  => 'nullable|string|max:255',
            'date'            => 'nullable|date',
            'reason'          => 'nullable|string',
        ]);

        Refund::create($validated);

        return redirect()->route('admin.refund.index')->with('success', 'Refund added successfully.');
    }

    public function update(Request $request, $id)
    {
        $refund = Refund::findOrFail($id);

        $validated = $request->validate([
            'client_id'       => 'required|exists:clients,id',
            'refund_amount'   => 'nullable|numeric',
            'payment_method'  => 'nullable|string|max:255',
            'date'            => 'nullable|date',
            'reason'          => 'nullable|string',
        ]);

        $refund->update($validated);

        return redirect()->route('admin.refund.index')->with('success', 'Refund updated successfully.');
    }

    public function destroy($id)
    {
        $refund = Refund::findOrFail($id);
        $refund->delete();

        return redirect()->route('admin.refund.index')->with('success', 'Refund deleted successfully.');
    }

    public function getClientInfo($id)
    {
        $client = Client::find($id);
        if ($client) {
            return response()->json([
                'client_name'  => $client->client_name,
                'phone_number' => $client->phone_number,
                'country_name' => $client->country_name,
                'total_amount' => $client->total_amount,
                'total_refund' => $client->total_refund,
            ]);
        }
        return response()->json(['error' => 'Client not found'], 404);
    }
}