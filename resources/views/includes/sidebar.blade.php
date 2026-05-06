<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             @if(Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route("admin.dashboard") }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Category</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('product.index') }}" class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Product</p>
                        </a>
                    </li>

                   <li class="nav-item">
                        <a href="{{ route('admin.orders') }}" class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Orders</p>
                        </a>
                   </li>

                     <li class="nav-item">
                            <a href="{{ route('admin.stock') }}" class="nav-link {{ request()->routeIs('admin.stock') ? 'active' : '' }}">
                             <i class="nav-icon fas fa-warehouse"></i>
                             <p>Stock</p>
                            </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admin.users.index')}}" class="nav-link {{Request::is('admin/users*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Users</p>
                        </a>
                    </li>

                    
                    <hr class="border-secondary">

                    <li class="nav-item">
                            <a href="{{ route('home-page') }}" class="nav-link">
                                <i class="nav-icon fas fa-globe"></i>
                                    <p>Lihat Marketplace</p>
                            </a>
                    </li>

                    @endif

                </ul>
            </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
