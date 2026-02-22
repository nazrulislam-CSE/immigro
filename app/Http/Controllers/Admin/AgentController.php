<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::all();
        $pageTitle = 'Agents List';
        return view('admin.agents.index', compact('agents', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'agent_name'    => 'required|string|max:255',
            'mobile_number' => 'nullable|string|max:20',
            'agent_id'      => 'required|string|unique:agents,agent_id|max:255',
            'no_area'       => 'nullable|string|max:255',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('agents', 'public');
            $validated['photo'] = $path;
        }

        Agent::create($validated);

        return redirect()->route('admin.agent.index')->with('success', 'Agent added successfully.');
    }

    public function update(Request $request, $id)
    {
        $agent = Agent::findOrFail($id);

        $validated = $request->validate([
            'agent_name'    => 'required|string|max:255',
            'mobile_number' => 'nullable|string|max:20',
            'agent_id'      => 'required|string|unique:agents,agent_id,' . $id . '|max:255',
            'no_area'       => 'nullable|string|max:255',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($agent->photo) {
                Storage::disk('public')->delete($agent->photo);
            }
            $path = $request->file('photo')->store('agents', 'public');
            $validated['photo'] = $path;
        }

        $agent->update($validated);

        return redirect()->route('admin.agent.index')->with('success', 'Agent updated successfully.');
    }

    public function destroy($id)
    {
        $agent = Agent::findOrFail($id);
        if ($agent->photo) {
            Storage::disk('public')->delete($agent->photo);
        }
        $agent->delete();

        return redirect()->route('admin.agent.index')->with('success', 'Agent deleted successfully.');
    }
}