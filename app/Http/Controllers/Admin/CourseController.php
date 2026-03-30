<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Carbon;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Course List';
        $courses = Course::latest()->get();
        return view('admin.course.index',compact('courses','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Course Create';
        return view('admin.course.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $course = new Course;

        $course->name = $request->name;
        $course->slug = strtolower(trim(preg_replace('/\s+/', '-', $request->name)));

        if($request->status == Null){
            $request->status = 0;
        }

        $course->status = $request->status;
        $course->created_at = Carbon::now();
        $course->save();

        flash()->addSuccess("Course Created Successfully.");
        $url = '/admin/course/index';
        return redirect($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Course Show';
        $course = Course::find($id);
        return view('admin.course.show',compact('pageTitle','course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);
        $pageTitle = 'Course Edit';
        return view('admin.course.edit', compact('course','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::find($id);
        $course->name = $request->name;
        $course->slug = strtolower(trim(preg_replace('/\s+/', '-', $request->name)));

        if($request->status == Null){
            $request->status = 0;
        }

        $course->status = $request->status;
        $course->updated_at = Carbon::now();

        $course->save();

        flash()->addSuccess("Course Updated Successfully.");
        $url = '/admin/course/index';
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        $course->delete();

        flash()->addError("Course Deleted Successfully.");
        $url = '/admin/course/index';
        return redirect($url);
    }
}
