<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookSale;

class BookSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Book Sale List';
        $books = BookSale::latest()->get();
        return view('admin.book.sale.index', compact('books', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Book';
        return view('admin.book.sale.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_name'     => 'required|string|max:255',
            'writer_name'   => 'nullable|string|max:255',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'page'          => 'nullable|string|max:50',
            'price'         => 'nullable|numeric|min:0',
            'discount'      => 'nullable|numeric|min:0|max:100',
            'seller_price'  => 'nullable|numeric|min:0',
            'customer_price'=> 'nullable|numeric|min:0',
            'status'        => 'nullable|in:0,1,2,3',
        ]);

        $book = new BookSale();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/books'), $filename);
            $book->photo = $filename;
        }

        $book->book_name      = $request->book_name;
        $book->writer_name    = $request->writer_name;
        $book->page           = $request->page;
        $book->price          = $request->price ?? 0;
        $book->discount       = $request->discount ?? 0;
        $book->seller_price   = $request->seller_price ?? 0;
        $book->customer_price = $request->customer_price ?? 0;
        $book->status         = $request->status ?? 0;

        $book->save();

        flash()->addSuccess("Book Created Successfully.");
        return redirect()->route('admin.book.sale.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Book Details';
        $book = BookSale::findOrFail($id);
        return view('admin.book.sale.show', compact('book', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Book';
        $book = BookSale::findOrFail($id);
        return view('admin.book.sale.edit', compact('book', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = BookSale::findOrFail($id);

        $request->validate([
            'book_name'     => 'required|string|max:255',
            'writer_name'   => 'nullable|string|max:255',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'page'          => 'nullable|string|max:50',
            'price'         => 'nullable|numeric|min:0',
            'discount'      => 'nullable|numeric|min:0|max:100',
            'seller_price'  => 'nullable|numeric|min:0',
            'customer_price'=> 'nullable|numeric|min:0',
            'status'        => 'nullable|in:0,1,2,3',
        ]);

        // Handle photo upload (delete old if new uploaded)
        if ($request->hasFile('photo')) {
            if ($book->photo && file_exists(public_path('upload/books/' . $book->photo))) {
                @unlink(public_path('upload/books/' . $book->photo));
            }
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/books'), $filename);
            $book->photo = $filename;
        }

        $book->book_name      = $request->book_name;
        $book->writer_name    = $request->writer_name;
        $book->page           = $request->page;
        $book->price          = $request->price ?? 0;
        $book->discount       = $request->discount ?? 0;
        $book->seller_price   = $request->seller_price ?? 0;
        $book->customer_price = $request->customer_price ?? 0;
        $book->status         = $request->status ?? 0;

        $book->save();

        flash()->addSuccess("Book Updated Successfully.");
        return redirect()->route('admin.book.sale.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = BookSale::findOrFail($id);

        // Delete photo if exists
        if ($book->photo && file_exists(public_path('upload/books/' . $book->photo))) {
            @unlink(public_path('upload/books/' . $book->photo));
        }

        $book->delete();

        flash()->addError("Book Deleted Successfully.");
        return redirect()->route('admin.book.sale.list');
    }
}