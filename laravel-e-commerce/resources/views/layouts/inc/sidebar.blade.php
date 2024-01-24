<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="{{ url('/') }}" class="simple-text logo-normal">
            E-Shop
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('categories') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('categories') }}">
                    <i class="material-icons">person</i>
                    <p>Categories</p>
                </a>
            </li>
            <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('add-category') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('add-category') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Add Category</p>
                </a>
            </li>
            <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('products') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('products') }}">
                    <i class="material-icons">person</i>
                    <p>Products</p>
                </a>
            </li>
            <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('add-product') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('add-product') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Add Product</p>
                </a>
            </li>
        </ul>
    </div>
</div>
