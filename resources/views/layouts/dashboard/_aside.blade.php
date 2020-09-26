<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->username }}</p>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ (request()->segment(1) == '') ? 'active' : '' }}"><a href="{{ route('dashboard.index') }}"><i class="fa fa-th"></i><span>  Dashboard </span></a></li>
            <li class="{{ (request()->segment(1) == 'users') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span>  Users </span></a></li>
            <li class="{{ (request()->segment(1) == 'markets') ? 'active' : '' }}"><a href="{{ route('markets.index') }}"><i class="fa fa-home"></i><span>  Markets </span></a></li>
            <li class="{{ (request()->segment(1) == 'warehouses') ? 'active' : '' }}"><a href="{{ route('warehouses.index') }}"><i class="fa fa-home"></i><span>  Warehouses </span></a></li>
            <li class="{{ (request()->segment(1) == 'drivers') ? 'active' : '' }}"><a href="{{ route('drivers.index') }}"><i class="fa fa-car"></i><span>  Drivers </span></a></li>
        </ul>

    </section>

</aside>