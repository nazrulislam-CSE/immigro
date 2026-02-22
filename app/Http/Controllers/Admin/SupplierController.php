<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        $pageTitle = 'Suppliers List';
        return view('admin.suppliers.index', compact('suppliers', 'pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'mobile_number' => 'nullable|string|max:20',
            'address'       => 'nullable|string',
            'previous_due'  => 'nullable|numeric',
        ]);

        Supplier::create($validated);

        return redirect()->route('admin.supplier.index')->with('success', 'Supplier added successfully.');
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'mobile_number' => 'nullable|string|max:20',
            'address'       => 'nullable|string',
            'previous_due'  => 'nullable|numeric',
        ]);

        $supplier->update($validated);

        return redirect()->route('admin.supplier.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('admin.supplier.index')->with('success', 'Supplier deleted successfully.');
    }
}