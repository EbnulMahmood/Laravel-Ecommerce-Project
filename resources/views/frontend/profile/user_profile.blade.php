@extends('frontend.main_master')
@section('content')
@section('title')
    {{ (session()->get('language') == 'bangla') ? 'প্রোফাইল সেটিং' : 'Profile Settings' }}
@endsection
@php
    $user = Auth::user();
@endphp

<!-- Breadcrumbs -->
    
<header class="header header-main header-sticky bg-dark">
  <div class="pb-2 py-lg-3">
      <div class="container text-light">
          <div class="row align-items-center">
              <div class="col-lg-8">
                  <h2 class="mb-0 h4">My profile</h2>
                  <small class="pre-label d-none d-lg-block">User accout</small>
              </div>
              <div class="col-lg-4 text-lg-right pt-2 pt-lg-0">
                  <ol class="breadcrumb breadcrumb-light justify-content-lg-end">
                      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
</header>

<!-- SVG Divider -->

<section class="divider bg-dark">
  <svg class="svg svg-light" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1920" height="100" viewBox="0 0 1920 100" preserveAspectRatio="none meet">
      <path d="M0,11S168.915,69.242,406.27,70.7,685.853,57.593,850.4,37.207,1259.752,73.448,1517.323,70.7,1920,19.667,1920,19.667V101H0Z" transform="translate(0 -1)" />
      <path d="M1920,102.048s-89.6,137.879-398.308,19.053c-162.379-62.5-391.708,20.855-598.484,20.855-206.775,22.449-295.6-77.886-503.833-39.909C286.864,132.511,0,110.668,0,110.668v62.337H1920Z" transform="translate(0 -73.005)" fill-opacity=".2" />
      <path d="M0,102.147S407.045,189.7,555.574,121.265C717.953,58.549,760.893,69.884,840.982,85.957c188.351,79.39,348.351-56.61,532.351,70.057C1489,91.538,1920,110.8,1920,110.8v62.551H0Z" transform="translate(0 -73.347)" fill-opacity=".4" />
  </svg>
</section>

<!-- Profile dashboard -->

<section class="pt-0">
  <div class="container">
      <div class="row">

          <!-- Menu sidebar -->

          <div class="col-lg-3">

              <div class="br-sm pr-lg-4 mt-xl-n6">
              
                  <!-- Profile menu header -->
              
                  <div class="py-3 py-lg-4">
                      <div class="row align-items-center justify-content-center no-gutters text-lg-center">
                          <div class="col-9 col-lg-12">
                              <div class="d-flex flex-lg-column align-items-center">
                                  <div class="pr-3 pr-lg-0">
                                      <img src="{{ !empty($user->profile_photo_path) ?
                                        url($user->profile_photo_path) :
                                        url('upload/no_image.jpg') }}" alt="Profile Image" class="rounded-circle mb-lg-2 img-fluid" style="width: 50px;">
                                  </div>
                                  <div>
                                      <div class="h5 m-0">{{ $user->name }}</div>
                                      <div class="text-muted">{{ $user->email }}</div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-3 d-lg-none text-right">
                              <button class="btn btn-icon btn-primary btn-sm toggle-show" data-show="open-profile-sidebar">
                                  <i class="icon icon-text-align-center"></i>
                              </button>
                          </div>
                      </div>
                  </div>
              
                  <!-- Profile sidebar -->
                  
                  @include('frontend.components.profile.profile_sidebar')
                  
              </div>

          </div>

          <!-- Dashboard details -->

          <div class="col-lg-9 pt-lg-4">
              
              <h2 class="pre-label font-size-base">Profile settings</h2>
              
              <div class="bg-white p-4 p-lg-5 br-sm shadow-sm mb-3 mb-lg-5">
                <form action="{{ route('user.profile.store') }}" method="POST" enctype= "multipart/form-data">
                  @csrf
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label class="pre-label pre-label-sm" for="name">Your Name</label>
                              <input class="form-control form-control-simple" id="name" type="text" name="name" value="{{ $user->name }}">
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label class="pre-label pre-label-sm" for="email">Email address</label>
                              <input class="form-control form-control-simple" id="email" type="email" name="email" value="{{ $user->email }}">
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label class="pre-label pre-label-sm" for="phone">Phone Number</label>
                            <input class="form-control form-control-simple" id="phone" type="text" name="phone" value="{{ $user->phone }}">
                        </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label class="pre-label pre-label-sm" for="profile_photo_path">Your Photo</label>
                              <input class="form-control form-control-simple" id="profile_photo_path" type="file" name="profile_photo_path">
                          </div>
                      </div>
                      <input type="hidden" name="old_image" value="{{ $user->profile_photo_path }}">
                      <div class="col-12">
                          <div class="d-flex flex-wrap justify-content-between align-items-center">
                              <div class="custom-control custom-checkbox d-block">
                                  <input class="custom-control-input" type="checkbox" id="show-email" checked="">
                                  <label class="custom-control-label" for="show-email">Show my email to registered users</label>
                              </div>
                              <button class="btn btn-rounded btn-outline-primary btn-sm px-3 mt-3 mt-sm-0" type="submit">
                                  <i class="fa fa-save mr-2"></i>Save changes
                              </button>
                          </div>
                      </div>
                  </div>
                </form>
              </div>

          </div>
      </div>
  </div>
</section>

@endsection