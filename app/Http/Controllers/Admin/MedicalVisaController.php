<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalVisa;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MedicalVisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Medical Visa List';
        $medicalVisas = MedicalVisa::latest()->get();
        return view('admin.visa.medical.index', compact('medicalVisas', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Medical Visa Create';
        return view('admin.visa.medical.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_name'    => 'required|string|max:255',
            'slug'            => 'nullable|string|max:255|unique:medical_visas,slug',
            'flug'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visa_type'       => 'nullable|string|max:255',
            'visa_duration'   => 'nullable|string|max:255',
            'apply_fee'       => 'nullable|numeric',
            'processing_time' => 'nullable|string|max:255',
            'publish_date'    => 'nullable|date',
            'service_charge'  => 'nullable|string|max:255',
            'visa_fee'        => 'nullable|numeric',
            'documents'       => 'nullable|string',
            'status'          => 'nullable|in:0,1',
        ]);

        $medicalVisa = new MedicalVisa();

        // Handle flag upload
        if ($request->hasFile('flug')) {
            $file = $request->file('flug');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/medical_visa'), $filename);
            $medicalVisa->flug = $filename;
        }

        // Auto-generate slug if not provided
        $medicalVisa->slug = $request->slug ?? Str::slug($request->country_name);

        $medicalVisa->country_name    = $request->country_name;
        $medicalVisa->visa_type       = $request->visa_type;
        $medicalVisa->visa_duration   = $request->visa_duration;
        $medicalVisa->apply_fee       = $request->apply_fee ?? 0;
        $medicalVisa->processing_time = $request->processing_time;
        $medicalVisa->publish_date    = $request->publish_date ? Carbon::parse($request->publish_date) : null;
        $medicalVisa->service_charge  = $request->service_charge;
        $medicalVisa->visa_fee        = $request->visa_fee ?? 0;
        $medicalVisa->documents       = $request->documents;
        $medicalVisa->status          = $request->status ?? 1;

        $medicalVisa->save();

        flash()->addSuccess("Medical Visa Created Successfully.");
        return redirect()->route('admin.medical.visa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Medical Visa Details';
        $medicalVisa = MedicalVisa::findOrFail($id);
        return view('admin.visa.medical.show', compact('medicalVisa', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $medicalVisa = MedicalVisa::findOrFail($id);
        $pageTitle = 'Medical Visa Edit';
        return view('admin.visa.medical.edit', compact('medicalVisa', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $medicalVisa = MedicalVisa::findOrFail($id);

        $request->validate([
            'country_name'    => 'required|string|max:255',
            'slug'            => 'nullable|string|max:255|unique:medical_visas,slug,' . $medicalVisa->id,
            'flug'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visa_type'       => 'nullable|string|max:255',
            'visa_duration'   => 'nullable|string|max:255',
            'apply_fee'       => 'nullable|numeric',
            'processing_time' => 'nullable|string|max:255',
            'publish_date'    => 'nullable|date',
            'service_charge'  => 'nullable|string|max:255',
            'visa_fee'        => 'nullable|numeric',
            'documents'       => 'nullable|string',
            'status'          => 'nullable|in:0,1',
        ]);

        // Handle flag upload (delete old if new uploaded)
        if ($request->hasFile('flug')) {
            if ($medicalVisa->flug && file_exists(public_path('upload/medical_visa/' . $medicalVisa->flug))) {
                @unlink(public_path('upload/medical_visa/' . $medicalVisa->flug));
            }
            $file = $request->file('flug');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/medical_visa'), $filename);
            $medicalVisa->flug = $filename;
        }

        // Update slug if provided, else keep or regenerate
        $medicalVisa->slug = $request->slug ?? Str::slug($request->country_name);

        $medicalVisa->country_name    = $request->country_name;
        $medicalVisa->visa_type       = $request->visa_type;
        $medicalVisa->visa_duration   = $request->visa_duration;
        $medicalVisa->apply_fee       = $request->apply_fee ?? 0;
        $medicalVisa->processing_time = $request->processing_time;
        $medicalVisa->publish_date    = $request->publish_date ? Carbon::parse($request->publish_date) : null;
        $medicalVisa->service_charge  = $request->service_charge;
        $medicalVisa->visa_fee        = $request->visa_fee ?? 0;
        $medicalVisa->documents       = $request->documents;
        $medicalVisa->status          = $request->status ?? 1;

        $medicalVisa->save();

        flash()->addSuccess("Medical Visa Updated Successfully.");
        return redirect()->route('admin.medical.visa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medicalVisa = MedicalVisa::findOrFail($id);

        // Delete flag image if exists
        if ($medicalVisa->flug && file_exists(public_path('upload/medical_visa/' . $medicalVisa->flug))) {
            @unlink(public_path('upload/medical_visa/' . $medicalVisa->flug));
        }

        $medicalVisa->delete();

        flash()->addError("Medical Visa Deleted Successfully.");
        return redirect()->route('admin.medical.visa.index');
    }
}