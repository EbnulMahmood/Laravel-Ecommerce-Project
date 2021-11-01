@extends('admin.admin_master')
@section('admin')
    
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Profile</h4>
                <div class="avatar avatar-xl me-3">
                    <img id="show-image" src="{{ !empty($editData->profile_photo_path) ?
                        url($editData->profile_photo_path) :
                        url('upload/no_image.jpg') }}" alt="Profile Image" srcset="">
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.profile.store') }}" method="POST" enctype= "multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Name</label>
                                <input name="name" value="{{ $editData->name }}" type="text" class="form-control" id="basicInput" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="profile-image" class="form-label">Image</label>
                                <input id="profile-image" name="profile_photo_path" class="form-control" type="file">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input name="email" value="{{ $editData->email }}" type="email" class="form-control" id="Email" placeholder="Enter email">
                            </div>
                        </div>
                        <input type="hidden" name="old_image" value="{{ $editData->profile_photo_path }}">
                        <div class="form-group">
                            <input class="btn btn-primary rounded-pill" type="submit" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#profile-image').change(function(e) {
            const reader = new FileReader()
            reader.onload = function(e) {
                $('#show-image').attr('src', e.target.result)
            }
            reader.readAsDataURL(e.target.files['0'])
        })
    })
</script>

@endsection