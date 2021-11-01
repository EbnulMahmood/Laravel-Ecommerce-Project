@extends('frontend.main_master')
@section('content')
@section('title')
    {{ (session()->get('language') == 'bangla') ? 'লগইন' : 'Login' }}
@endsection
<!-- Breadcrumbs -->
    
<header class="header header-main header-sticky bg-dark">
    <div class="pb-2 py-lg-3">
        <div class="container text-light">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="mb-0 h4">Login</h2>
                    <small class="pre-label d-none d-lg-block">Login on your profile</small>
                </div>
                <div class="col-lg-4 text-lg-right pt-2 pt-lg-0">
                    <ol class="breadcrumb breadcrumb-light justify-content-lg-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
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

<!-- Checkout login &amp; register -->

<section class="pt-0">

    <!-- Login &amp; register -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div>

                    <!-- Checkout login -->

                    <div class="card bg-white shadow-sm mb-2">

                        <div class="card-header py-4 collapsed bg-white">
                            <h2 class="h4 mb-0"> Login</h2>
                        </div>

                        <div class="card-body p-0">
                            <hr class="m-0">
                            <div class="p-4 p-md-6">
                                <form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
                                    @csrf
                                    <div class="row justify-content-center py-4">
                                        <div class="col-md-8">

                                            <div class="form-group">
                                                <input type="email" id="email" name="email" required class="form-control form-control-simple" placeholder="Email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <input type="password" id="password" name="password" required class="form-control form-control-simple" placeholder="Password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>

                                            <div class="form-group d-flex justify-content-between">
                                                <div class="custom-control custom-control-sm custom-checkbox custom-checkbox-primary">
                                                    <input type="checkbox" class="custom-control-input" id="customExampleCheck">
                                                    <label class="custom-control-label" for="customExampleCheck">Remember me</label>
                                                </div>
                                                <small>
                                                    <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                                </small>
                                            </div>

                                            <div class=" text-right py-4">
                                                <button type="submit" class="btn btn-dark">Sign in</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                                <div class="row justify-content-center pt-3">
                                    <div class="col-md-10">
            
                                        <div class="divider-separator">
                                            <span>Or</span>
                                        </div>
            
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-block btn-rounded btn-google px-3">Login with Google</button>
                                            <button type="submit" class="btn btn-sm btn-block btn-rounded btn-facebook px-3">Login with Facebook</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <small>
                                        <a href="{{ route('register') }}" class="text-muted">Don't have an account?</a> <br />
                                        <a href="{{ route('register') }}" class="text-muted">Create an account</a>
                                    </small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection