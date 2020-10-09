
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <img src="{{ asset('dashboard/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-1">
            @role('superadmin')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @permission('dashboard-read')
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link {{ (request()->segment(1) == '') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    لوحة التحكم
                                </p>
                            </a>
                        </li>
                    @endpermission
                    @permission('orders-read')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link {{ (request()->segment(1) == 'orders') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    الطلبات
                                    <i class="fas fa-angle-left left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('orders.index') }}?type=deactive" class="nav-link {{ (request()->segment(2) == 'type=deactive') ? 'active' : '' }}">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>الطلبات الجديدة</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('orders.index') }}?type=active" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>الطلبات الحالية</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('orders.index') }}?type=done" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>الطلبات المنتهية</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endpermission
                    @permission('companies-read')
                        <li class="nav-item">
                            <a href="{{ route('companies.index') }}" class="nav-link {{ (request()->segment(1) == 'companies') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    الشركات
                                </p>
                            </a>
                        </li>
                    @endpermission
                    @permission('vehicles-read')
                        <li class="nav-item">
                            <a href="{{ route('vehicles.index') }}" class="nav-link {{ (request()->segment(1) == 'vehicles') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-car"></i>
                                <p>
                                    المركبات
                                </p>
                            </a>
                        </li>
                    @endpermission
                    @permission('zones-read')
                        <li class="nav-item">
                            <a href="{{ route('zones.index') }}" class="nav-link {{ (request()->segment(1) == 'zones') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-map"></i>
                                <p>
                                    المناطق
                                </p>
                            </a>
                        </li>
                    @endpermission
                    @permission('units-read')
                        <li class="nav-item">
                            <a href="{{ route('units.index') }}" class="nav-link {{ (request()->segment(1) == 'units') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    الوحدات
                                </p>
                            </a>
                        </li>
                    @endpermission
                    @permission('pricings-read')
                        <li class="nav-item">
                            <a href="{{ route('pricings.index') }}" class="nav-link {{ (request()->segment(1) == 'pricings') ? 'active' : '' }}">
                                <i class="nav-icon fab fa-dollar"></i>
                                <p>
                                    الاسعار
                                </p>
                            </a>
                        </li>
                    @endpermission
                    @permission('users-read')
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ (request()->segment(1) == 'users') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    @lang('global.users')
                                </p>
                            </a>
                        </li>
                    @endpermission
                </ul>
            @endrole

            @role('customer')
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link {{ (request()->segment(1) == 'orders') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                الطلبات
                                <i class="fas fa-angle-left left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}?type=active" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>الطلبات الحالية</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}?type=done" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>الطلبات السابقة</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endrole

            @role('company')
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ (request()->segment(1) == 'orders') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            الطلبات
                            <i class="fas fa-angle-left left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}?type=deactive" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>الطلبات الجديدة</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}?type=active" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>الطلبات الحالية</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}?type=done" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>الطلبات المنتهية</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            @endrole
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>