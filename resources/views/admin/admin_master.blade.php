<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard - Mazer Admin Dashboard</title>
  
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.css') }}">

  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/simple-datatables/style.css') }}">

  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/iconly/bold.css') }}">

  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">
  <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.svg') }}" type="image/x-icon">

  <!-- Jquery cdn -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Toastr cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- ckeditor5 cdn -->
  <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>

  <!-- Include Choices CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/vendors/choices.js/choices.min.css') }}" />
</head>

<body>
  <div id="app">
    
    @include('admin.includes.sidebar')

    <div id="main">
      <header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
              <i class="bi bi-justify fs-3"></i>
          </a>
      </header>
      <div class="page-heading">
          <h3>Profile Statistics</h3>
      </div>
      <div class="page-content">
          
        @yield('admin')
        
      </div>

      @include('admin.includes.footer')
    
    </div>
  </div>
  <script src="{{ asset('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
      
  <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.js') }}"></script>
  <script src="{{ asset('backend/assets/js/pages/dashboard.js') }}"></script>
  
  <!-- toastr cdn -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="{{ asset('backend/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('backend/assets/js/main.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Include Choices JavaScript -->
  <script src="{{ asset('backend/assets/vendors/choices.js/choices.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/pages/form-element-select.js') }}"></script>

  <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

  <script>
    @if(Session::has('message'))
      let type = "{{ Session::get('alert-type', 'info') }}";
      switch(type) {
        case 'info':
          toastr.info("{{ Session::get('message') }}");
          break;
        case 'success':
          toastr.success("{{ Session::get('message') }}");
          break;
        case 'warning':
          toastr.warning("{{ Session::get('message') }}");
          break;
        case 'error':
          toastr.error("{{ Session::get('message') }}");
          break;
      }
    @endif
  </script>

</body>

</html>
