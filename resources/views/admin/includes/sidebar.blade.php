@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<div id="sidebar" class="active">
  <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="index.html"><img src="{{ asset('backend/assets/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>
            
            <li class="sidebar-item {{ ($route == 'dashboard') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ ($route == 'admin.profile') ? 'active' : '' }}">
                <a href="{{ route('admin.profile') }}" class='sidebar-link'>
                    <i class="bi bi-person-circle"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item  has-sub {{ ($prefix == '/brand') ? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-list"></i>
                    <span>Brands</span>
                </a>
                <ul class="submenu {{ ($prefix == '/brand') ? 'active' : '' }}">
                    <li class="submenu-item {{ ($route == 'all.brand') ? 'active' : '' }}">
                        <a href="{{ route('all.brand') }}">All Brand</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub {{ ($prefix == '/category') ? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-list"></i>
                    <span>Categories</span>
                </a>
                <ul class="submenu {{ ($prefix == '/category') ? 'active' : '' }}">
                    <li class="submenu-item {{ ($route == 'all.category') ? 'active' : '' }}">
                        <a href="{{ route('all.category') }}">All Main Category</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'all.subcategory') ? 'active' : '' }}">
                        <a href="{{ route('all.subcategory') }}">Parent Subcategory</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'all.subsubcategory') ? 'active' : '' }}">
                        <a href="{{ route('all.subsubcategory') }}">Child Subcategory</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub {{ ($prefix == '/product') ? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-list"></i>
                    <span>Products</span>
                </a>
                <ul class="submenu {{ ($prefix == '/product') ? 'active' : '' }}">
                    <li class="submenu-item {{ ($route == 'manage.product') ? 'active' : '' }}">
                        <a href="{{ route('manage.product') }}">All Products</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'add.product') ? 'active' : '' }}">
                        <a href="{{ route('add.product') }}">Add Product</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub {{ ($prefix == '/coupon') ? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-list"></i>
                    <span>Coupons</span>
                </a>
                <ul class="submenu {{ ($prefix == '/coupon') ? 'active' : '' }}">
                    <li class="submenu-item {{ ($route == 'manage.coupon') ? 'active' : '' }}">
                        <a href="{{ route('manage.coupon') }}">All Coupons</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub {{ ($prefix == '/shipping') ? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-list"></i>
                    <span>Shipping</span>
                </a>
                <ul class="submenu {{ ($prefix == '/shipping') ? 'active' : '' }}">
                    <li class="submenu-item {{ ($route == 'manage.division') ? 'active' : '' }}">
                        <a href="{{ route('manage.division') }}">Division</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'manage.district') ? 'active' : '' }}">
                        <a href="{{ route('manage.district') }}">District</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'manage.state') ? 'active' : '' }}">
                        <a href="{{ route('manage.state') }}">State</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub {{ ($prefix == '/order') ? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-list"></i>
                    <span>Orders</span>
                </a>
                <ul class="submenu {{ ($prefix == '/order') ? 'active' : '' }}">
                    <li class="submenu-item {{ ($route == 'pending.order') ? 'active' : '' }}">
                        <a href="{{ route('pending.order') }}">Pending Orders</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'confirmed.order') ? 'active' : '' }}">
                        <a href="{{ route('confirmed.order') }}">Confirmed Order</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'processing.order') ? 'active' : '' }}">
                        <a href="{{ route('processing.order') }}">Processing Order</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'picked.order') ? 'active' : '' }}">
                        <a href="{{ route('picked.order') }}">Picked Order</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'shipped.order') ? 'active' : '' }}">
                        <a href="{{ route('shipped.order') }}">Shipped Order</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'delivered.order') ? 'active' : '' }}">
                        <a href="{{ route('delivered.order') }}">Delivered Order</a>
                    </li>
                    <li class="submenu-item {{ ($route == 'canceled.order') ? 'active' : '' }}">
                        <a href="{{ route('canceled.order') }}">Canceled Order</a>
                    </li>
                </ul>
            </li>
            
            <li class="sidebar-title">Forms &amp; Tables</li>
            
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-gear-fill"></i>
                    <span>Settings</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.change.password') }}">Change Password</a>
                    </li>
                </ul>
            </li>
            
            <li class="sidebar-title">Raise Support</li>

            <li class="sidebar-item ">
                <a href="{{ route('admin.logout') }}" class='sidebar-link'>
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
  </div>
</div>