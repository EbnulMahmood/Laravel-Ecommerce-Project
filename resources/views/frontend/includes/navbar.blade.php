@php
    $topcategories = DB::table('categories')->orderBy('category_name_en', 'ASC')->limit(3)->get();
@endphp

<!-- Navigation -->
    
<nav class="navbar navbar-sticky fixed-top navbar-expand-lg py-2">
    <div class="container">
  
        <a class="navbar-brand text-dark" href="{{ route('home') }}">
            <i class="icon icon-layers"></i>
            <strong>Reveal</strong>
        </a>
  
        <div class="d-flex d-lg-none">
            <ul class="navbar-nav flex-row">
                @auth
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="d-flex nav-link">
                        <div class="px-2 py-1">Profile</div>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="d-flex nav-link">
                        <div class="px-2 py-1">Login</div>
                    </a>
                </li>
                @endauth
                <li class="nav-item">
                    <a href="#" class="d-flex nav-link toggle-show" data-show="cartComponent">
                        <div class="px-2 py-1">Cart <sup id="cart-qty"></sup></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="d-flex nav-link toggle-show" data-show="searchComponent">
                        <div class="px-2 py-1"><span class="icon icon-magnifier"></span></div>
                    </a>
                </li>
                <li class="nav-item">
                    @if(session()->get('language') == 'bangla')       
                        <a href="{{ route('english.language') }}" class="d-flex nav-link"><div class="px-2 py-1">English</div></a>
                    @else
                        <a href="{{ route('bangla.language') }}" class="d-flex nav-link"><div class="px-2 py-1">বাংলা</div></a>
                    @endif
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="furnitureNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon icon-menu"></span>
            </button>
        </div>
  
        <!-- Navbar collapse -->
  
        <div class="navbar-collapse collapse navbar-collapse-sidebar" id="mainNavbar">
  
            <!-- Mobile search -->
  
            <div class="d-block d-lg-none">
                <div class="p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="icon icon-layers"></i>
                            <strong>Reveal</strong>
                        </div>
                        <button class="btn p-0" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon icon-cross font-size-lg"></span>
                        </button>
                    </div>
                </div>
                <div class="bg-light">
                    <div class="form-group form-group-icon">
                        <input type="text" class="form-control form-control-simple" placeholder="Search site">
                        <button class="btn btn-clean"><i class="icon icon-magnifier"></i></button>
                    </div>
                </div>
            </div>
  
            <ul class="navbar-nav ml-auto align-items-lg-center">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">
                        {{ (session()->get('language') == 'bangla') ? 'হোম' : 'Home' }}
                    <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown px-lg-3">
                    <a class="nav-link dropdown-toggle" href="{{ route('shop.product') }}" id="dropdown-shop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ (session()->get('language') == 'bangla') ? 'দোকান' : 'Shop' }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-shop">
                        <a class="dropdown-item" href="{{ route('shop.product') }}">
                            {{ (session()->get('language') == 'bangla') ? 'দোকান' : 'Shop' }}
                        </a>
                        <a class="dropdown-item" href="{{ route('my.cart') }}">
                            {{ (session()->get('language') == 'bangla') ? 'কার্ট' : 'Cart' }}
                        </a>
                        <a class="dropdown-item" href="{{ route('checkout') }}">
                            {{ (session()->get('language') == 'bangla') ? 'চেকআউট' : 'Checkout' }}
                        </a>
                        <a class="dropdown-item" href="#">
                            {{ (session()->get('language') == 'bangla') ? 'পণ্য' : 'Product' }}
                        </a>
                    </div>
                </li>
                @foreach ($topcategories as $category)
                    <!-- Mega dropdown -->
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="ecommerce" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ (session()->get('language') == 'bangla') ? $category->category_name_bn : $category->category_name_en }}
                        </a>
    
                        <div class="dropdown-menu w-100 bg-white border-top" aria-labelledby="ecommerce">
                            <div class="py-3 px-lg-4 py-lg-5">
                                <div class="container d-block p-0">
                                    <div class="row">
                                        @php
                                            $topsubcategories = DB::table('sub_categories')->where('category_id', $category->id)->orderBy('subcategory_name_en', 'ASC')->limit(4)->get();
                                        @endphp
                                        @foreach ($topsubcategories as $subcategory)
                                            <div class="col-lg-3">
        
                                                <div class="pre-label p-2">
                                                    {{ (session()->get('language') == 'bangla') ? $subcategory->subcategory_name_bn : $subcategory->subcategory_name_en }}
                                                </div>
                                                @php
                                                    $topsubsubcategories = DB::table('sub_sub_categories')->where('subcategory_id', $subcategory->id)->orderBy('subsubcategory_name_en', 'ASC')->limit(10)->get();
                                                @endphp
                                                @foreach ($topsubsubcategories as $subsubcategory)
                                                    <a class="dropdown-item rounded-sm" href="#">
                                                        <p>
                                                            {{ (session()->get('language') == 'bangla') ? $subsubcategory->subsubcategory_name_bn : $subsubcategory->subsubcategory_name_en }}
                                                        </p>
                                                        {{-- <span class="label">Cards grid preview</span> --}}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
                @auth
                <li class="nav-item d-none d-lg-inline ml-lg-5">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <span class="icon icon-user"></span>
                    </a>
                </li>
                @else
                <li class="nav-item d-none d-lg-inline ml-lg-5">
                    <a href="{{ route('login') }}" class="nav-link">
                        <span class="icon icon-exit-up"></span>
                    </a>
                </li>
                @endauth
                <li class="nav-item d-none d-lg-inline">
                    <a href="#" class="nav-link toggle-show d-flex" data-show="cartComponent">
                        <div class="px-2 py-1">
                            <span class="icon icon-cart"></span>
                            <sup id="cart-qty-icon"></sup>
                        </div>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-inline">
                    <a href="#" class="nav-link toggle-show" data-show="searchComponent">
                        <span class="icon icon-magnifier"></span>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-inline">
                    @if(session()->get('language') == 'bangla')       
                        <a href="{{ route('english.language') }}" class="nav-link"><span>English</span></a>
                    @else
                        <a href="{{ route('bangla.language') }}" class="nav-link"><span>বাংলা</span></a>
                    @endif
                </li>
            </ul>
        </div>
  
    </div>
  </nav>