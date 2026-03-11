<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function index()
    {
        $pageTitle = 'Country List';
        $countries = Country::latest()->get();
        return view('admin.country.index', compact('pageTitle', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'flag'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link'   => 'nullable|url',
            'order'  => 'nullable|integer',
            'status' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'link', 'order', 'status']);

        if ($request->hasFile('flag')) {
            $flagPath = $request->file('flag')->store('countries', 'public');
            $data['flag'] = $flagPath;
        }

        Country::create($data);

        return redirect()->route('admin.country.index')->with('success', 'Country added successfully.');
    }

    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'flag'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link'   => 'nullable|url',
            'order'  => 'nullable|integer',
            'status' => 'required|boolean'
        ]);

        $data = $request->only(['name', 'link', 'order', 'status']);

        if ($request->hasFile('flag')) {
            // Delete old flag
            if ($country->flag) {
                Storage::disk('public')->delete($country->flag);
            }
            $flagPath = $request->file('flag')->store('countries', 'public');
            $data['flag'] = $flagPath;
        }

        $country->update($data);

        return redirect()->route('admin.country.index')->with('success', 'Country updated successfully.');
    }

    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        if ($country->flag) {
            Storage::disk('public')->delete($country->flag);
        }
        $country->delete();

        return redirect()->route('admin.country.index')->with('success', 'Country deleted successfully.');
    }
}