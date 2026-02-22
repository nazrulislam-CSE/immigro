<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitors = Visitor::all();
        $pageTitle = 'Visitor List';
        return view('admin.visitors.index', compact('visitors', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Add New Visitor';
        return view('admin.visitors.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'mobile'            => 'nullable|string|max:20',
            'interacted_country'=> 'nullable|string|max:255',
            'visa_category'     => 'nullable|string|max:255',
            'date'              => 'nullable|date',
            'next_followup'     => 'nullable|date',
            'followup_result'   => 'nullable|in:yes,no,pending',
            'comments'          => 'nullable|string',
            'counsellor_name'    => 'nullable|string|max:255',
        ]);

        Visitor::create($validated);

        return redirect()->route('admin.visitor.index')
                         ->with('success', 'Visitor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visitor = Visitor::findOrFail($id);
        $pageTitle = 'Visitor Details';
        return view('admin.visitors.show', compact('visitor', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visitor = Visitor::findOrFail($id);
        $pageTitle = 'Edit Visitor';
        return view('admin.visitors.edit', compact('visitor', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $visitor = Visitor::findOrFail($id);

        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'mobile'            => 'nullable|string|max:20',
            'interacted_country'=> 'nullable|string|max:255',
            'visa_category'     => 'nullable|string|max:255',
            'date'              => 'nullable|date',
            'next_followup'     => 'nullable|date',
            'followup_result'   => 'nullable|in:yes,no,pending',
            'comments'          => 'nullable|string',
            'counsellor_name'    => 'nullable|string|max:255',
        ]);

        $visitor->update($validated);

        return redirect()->route('admin.visitor.index')
                         ->with('success', 'Visitor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        return redirect()->route('admin.visitor.index')
                         ->with('success', 'Visitor deleted successfully.');
    }
}