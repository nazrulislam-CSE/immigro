<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoftwareSale;

class SoftwareSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Software Sale List';
        $softwareSales = SoftwareSale::latest()->get();
        return view('admin.software.sale.index', compact('softwareSales', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Software Sale';
        return view('admin.software.sale.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'software_name'   => 'required|string|max:255',
            'demo_link'       => 'nullable|url|max:500',
            'price'           => 'nullable|numeric|min:0',
            'discount'        => 'nullable|numeric|min:0|max:100',
            'sell_comission'  => 'nullable|numeric|min:0',
            'monthly_charge'  => 'nullable|numeric|min:0',
            'facilities'      => 'nullable|string',
            'status'          => 'nullable|in:0,1',
        ]);

        $software = new SoftwareSale();
        $software->software_name  = $request->software_name;
        $software->demo_link      = $request->demo_link;
        $software->price          = $request->price ?? 0;
        $software->discount       = $request->discount ?? 0;
        $software->sell_comission = $request->sell_comission ?? 0;
        $software->monthly_charge = $request->monthly_charge ?? 0;
        $software->facilities     = $request->facilities;
        $software->status         = $request->status ?? 1;

        $software->save();

        flash()->addSuccess("Software Sale Created Successfully.");
        return redirect()->route('admin.software.sale.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Software Sale Details';
        $software = SoftwareSale::findOrFail($id);
        return view('admin.software.sale.show', compact('software', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Software Sale';
        $software = SoftwareSale::findOrFail($id);
        return view('admin.software.sale.edit', compact('software', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $software = SoftwareSale::findOrFail($id);

        $request->validate([
            'software_name'   => 'required|string|max:255',
            'demo_link'       => 'nullable|url|max:500',
            'price'           => 'nullable|numeric|min:0',
            'discount'        => 'nullable|numeric|min:0|max:100',
            'sell_comission'  => 'nullable|numeric|min:0',
            'monthly_charge'  => 'nullable|numeric|min:0',
            'facilities'      => 'nullable|string',
            'status'          => 'nullable|in:0,1',
        ]);

        $software->software_name  = $request->software_name;
        $software->demo_link      = $request->demo_link;
        $software->price          = $request->price ?? 0;
        $software->discount       = $request->discount ?? 0;
        $software->sell_comission = $request->sell_comission ?? 0;
        $software->monthly_charge = $request->monthly_charge ?? 0;
        $software->facilities     = $request->facilities;
        $software->status         = $request->status ?? 1;

        $software->save();

        flash()->addSuccess("Software Sale Updated Successfully.");
        return redirect()->route('admin.software.sale.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $software = SoftwareSale::findOrFail($id);
        $software->delete();

        flash()->addError("Software Sale Deleted Successfully.");
        return redirect()->route('admin.software.sale.list');
    }
}