<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ is_active('admin.home') }}">
                    <a  href="{{ route('admin.home') }}"><i data-feather="home"></i> <span>Dashboard</span></a>
                </li>
                @if(Auth::user()->hasRole('admin'))
                <li class="submenu {{ is_active('admin.permissions*') }} {{ is_active('admin.roles*') }} {{ is_active('admin.users*') }}">
                    <a href="#" class="{{ is_active('admin.permissions*') }} {{ is_active('admin.roles*') }} {{ is_active('admin.users*') }}"> <i data-feather="users"></i><span> User Managment</span> <span class="menu-arrow"></span></a>
                    <ul>
                        @can('permission-browse')
                            <li><a class="{{ is_active('admin.permissions*') }}" href="{{ route('admin.permissions.index') }}"><i class="fas fa-user-shield"></i> Permissions</a></li>
                        @endcan
                        @can('role-browse')
                            <li><a class="{{ is_active('admin.roles*') }}" href="{{ route('admin.roles.index') }}"><i class="fas fa-user-tag"></i> Roles</a></li>
                        @endcan
                        @can('user-browse')
                            <li><a class="{{ is_active('admin.users*') }}" href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i> Users</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @can('change-setting')
                <li class="{{ is_active('admin.settings.change') }}">
                    <a  href="{{ route('admin.settings.change') }}"><i class="fas fa-cogs me-1"></i> <span>Setting</span></a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
