@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Dashboard' }}</li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <p class="card-title my-0">
                        {{ $pageTitle }}
                        <span class="badge bg-danger side-badge" style="font-size:17px;">{{ count($books) }}</span>
                    </p>
                    <div class="d-flex">
                        <a href="{{ route('admin.book.sale.create') }}" class="btn btn-success me-2">
                            <i class="fas fa-plus d-inline"></i> Add New Book
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Photo</th>
                                    <th>Book Name</th>
                                    <th>Writer</th>
                                    <th>Pages</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Seller Price</th>
                                    <th>Customer Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $key => $book)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ $book->photo ? asset('upload/books/'.$book->photo) : asset('upload/no_image.jpg') }}"
                                             width="50" height="50" style="object-fit: cover;" alt="Book">
                                    </td>
                                    <td>{{ $book->book_name }}</td>
                                    <td>{{ $book->writer_name ?? 'N/A' }}</td>
                                    <td>{{ $book->page ?? 'N/A' }}</td>
                                    <td>{{ number_format($book->price, 2) }}</td>
                                    <td>{{ $book->discount }}%</td>
                                    <td>{{ number_format($book->seller_price, 2) }}</td>
                                    <td>{{ number_format($book->customer_price, 2) }}</td>
                                    <td>{!! $book->status_badge !!}</td>
                                    <td>
                                        <a href="{{ route('admin.book.sale.show', $book->id) }}" class="btn btn-success btn-sm me-1" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.book.sale.edit', $book->id) }}" class="btn btn-primary btn-sm me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.book.sale.delete', $book->id) }}" class="btn btn-danger btn-sm" title="Delete"
                                           onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection