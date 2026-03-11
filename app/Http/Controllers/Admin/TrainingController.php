<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    public function index()
    {
        $pageTitle = 'Training List';
        $trainings = Training::latest()->get();
        return view('admin.training.index', compact('pageTitle', 'trainings'));
    }

    public function create()
    {
        // Not needed separately because we use modal in index
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link'        => 'nullable|url',
            'status'      => 'required|boolean'
        ]);

        $data = $request->only(['title', 'description', 'link', 'order', 'status']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('trainings', 'public');
            $data['image'] = $imagePath;
        }

        Training::create($data);

        return redirect()->route('admin.training.index')->with('success', 'Training added successfully.');
    }

    public function edit($id)
    {
        $training = Training::findOrFail($id);
        return response()->json($training); // For modal via AJAX? But we'll use separate page approach. We'll do separate page for simplicity.
    }

    public function update(Request $request, $id)
    {
        $training = Training::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link'        => 'nullable|url',
            'status'      => 'required|boolean'
        ]);

        $data = $request->only(['title', 'description', 'link', 'order', 'status']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($training->image) {
                Storage::disk('public')->delete($training->image);
            }
            $imagePath = $request->file('image')->store('trainings', 'public');
            $data['image'] = $imagePath;
        }

        $training->update($data);

        return redirect()->route('admin.training.index')->with('success', 'Training updated successfully.');
    }

    public function destroy($id)
    {
        $training = Training::findOrFail($id);
        if ($training->image) {
            Storage::disk('public')->delete($training->image);
        }
        $training->delete();

        return redirect()->route('admin.training.index')->with('success', 'Training deleted successfully.');
    }
}