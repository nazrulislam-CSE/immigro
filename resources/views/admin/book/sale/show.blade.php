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
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <p class="card-title my-0">{{ $pageTitle }}</p>
                <div class="d-flex">
                    <a href="{{ route('admin.book.sale.list') }}" class="btn btn-danger me-2">
                        <i class="fas fa-list d-inline"></i> Book List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">Book Name</th>
                                <td>{{ $book->book_name }}</td>
                            </tr>
                            <tr>
                                <th>Writer Name</th>
                                <td>{{ $book->writer_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Cover Photo</th>
                                <td>
                                    <img src="{{ $book->photo ? asset('upload/books/'.$book->photo) : asset('upload/no_image.jpg') }}"
                                         width="120" alt="Book Cover">
                                </td>
                            </tr>
                            <tr>
                                <th>Pages</th>
                                <td>{{ $book->page ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ number_format($book->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>{{ $book->discount }}%</td>
                            </tr>
                            <tr>
                                <th>Seller Price</th>
                                <td>{{ number_format($book->seller_price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Customer Price</th>
                                <td>{{ number_format($book->customer_price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{!! $book->status_badge !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection