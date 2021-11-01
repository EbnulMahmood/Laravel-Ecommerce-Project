@extends('admin.admin_master')
@section('admin')
    
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Change Password</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.update.password') }}" method="POST">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input name="current_password" id="current_password" type="password" required class="form-control" id="basicInput1" placeholder="Enter Current Password">
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input name="password" id="password" type="password" required class="form-control" id="basicInput2" placeholder="Enter New Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>    
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirmation Password</label>
                                <input name="password_confirmation" id="password_confirmation" type="password" required class="form-control" id="basicInput3" placeholder="Confirm New Password">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>    
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary rounded-pill" type="submit" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection