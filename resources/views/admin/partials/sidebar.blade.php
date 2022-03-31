<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ is_active('admin.home') }}">
                    <a  href="{{ route('admin.home') }}"><i data-feather="home"></i> <span>Dashboard</span></a>
                </li>
                {{--@if(Auth::user()->hasRole('admin')) --}}
                <li class="submenu {{ is_active('permissions*') }} {{ is_active('roles*') }} {{ is_active('users*') }}">
                    <a href="#" class="{{ is_active('permissions*') }} {{ is_active('roles*') }} {{ is_active('users*') }}"> <i data-feather="users"></i><span> User Managment</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <!-- @can('permission-browse')
                            <li><a class="{{ is_active('permissions*') }}" href="{{ route('permissions.index') }}"><i class="fas fa-user-shield"></i> Permissions</a></li>
                        @endcan -->
                        @can('role-browse')
                            <li><a class="{{ is_active('roles*') }}" href="#"><i class="fas fa-user-tag"></i> Roles</a></li>
                        @endcan
                        @can('user-browse')
                            <li><a class="{{ is_active('users*') }}" href="#"><i class="fas fa-users"></i> Users</a></li>
                        @endcan
                    </ul>
                </li>
                {{-- @endif --}}
            </ul>
        </div>
    </div>
</div>
