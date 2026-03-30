<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visa;
use App\Models\RequestVisa;
use App\Models\User;
use App\Models\Applicant;
use Illuminate\Support\Carbon;
use Session;
use Illuminate\Support\Facades\Storage;

class VisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Visa List';
        $visas = Visa::latest()->get();
        return view('admin.visa.index',compact('visas','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Visa Create';
        return view('admin.visa.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        if($request->visa_type == 1){
            $this->validate($request, [
                't_country_name' => 'required',
                // 'description' => 'required',
            ]);
        }else{
            $this->validate($request, [
                'country_name' => 'required',
                'visa_type' => 'required',
                'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
                // 'banner' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
                // 'description' => 'required',
            ]);
        }

        if($request->visa_type == 1){
            $visa = new Visa;
            $visa->t_country_name       = $request->t_country_name;
            $visa->t_clients_name       = $request->t_clients_name;
            $visa->t_passport_number    = $request->t_passport_number;
            $visa->t_phone              = $request->t_phone;
            $visa->t_processing_time    = $request->t_processing_time;
            $visa->t_agent_name         = $request->t_agent_name;
            $visa->t_agent_price        = $request->t_agent_price;
            $visa->t_customer_price     = $request->t_customer_price;
            $visa->t_visa_duration      = $request->t_visa_duration;
            $visa->t_documents          = $request->t_document;

            if($request->t_status == Null){
                $request->t_status = 0;
            }
            $visa->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->t_country_name)));
            $visa->t_status = $request->t_status;
            $visa->created_at = Carbon::now();
            $visa->save();

            if ($request->file('t_image')) {
                $file = $request->file('t_image');
                @unlink(public_path('upload/visa/'.$visa->t_image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/visa'),$filename);
                $visa['t_image'] = $filename;
            }

            if ($request->file('t_banner')) {
                $file = $request->file('t_banner');
                @unlink(public_path('upload/visa/'.$visa->t_banner));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/visa'),$filename);
                $visa['t_banner'] = $filename;
            }

            $visa->save();

            flash()->addSuccess("Visa Created Successfully.");
            $url = '/admin/visa/index';
            return redirect($url);
        }else{

            $visa = new Visa;

            $visa->country_name         = $request->country_name;
            $visa->documents            = $request->document;
            $visa->visa_type            = $request->visa_type;
            $visa->work_types           = $request->work_types;
            $visa->contact_year         = $request->contact_year;
            $visa->basic_salary         = $request->basic_salary;
            $visa->overtime             = $request->overtime;
            $visa->weekend              = $request->weekend;
            $visa->accommodation_cost   = $request->accommodation_cost;
            $visa->advance_payment      = $request->advance_payment;
            $visa->after_work_permit    = $request->after_work_permit;
            $visa->after_visa           = $request->after_visa;
            $visa->total_cost           = $request->total_cost;
            $visa->duration_visa        = $request->duration_visa;
            $visa->visa_processing_time = $request->visa_processing_time;
          
    
            if($request->status == Null){
                $request->status = 0;
            }
            $visa->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->country_name)));
            $visa->status = $request->status;
            $visa->created_at = Carbon::now();
            $visa->save();
    
    
            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/visa/'.$visa->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/visa'),$filename);
                $visa['image'] = $filename;
            }
    
            // if ($request->file('banner')) {
            //     $file = $request->file('banner');
            //     @unlink(public_path('upload/visa/'.$visa->banner));
            //     $filename = date('YmdHi').$file->getClientOriginalName();
            //     $file->move(public_path('upload/visa'),$filename);
            //     $visa['banner'] = $filename;
            // }
    
    
            $visa->save();
    
            flash()->addSuccess("Visa Created Successfully.");
            $url = '/admin/visa/index';
            return redirect($url);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Visa Show';
        $visa = Visa::find($id);
        return view('admin.visa.show',compact('pageTitle','visa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visa = Visa::find($id);
        $pageTitle = 'Visa Edit';
        return view('admin.visa.edit', compact('visa','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $visa = Visa::find($id);

        if($request->visa_type == 1){
            $visa->t_country_name       = $request->t_country_name;
            $visa->t_clients_name       = $request->t_clients_name;
            $visa->t_passport_number    = $request->t_passport_number;
            $visa->t_phone              = $request->t_phone;
            $visa->t_processing_time    = $request->t_processing_time;
            $visa->t_agent_name         = $request->t_agent_name;
            $visa->t_agent_price        = $request->t_agent_price;
            $visa->t_customer_price     = $request->t_customer_price;
            $visa->t_visa_duration      = $request->t_visa_duration;
            $visa->t_documents          = $request->t_document;

            if($request->t_status == Null){
                $request->t_status = 0;
            }
            $visa->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->t_country_name)));
            $visa->t_status = $request->t_status;
            $visa->updated_at = Carbon::now();
            $visa->save();

            if ($request->file('t_image')) {
                $file = $request->file('t_image');
                @unlink(public_path('upload/visa/'.$visa->t_image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/visa'),$filename);
                $visa['t_image'] = $filename;
            }

            if ($request->file('t_banner')) {
                $file = $request->file('t_banner');
                @unlink(public_path('upload/visa/'.$visa->t_banner));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/visa'),$filename);
                $visa['t_banner'] = $filename;
            }

            $visa->save();

            flash()->addSuccess("Visa  Updated Successfully.");
            $url = '/admin/visa/index';
            return redirect($url);
        }else{

            $visa->country_name         = $request->country_name;
            $visa->documents            = $request->document;
            $visa->visa_type            = $request->visa_type;
            $visa->work_types           = $request->work_types;
            $visa->contact_year         = $request->contact_year;
            $visa->basic_salary         = $request->basic_salary;
            $visa->overtime             = $request->overtime;
            $visa->weekend              = $request->weekend;
            $visa->accommodation_cost   = $request->accommodation_cost;
            $visa->advance_payment      = $request->advance_payment;
            $visa->after_work_permit    = $request->after_work_permit;
            $visa->after_visa           = $request->after_visa;
            $visa->total_cost           = $request->total_cost;
            $visa->duration_visa        = $request->duration_visa;
            $visa->visa_processing_time = $request->visa_processing_time;
          
    
            if($request->status == Null){
                $request->status = 0;
            }
            $visa->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->country_name)));
            $visa->status = $request->status;
            $visa->updated_at = Carbon::now();
            $visa->save();
    
    
            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/visa/'.$visa->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/visa'),$filename);
                $visa['image'] = $filename;
            }
    
            if ($request->file('banner')) {
                $file = $request->file('banner');
                @unlink(public_path('upload/visa/'.$visa->banner));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/visa'),$filename);
                $visa['banner'] = $filename;
            }
    
    
            $visa->save();
    
            flash()->addSuccess("Visa  Updated Successfully.");
            $url = '/admin/visa/index';
            return redirect($url);
        }

    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visa = Visa::find($id);

        
        if($visa->visa_type == 1){
            try {
                if(file_exists($visa->image)){
                    unlink($visa->image);
                }
            } catch (Exception $e) {
    
            }
        }else{
            try {
                if(file_exists($visa->t_image)){
                    unlink($visa->t_image);
                }
            } catch (Exception $e) {
    
            }
        }



        $visa->delete();


        flash()->addError("Visa Deleted Successfully.");
        $url = '/admin/visa/index';
        return redirect($url);
    }


    // request visa list
    public function visarequestList(){
        $pageTitle = ' Request Visa List';
        $visas = RequestVisa::latest()->get();
        return view('admin.visa.requestvisa', compact('pageTitle','visas'));
    }

    // visa requestLis Show
    public function visarequestListShow(string $id)
    {
       
        $visa = RequestVisa::find($id);
        if($visa->request_visa_type == 5){
            $pageTitle = 'Software Order Show';
        }else{
            $pageTitle = 'Request Visa Show';
        }
        return view('admin.visa.requestvisashow',compact('pageTitle','visa'));
    }

    // visa request edit
    public function visarequestListedit(string $id)
    {
        $visa = RequestVisa::find($id);
        $pageTitle = 'Request Visa Edit';
        $applicants = Applicant::latest()->get();
        return view('admin.visa.requestvisaedit', compact('visa','pageTitle','applicants'));
    }

    // visa request update
    public function visarequestupdate(Request $request,string $id)
    {
        // dd($request->all());
        $visa = RequestVisa::find($id);
        $visa->status               = $request->status;
        $visa->save();

        // commission after successful update
        if($visa->status == '4'){
            $visa->amount               = $request->amount;
            $visa->commission_amount    = $request->commission;
            $visa->total_amount         = $request->total_amount;
            $visa->save();

            // total commission amount
            $agent = User::where('id',$visa->user_id)->first();
            $agent->visa_amount += $request->commission;
            $agent->save();
        }
        

       
        flash()->addSuccess("Visa Request Updated Successfully.");
        $url = '/admin/visa/request/list';
        return redirect($url);
    }
    


}
