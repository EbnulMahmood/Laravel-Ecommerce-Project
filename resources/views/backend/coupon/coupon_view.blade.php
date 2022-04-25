@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Coupons <span class="badge rounded-pill bg-info">{{ count($coupons) }}</span></h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Coupon</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Discount</th>
                                    <th>Validity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->coupon_name }}</td>
                                        <td>{{ $coupon->coupon_discount }}%</td>
                                        <td width="20%">{{ Carbon\Carbon::parse($coupon->coupon_validity)->format('D, d F Y') }}</td>
                                        <td>
                                            @if ($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil" title="Edit">Edit</i></a>
                                            <a href="{{ route('coupon.delete', $coupon->id) }}" class="btn btn-sm btn-danger" id="delete_item"><i class="bi bi-trash" title="Delete">Delete</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Coupon</h4>
                        </div>        
                        <div class="card-body">
                            <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="basicInput1">Name</label>
                                        <input name="coupon_name" type="text" class="form-control" required id="basicInput1" placeholder="Enter Name">
                                        @error('coupon_name')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput2">Discount (%)</label>
                                        <input name="coupon_discount" type="text" class="form-control" required id="basicInput2" placeholder="Enter Discount">
                                        @error('coupon_discount')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="coupon-validity" class="form-label">Validity</label>
                                        <input id="coupon-validity" name="coupon_validity" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" type="date" class="form-control" required>
                                        @error('coupon_validity')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary rounded-pill" type="submit" value="Add">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

@endsection