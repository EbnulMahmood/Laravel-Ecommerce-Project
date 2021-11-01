@php
    $route = Route::current()->getName();
    $orders_count = DB::table('orders')->where('user_id', Auth::id())->count();
@endphp

<div class="sidebar sidebar-mobile" id="open-profile-sidebar">
  <div class="sidebar-content">

      <div class="sidebar-header clearfix d-lg-none">
          <button type="button" class="close toggle-show p-3" data-show="open-profile-sidebar" aria-label="Close">
              <i class="icon icon-cross font-size-lg"></i>
          </button>
      </div>

      <!-- Profile account links -->

      <div class="mb-4 px-4 p-lg-0">
          <ul class="list-group list-group-clean">

              <li class="list-group-item text-muted d-flex justify-content-between align-items-center">
                  <label class="pre-label">Account</label>
              </li>

              <li class="list-group-item {{ ($route == 'dashboard') ? 'active' : '' }}">
                  <a href="{{ route('dashboard') }}">
                      <div class="d-flex justify-content-between align-items-center">
                          <span><i class="icon icon-user mr-2"></i>
                              <span>Profile</span>
                          </span>
                      </div>
                  </a>
              </li>
              
              <li class="list-group-item {{ ($route == 'user.profile') ? 'active' : '' }}">
                  <a href="{{ route('user.profile') }}">
                      <div class="d-flex justify-content-between align-items-center">
                          <span><i class="icon icon-cog mr-2"></i>
                              <span>Profile Settings</span>
                          </span>
                      </div>
                  </a>
              </li>
              <!--
              <li class="list-group-item ">
                  <a href="profile-payment.html">
                      <div class="d-flex justify-content-between align-items-center">
                          <span><i class="icon icon-cart mr-2"></i>
                              <span>Paymnet methods</span>
                          </span>
                      </div>
                  </a>
              </li>

              <li class="list-group-item ">
                  <a href="profile-notifications.html">
                      <div class="d-flex justify-content-between align-items-center">
                          <span><i class="icon icon-alarm mr-2"></i>
                              <span>Notifications</span>
                          </span>
                      </div>
                  </a>
              </li>
              -->

          </ul>

      </div>

      <!-- Profile dashboard links -->

      <div class="mb-4 px-4 p-lg-0">
          <ul class="list-group list-group-clean">

              <li class="list-group-item text-muted d-flex justify-content-between align-items-center">
                  <label class="pre-label">Dashboard</label>
              </li>

              <li class="list-group-item {{ ($route == 'user.order') ? 'active' : '' }}">
                  <a href="{{ route('user.order') }}">
                      <div class="d-flex justify-content-between align-items-center">
                          <span><i class="icon icon-list mr-2"></i>
                              <span>Orders</span>
                          </span>
                          <span class="badge  badge-pill">{{ $orders_count }}</span>
                      </div>
                  </a>
              </li>
              <li class="list-group-item {{ ($route == 'user.wishlist') ? 'active' : '' }}">
                  <a href="{{ route('user.wishlist') }}">
                      <div class="d-flex justify-content-between align-items-center">
                          <span><i class="icon icon-heart mr-2"></i>
                              <span>Whishlist</span>
                          </span>
                          <span class="badge  badge-pill" id="wishlist-count"></span>
                      </div>
                  </a>
              </li>
          </ul>
      </div>

      <!-- Profile reset -->

      <div class="mb-4 px-4 p-lg-0">
          <ul class="list-group list-group-clean">

              <li class="list-group-item text-muted d-flex justify-content-between align-items-center">
                  <label class="pre-label">Access</label>
              </li>

              <li class="list-group-item {{ ($route == 'change.password') ? 'active' : '' }}">
                  <a href="{{ route('change.password') }}">
                      <div class="d-flex justify-content-between align-items-center">
                          <span><i class="icon icon-lock mr-2"></i>
                              <span>Reset password</span>
                          </span>
                      </div>
                  </a>
              </li>

              <li class="list-group-item">
                  <a href="{{ route('user.logout') }}">
                      <div class="d-flex justify-content-between align-items-center">
                          <span><i class="icon icon-enter-down mr-2"></i>
                              <span>Sign out</span>
                          </span>
                      </div>
                  </a>
              </li>

          </ul>

      </div>
  </div>
</div>