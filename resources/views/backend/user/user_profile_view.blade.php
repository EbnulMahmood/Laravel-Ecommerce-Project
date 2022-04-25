@extends('admin.admin_master')
@section('admin')
    
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $user->name }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('all.users') }}">All Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <section class="section">
                    <div class="row" id="table-head">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User Details</h4>
                                </div>
                                <div class="card-content">
                                    <!-- table head dark -->
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tr>
                                                <td class="text-bold-500">Image</td>
                                                <td>
                                                    <div class="pr-3 pr-lg-0">
                                                        <img src="{{ !empty($user->profile_photo_path) ?
                                                            url($user->profile_photo_path) :
                                                            url('upload/no_image.jpg') }}" alt="Profile Image" class="rounded-circle mb-lg-2 img-fluid" style="width: 50px;">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Phone</td>
                                                <td>{{ $user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Email</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Created At</td>
                                                <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Last Seen</td>
                                                <td>{{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

@endsection