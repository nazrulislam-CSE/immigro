<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentVisa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Exception;

class StudentVisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Student Visa List';
        $studentVisas = StudentVisa::latest()->get();
        return view('admin.visa.student.index', compact('studentVisas', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Student Visa Create';
        return view('admin.visa.student.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_name'      => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:student_visas,slug',
            'flug'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'program'           => 'nullable|string|max:255',
            'versity_name'      => 'nullable|string|max:255',
            'logo'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'intake'            => 'nullable|string|max:255',
            'ielts'             => 'nullable|string|max:255',
            'application_fee'   => 'nullable|numeric',
            'averse_tution_fee' => 'nullable|numeric',
            'acommodation_cost' => 'nullable|numeric',
            'processing_time'   => 'nullable|string|max:255',
            'medical_fee'       => 'nullable|numeric',
            'service_charge'    => 'nullable|string|max:255',
            'documents'         => 'nullable|string',
            'status'            => 'nullable|in:0,1',
        ]);

        $studentVisa = new StudentVisa();

        // Handle flag upload
        if ($request->hasFile('flug')) {
            $file = $request->file('flug');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/student_visa'), $filename);
            $studentVisa->flug = $filename;
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = date('YmdHi') . '_logo_' . $file->getClientOriginalName();
            $file->move(public_path('upload/student_visa'), $filename);
            $studentVisa->logo = $filename;
        }

        // Auto-generate slug if not provided
        $studentVisa->slug = $request->slug ?? Str::slug($request->country_name);

        $studentVisa->country_name       = $request->country_name;
        $studentVisa->program            = $request->program;
        $studentVisa->versity_name       = $request->versity_name;
        $studentVisa->intake             = $request->intake;
        $studentVisa->ielts              = $request->ielts;
        $studentVisa->application_fee    = $request->application_fee ?? 0;
        $studentVisa->averse_tution_fee  = $request->averse_tution_fee ?? 0;
        $studentVisa->acommodation_cost  = $request->acommodation_cost ?? 0;
        $studentVisa->processing_time    = $request->processing_time;
        $studentVisa->medical_fee        = $request->medical_fee ?? 0;
        $studentVisa->service_charge     = $request->service_charge;
        $studentVisa->documents          = $request->documents;
        $studentVisa->status             = $request->status ?? 1;

        $studentVisa->save();

        flash()->addSuccess("Student Visa Created Successfully.");
        return redirect()->route('admin.student.visa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Student Visa Details';
        $studentVisa = StudentVisa::findOrFail($id);
        return view('admin.visa.student.show', compact('studentVisa', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $studentVisa = StudentVisa::findOrFail($id);
        $pageTitle = 'Student Visa Edit';
        return view('admin.visa.student.edit', compact('studentVisa', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $studentVisa = StudentVisa::findOrFail($id);

        $request->validate([
            'country_name'      => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:student_visas,slug,' . $studentVisa->id,
            'flug'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'program'           => 'nullable|string|max:255',
            'versity_name'      => 'nullable|string|max:255',
            'logo'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'intake'            => 'nullable|string|max:255',
            'ielts'             => 'nullable|string|max:255',
            'application_fee'   => 'nullable|numeric',
            'averse_tution_fee' => 'nullable|numeric',
            'acommodation_cost' => 'nullable|numeric',
            'processing_time'   => 'nullable|string|max:255',
            'medical_fee'       => 'nullable|numeric',
            'service_charge'    => 'nullable|string|max:255',
            'documents'         => 'nullable|string',
            'status'            => 'nullable|in:0,1',
        ]);

        // Handle flag upload (delete old if new uploaded)
        if ($request->hasFile('flug')) {
            if ($studentVisa->flug && file_exists(public_path('upload/student_visa/' . $studentVisa->flug))) {
                @unlink(public_path('upload/student_visa/' . $studentVisa->flug));
            }
            $file = $request->file('flug');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/student_visa'), $filename);
            $studentVisa->flug = $filename;
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($studentVisa->logo && file_exists(public_path('upload/student_visa/' . $studentVisa->logo))) {
                @unlink(public_path('upload/student_visa/' . $studentVisa->logo));
            }
            $file = $request->file('logo');
            $filename = date('YmdHi') . '_logo_' . $file->getClientOriginalName();
            $file->move(public_path('upload/student_visa'), $filename);
            $studentVisa->logo = $filename;
        }

        // Update slug if provided, else keep or regenerate
        $studentVisa->slug = $request->slug ?? Str::slug($request->country_name);

        $studentVisa->country_name       = $request->country_name;
        $studentVisa->program            = $request->program;
        $studentVisa->versity_name       = $request->versity_name;
        $studentVisa->intake             = $request->intake;
        $studentVisa->ielts              = $request->ielts;
        $studentVisa->application_fee    = $request->application_fee ?? 0;
        $studentVisa->averse_tution_fee  = $request->averse_tution_fee ?? 0;
        $studentVisa->acommodation_cost  = $request->acommodation_cost ?? 0;
        $studentVisa->processing_time    = $request->processing_time;
        $studentVisa->medical_fee        = $request->medical_fee ?? 0;
        $studentVisa->service_charge     = $request->service_charge;
        $studentVisa->documents          = $request->documents;
        $studentVisa->status             = $request->status ?? 1;

        $studentVisa->save();

        flash()->addSuccess("Student Visa Updated Successfully.");
        return redirect()->route('admin.student.visa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studentVisa = StudentVisa::findOrFail($id);

        // Delete images
        if ($studentVisa->flug && file_exists(public_path('upload/student_visa/' . $studentVisa->flug))) {
            @unlink(public_path('upload/student_visa/' . $studentVisa->flug));
        }
        if ($studentVisa->logo && file_exists(public_path('upload/student_visa/' . $studentVisa->logo))) {
            @unlink(public_path('upload/student_visa/' . $studentVisa->logo));
        }

        $studentVisa->delete();

        flash()->addError("Student Visa Deleted Successfully.");
        return redirect()->route('admin.student.visa.index');
    }
}