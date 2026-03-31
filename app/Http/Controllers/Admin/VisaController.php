<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Exception;

class VisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Visa List';
        $visas = Visa::latest()->get();
        return view('admin.visa.index', compact('visas', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Visa Create';
        return view('admin.visa.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'country_name'      => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:visas,slug',
            'flug'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visa_category'     => 'nullable|string|max:255',
            'work_category'     => 'nullable|string|max:255',
            'company_contact'   => 'nullable|string|max:255',
            'processing_time'   => 'nullable|string|max:255',
            'apply_fee'         => 'nullable|numeric',
            'medical_fee'       => 'nullable|numeric',
            'agent_rate'        => 'nullable|numeric',
            'customer_rate'     => 'nullable|numeric',
            'advance_payment'   => 'nullable|numeric',
            'after_visa_payment'=> 'nullable|numeric',
            'manpower_ticket'   => 'nullable|numeric',
            'documents'         => 'nullable|string',
            'status'            => 'nullable|in:0,1',
        ]);

        $visa = new Visa();

        // Handle flag upload
        if ($request->hasFile('flug')) {
            $file = $request->file('flug');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/visa'), $filename);
            $visa->flug = $filename;
        }

        // Auto-generate slug if not provided
        $visa->slug = $request->slug ?? Str::slug($request->country_name);

        // Fill other fields
        $visa->country_name       = $request->country_name;
        $visa->visa_category      = $request->visa_category;
        $visa->work_category      = $request->work_category;
        $visa->company_contact    = $request->company_contact;
        $visa->processing_time    = $request->processing_time;
        $visa->apply_fee          = $request->apply_fee ?? 0;
        $visa->medical_fee        = $request->medical_fee ?? 0;
        $visa->agent_rate         = $request->agent_rate ?? 0;
        $visa->customer_rate      = $request->customer_rate ?? 0;
        $visa->advance_payment    = $request->advance_payment ?? 0;
        $visa->after_visa_payment = $request->after_visa_payment ?? 0;
        $visa->manpower_ticket    = $request->manpower_ticket ?? 0;
        $visa->documents          = $request->documents;
        $visa->status             = $request->status ?? 1;

        $visa->save();

        flash()->addSuccess("Visa Created Successfully.");
        return redirect()->route('admin.visa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Visa Show';
        $visa = Visa::findOrFail($id);
        return view('admin.visa.show', compact('pageTitle', 'visa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visa = Visa::findOrFail($id);
        $pageTitle = 'Visa Edit';
        return view('admin.visa.edit', compact('visa', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $visa = Visa::findOrFail($id);

        // Validation rules (unique slug except current record)
        $request->validate([
            'country_name'      => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:visas,slug,' . $visa->id,
            'flug'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visa_category'     => 'nullable|string|max:255',
            'work_category'     => 'nullable|string|max:255',
            'company_contact'   => 'nullable|string|max:255',
            'processing_time'   => 'nullable|string|max:255',
            'apply_fee'         => 'nullable|numeric',
            'medical_fee'       => 'nullable|numeric',
            'agent_rate'        => 'nullable|numeric',
            'customer_rate'     => 'nullable|numeric',
            'advance_payment'   => 'nullable|numeric',
            'after_visa_payment'=> 'nullable|numeric',
            'manpower_ticket'   => 'nullable|numeric',
            'documents'         => 'nullable|string',
            'status'            => 'nullable|in:0,1',
        ]);

        // Handle flag upload (delete old if new uploaded)
        if ($request->hasFile('flug')) {
            // Delete old image
            if ($visa->flug && file_exists(public_path('upload/visa/' . $visa->flug))) {
                @unlink(public_path('upload/visa/' . $visa->flug));
            }
            $file = $request->file('flug');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/visa'), $filename);
            $visa->flug = $filename;
        }

        // Update slug
        $visa->slug = $request->slug ?? Str::slug($request->country_name);

        // Update other fields
        $visa->country_name       = $request->country_name;
        $visa->visa_category      = $request->visa_category;
        $visa->work_category      = $request->work_category;
        $visa->company_contact    = $request->company_contact;
        $visa->processing_time    = $request->processing_time;
        $visa->apply_fee          = $request->apply_fee ?? 0;
        $visa->medical_fee        = $request->medical_fee ?? 0;
        $visa->agent_rate         = $request->agent_rate ?? 0;
        $visa->customer_rate      = $request->customer_rate ?? 0;
        $visa->advance_payment    = $request->advance_payment ?? 0;
        $visa->after_visa_payment = $request->after_visa_payment ?? 0;
        $visa->manpower_ticket    = $request->manpower_ticket ?? 0;
        $visa->documents          = $request->documents;
        $visa->status             = $request->status ?? 1;

        $visa->save();

        flash()->addSuccess("Visa Updated Successfully.");
        return redirect()->route('admin.visa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visa = Visa::findOrFail($id);

        // Delete flag image if exists
        if ($visa->flug && file_exists(public_path('upload/visa/' . $visa->flug))) {
            @unlink(public_path('upload/visa/' . $visa->flug));
        }

        $visa->delete();

        flash()->addError("Visa Deleted Successfully.");
        return redirect()->route('admin.visa.index');
    }
}