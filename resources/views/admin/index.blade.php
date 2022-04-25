@extends('admin.admin_master')
@section('admin')

@php
    $date = date('d-m-y');
    $today = App\Models\Order::where('order_date', $date)->sum('amount');
    $month_date = date('F');
    $month = App\Models\Order::where('order_month', $month_date)->sum('amount');
    $year_date = date('Y');
    $year = App\Models\Order::where('order_year', $year_date)->sum('amount');
    $pending = App\Models\Order::where('status', 'pending')->get();
@endphp

<section class="row">
    <div class="col-12 col-lg-9">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Today's Sale</h6>
                                <h6 class="font-extrabold mb-0">{{ $today }} ৳</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">{{ $month_date }} Sale</h6>
                                <h6 class="font-extrabold mb-0">{{ $month }} ৳</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">{{ $year_date }} Sale</h6>
                                <h6 class="font-extrabold mb-0">{{ $year }} ৳</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Pending Orders</h6>
                                <h6 class="font-extrabold mb-0"><span class="text-danger">{{ count($pending) }}</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $adminData = DB::table('admins')->first();
    @endphp
    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-body py-4 px-5">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl">
                        <img src="{{ !empty($adminData->profile_photo_path) ?
                            url($adminData->profile_photo_path) :
                            url('upload/no_image.jpg') }}" alt="Face 1">
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold">{{ $adminData->name }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection