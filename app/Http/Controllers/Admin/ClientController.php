<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $pageTitle = 'Clients List';
        return view('admin.clients.index', compact('clients', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name'      => 'required|string|max:255',
            'phone_number'     => 'nullable|string|max:20',
            'address'          => 'nullable|string',
            'country_name'     => 'nullable|string|max:255',
            'work_category'    => 'nullable|string|max:255',
            'processing_time'  => 'nullable|string|max:255',
            'date'             => 'nullable|date',
            'visa_category'    => 'nullable|string|max:255',
            'transport_number' => 'nullable|string|max:255',
            'total_amount'     => 'nullable|numeric',
            'agent_name'       => 'nullable|string|max:255',
            'agent_id'         => 'nullable|string|max:255',
        ]);

        Client::create($validated);

        return redirect()->route('admin.client.index')->with('success', 'Client added successfully.');
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'client_name'      => 'required|string|max:255',
            'phone_number'     => 'nullable|string|max:20',
            'address'          => 'nullable|string',
            'country_name'     => 'nullable|string|max:255',
            'work_category'    => 'nullable|string|max:255',
            'processing_time'  => 'nullable|string|max:255',
            'date'             => 'nullable|date',
            'visa_category'    => 'nullable|string|max:255',
            'transport_number' => 'nullable|string|max:255',
            'total_amount'     => 'nullable|numeric',
            'agent_name'       => 'nullable|string|max:255',
            'agent_id'         => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return redirect()->route('admin.client.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.client.index')->with('success', 'Client deleted successfully.');
    }
}