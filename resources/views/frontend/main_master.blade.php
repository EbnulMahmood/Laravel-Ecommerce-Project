<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Mobile Web-app fullscreen -->

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta tags -->

    <meta name="description" content="None">
    <meta name="author" content="None">
    <link rel="icon" href="{{ asset('frontend/assets/svg/favicon.ico') }}">

    <!-- Title -->

    <title>@yield('title')</title>

    <!-- Vendor stylesheets -->

    <link rel="stylesheet" media="all" href="{{ asset('frontend/assets/css/vendor/animate.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('frontend/assets/css/vendor/font-awesome.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('frontend/assets/css/vendor/linear-icons.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('frontend/assets/css/vendor/owl.carousel.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('frontend/assets/css/vendor/jquery.lavalamp.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('frontend/assets/css/custom.css') }}" />

    <!-- Template stylesheets -->
    <link rel="stylesheet" media="all" href="{{ asset('frontend/assets/css/style.css') }}" />

    <!-- Jquery cdn -->
    <script src="{{ asset('frontend/assets/js/vendor/jquery.min.js') }}"></script>

    <!-- Toastr cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Sweetalert2 cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>

    <!--HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

</head>

<body>
    <div class="loader">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    @include('frontend.includes.navbar')
    @include('frontend.includes.sidebar')

    @yield('content')

    @include('frontend.includes.footer')

    <!-- Vendor Scripts -->

    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/in-view.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery.lavalamp.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/owl.carousel.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/rellax.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/tabzy.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/isotope.pkgd.js') }}"></script>

    <!-- Template Scripts -->

    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <!-- toastr cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

    <!-- Modal -->
    
    @include('frontend.components.cart.addtocart_modal')

    <script>
    // Example POST method implementation:
    const postWishlistData = async function(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }

    function addToWishlist(product_id) {
        postWishlistData("{{ url('/whish/product/store') }}/" + product_id)
        .then(data => {
            getToastAlert(data)
        });
    }
    
    </script>

    </body>

</html>