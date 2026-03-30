<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Education;
use Illuminate\Support\Carbon;
use Session;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Education List';
        $educations = Education::latest()->get();
        return view('admin.education.index',compact('educations','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Education Create';
        return view('admin.education.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'course_name' => 'required',
            'study_type' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'coordinator_photo' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'banner' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            // 'description' => 'required',
        ]);


        // if ($request->discount > $request->courseFee) {
        //     dd('hi');
        //     // Display an error message
        //     flash()->addError("Discount cannot be greater than Course Feey.");
        //     $url = '/admin/education/create';
        //     return redirect($url);
           
        // } 


        $education = new Education;

        $education->course_name         = $request->course_name;
        $education->study_type          = $request->study_type;
        $education->course_fee          = $request->course_fee;
        $education->discount            = $request->discount;
        $education->gross_course_fee    = $request->gross_course_fee;
        $education->duration            = $request->duration;
        $education->coordinator_name    = $request->coordinator_name;
        $education->experience          = $request->experience;
        $education->course_materials    = $request->course_materials;
       

        if($request->status == Null){
            $request->status = 0;
        }
        $education->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->course_name)));
        $education->status = $request->status;
        $education->created_at = Carbon::now();
        $education->save();


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/education/'.$education->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/education'),$filename);
            $education['image'] = $filename;
        }

        if ($request->file('coordinator_photo')) {
            $file = $request->file('coordinator_photo');
            @unlink(public_path('upload/education/'.$education->coordinator_photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/education'),$filename);
            $education['coordinator_photo'] = $filename;
        }

        if ($request->file('banner')) {
            $file = $request->file('banner');
            @unlink(public_path('upload/education/'.$education->banner));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/education'),$filename);
            $education['banner'] = $filename;
        }


        $education->save();

        flash()->addSuccess("Education Created Successfully.");
        $url = '/admin/education/index';
        return redirect($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Education Show';
        $education = Education::find($id);
        return view('admin.education.show',compact('pageTitle','education'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $education = Education::find($id);
        $pageTitle = 'Education Edit';
        return view('admin.education.edit', compact('education','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $education = Education::find($id);
        $education->course_name         = $request->course_name;
        $education->study_type          = $request->study_type;
        $education->course_fee          = $request->course_fee;
        $education->discount            = $request->discount;
        $education->gross_course_fee    = $request->gross_course_fee;
        $education->duration            = $request->duration;
        $education->coordinator_name    = $request->coordinator_name;
        $education->experience          = $request->experience;
        $education->course_materials    = $request->course_materials;
       

        if($request->status == Null){
            $request->status = 0;
        }
        $education->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->course_name)));
        $education->status = $request->status;
        $education->updated_at = Carbon::now();
        $education->save();


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/education/'.$education->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/education'),$filename);
            $education['image'] = $filename;
        }

        if ($request->file('coordinator_photo')) {
            $file = $request->file('coordinator_photo');
            @unlink(public_path('upload/education/'.$education->coordinator_photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/education'),$filename);
            $education['coordinator_photo'] = $filename;
        }

        if ($request->file('banner')) {
            $file = $request->file('banner');
            @unlink(public_path('upload/education/'.$education->banner));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/education'),$filename);
            $education['banner'] = $filename;
        }




        $education->save();

        flash()->addSuccess("Educaiton  Updated Successfully.");
        $url = '/admin/education/index';
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $education = Education::find($id);

        try {
            if(file_exists($education->image)){
                unlink($education->image);
            }
        } catch (Exception $e) {

        }

        try {
            if(file_exists($education->coordinator_photo)){
                unlink($education->coordinator_photo);
            }
        } catch (Exception $e) {

        }

        try {
            if(file_exists($education->banner)){
                unlink($education->banner);
            }
        } catch (Exception $e) {

        }

        $education->delete();


        flash()->addError("Education Deleted Successfully.");
        $url = '/admin/education/index';
        return redirect($url);
    }
}
