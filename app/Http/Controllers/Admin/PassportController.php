<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Passport;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function index()
    {
        $passports = Passport::all();
        $pageTitle = 'Passports List';
        return view('admin.passports.index', compact('passports', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name'      => 'required|string|max:255',
            'mobile_no'        => 'nullable|string|max:20',
            'visa_type'        => 'nullable|string|max:255',
            'passport_number'  => 'required|string|unique:passports,passport_number|max:50',
            'address'          => 'nullable|string',
            'country'          => 'nullable|string|max:255',
            'date'             => 'nullable|date',
            'received_by'      => 'nullable|string|max:255',
        ]);

        Passport::create($validated);

        return redirect()->route('admin.passport.index')->with('success', 'Passport added successfully.');
    }

    public function update(Request $request, $id)
    {
        $passport = Passport::findOrFail($id);

        $validated = $request->validate([
            'client_name'      => 'required|string|max:255',
            'mobile_no'        => 'nullable|string|max:20',
            'visa_type'        => 'nullable|string|max:255',
            'passport_number'  => 'required|string|unique:passports,passport_number,' . $id . '|max:50',
            'address'          => 'nullable|string',
            'country'          => 'nullable|string|max:255',
            'date'             => 'nullable|date',
            'received_by'      => 'nullable|string|max:255',
        ]);

        $passport->update($validated);

        return redirect()->route('admin.passport.index')->with('success', 'Passport updated successfully.');
    }

    public function destroy($id)
    {
        $passport = Passport::findOrFail($id);
        $passport->delete();

        return redirect()->route('admin.passport.index')->with('success', 'Passport deleted successfully.');
    }
}