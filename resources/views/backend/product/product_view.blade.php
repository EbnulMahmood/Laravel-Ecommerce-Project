@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Products <span class="badge rounded-pill bg-info">{{ count($products) }}</span></h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Product</li>
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
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Discount</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Multiple Images</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ Str::limit($product->product_name_en, 20) }}</td>
                                        <td>{{ $product->selling_price }}৳</td>
                                        <td>{{ $product->product_qty }}</td>
                                        <td>
                                            @if ($product->discount_price == NULL)
                                                <span class="badge bg-warning">None</span>
                                            @else
                                                @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = ($amount/$product->selling_price) * 100;
                                                @endphp
                                                <span class="badge bg-info">{{ round($discount) }}%</span>
                                            @endif    
                                        </td>
                                        <td>
                                            <div class="avatar bg-warning me-3">
                                                <img src="{{ asset($product->product_thumbnail) }}" alt="product" srcset="">
                                            </div>
                                        </td>
                                        <td>
                                            @if ($product->status == 1)
                                                <a href="{{ route('product.inactive', $product->id) }}" title="Click to inactive product" class="badge bg-success">Active</a>
                                            @else
                                                <a href="{{ route('product.active', $product->id) }}" title="Click to active product" class="badge bg-danger">Inactive</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('add.multi.image', $product->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-images" title="Edit">Add</i></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil" title="Edit">Edit</i></a>
                                            <a href="{{ route('product.delete', $product->id) }}" class="btn btn-sm btn-danger" id="delete_item"><i class="bi bi-trash" title="Delete">Delete</i></a>
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