@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Coupon</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('manage.coupon') }}">All Coupon</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Coupon</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row justify-content-md-center">
            <div class="col-md-9 col-sm-12">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Coupon</h4>
                        </div>        
                        <div class="card-body">
                            <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="basicInput1">Name</label>
                                        <input name="coupon_name" type="text" class="form-control" value="{{ $coupon->coupon_name }}" id="basicInput1" placeholder="Enter Name">
                                        @error('coupon_name')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput2">Discount (%)</label>
                                        <input name="coupon_discount" type="text" class="form-control" value="{{ $coupon->coupon_discount }}" id="basicInput2" placeholder="Enter Discount">
                                        @error('coupon_discount')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="coupon-validity" class="form-label">Validity</label>
                                        <input id="coupon-validity" name="coupon_validity" value="{{ $coupon->coupon_validity }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" type="date" class="form-control">
                                        @error('coupon_validity')
                                            <span class="text-danger">{{ $message }}</span>    
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary rounded-pill" type="submit" value="Update">
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