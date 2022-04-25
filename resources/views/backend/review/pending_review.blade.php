@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>All Review <span class="badge rounded-pill bg-info">{{ count($reviews) }}</span></h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Review</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Stars</th>
                                    <th>Summary</th>
                                    <th>Comment</th>
                                    <th>User</th>
                                    <th>Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->rate }}</td>
                                        <td>{{ $review->summary }}</td>
                                        <td>{{ $review->comment }}</td>
                                        <td><a href="{{ route('user.details', $review->user->id) }}">{{ $review->user->name }}</a></td>
                                        <td><a href="{{ route('product.edit', $review->product->id) }}">{{ $review->product->product_name_en }}</a></td>
                                        <td>
                                            @if ($review->status == 1)
                                                <a href="{{ route('review.inactive', $review->id) }}" title="Click to inactive review" class="badge bg-success">Active</a>
                                            @else
                                                <a href="{{ route('review.active', $review->id) }}" title="Click to active review" class="badge bg-danger">Inactive</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection