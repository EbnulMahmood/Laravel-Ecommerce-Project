@extends('admin.admin_master')
@section('admin')
    
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body py-4 px-5">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl">
                        <img src="{{ !empty($adminData->profile_photo_path) ?
                        url($adminData->profile_photo_path) :
                        url('upload/no_image.jpg') }}" alt="Profile Image">
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold">{{ $adminData->name }}</h5>
                        <h6 class="text-muted mb-0">{{ $adminData->email }}</h6>
                        <br>
                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-info">
                            <span class="glyphicon glyphicon-log-out"></span> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection