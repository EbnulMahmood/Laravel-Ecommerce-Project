    <!-- Sidebar cart -->
  
  <nav id="cartComponent" class="sidebar sidebar-right bg-white border-left">
    <div class="sidebar-content">
  
        <!-- Sidebar header -->
  
        <div class="sidebar-header px-3 pt-3">
            <button type="button" class="toggle-show close" data-show="cartComponent">
                <span class="icon icon-cross"></span>
            </button>
            <a href="{{ route('my.cart') }}" class="link link-right link-info">Shopping cart</a>
        </div>
  
        <hr />
  
        <!-- Sidebar items -->
  
        @include('frontend.components.cart.cart_component')
  
    </div>
  </nav>
  
  <!-- Sidebar search -->
  
  <nav id="searchComponent" class="sidebar sidebar-right bg-white border-left">
    <div class="sidebar-content">
        <div class="sidebar-header px-3 pt-3">
            <button type="button" class="toggle-show close" data-show="searchComponent">
                <span class="icon icon-cross"></span>
            </button>
            <div>Search content</div>
        </div>
        <hr />
        <div class="p-4">
            <form action="{{ route('search.product') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label class="label" for="searchContent">Enter keyword</label>
                    <input type="text" name="search" class="form-control form-control-simple" id="searchContent" placeholder="Search key words like furniture, sofa...">
                </div>
                <div class="row justify-content-center pt-3">
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-sm btn-block btn-dark btn-rounded px-5">Search the site</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </nav>