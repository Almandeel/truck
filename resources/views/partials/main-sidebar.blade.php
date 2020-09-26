
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <img src="{{ asset('dashboard/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Taghrid</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @permission('dashboard-read')
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                لوحة التحكم
                            </p>
                        </a>
                    </li>
                @endpermission
                @permission('orders-read')
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                الطلبات
                            </p>
                        </a>
                    </li>
                @endpermission
                @permission('companies-read')
                    <li class="nav-item">
                        <a href="{{ route('companies.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                الشركات
                            </p>
                        </a>
                    </li>
                @endpermission
                @permission('vehicles-read')
                    <li class="nav-item">
                        <a href="{{ route('vehicles.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-car"></i>
                            <p>
                                المركبات
                            </p>
                        </a>
                    </li>
                @endpermission
                @permission('zones-read')
                    <li class="nav-item">
                        <a href="{{ route('zones.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-map"></i>
                            <p>
                                المناطق
                            </p>
                        </a>
                    </li>
                @endpermission
                @permission('units-read')
                    <li class="nav-item">
                        <a href="{{ route('units.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                الوحدات
                            </p>
                        </a>
                    </li>
                @endpermission
                @permission('users-read')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                @lang('global.users')
                            </p>
                        </a>
                    </li>
                @endpermission
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>