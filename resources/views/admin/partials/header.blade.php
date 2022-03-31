<div class="header">

	<div class="header-left">
		<a href="{{route('dashboard')}}" class="logo">
			<img src="{{ asset('img')}}/logo.png" alt="Logo">
		</a>
		<a href="{{route('dashboard')}}" class="logo logo-small">
			<img src="{{ asset('img')}}/logo-small.png" alt="Logo" width="30" height="30">
		</a>
	</div>

	<a href="javascript:void(0);" id="toggle_btn">
		<i class="fas fa-bars"></i>
	</a>
	<a class="mobile_btn" id="mobile_btn">
		<i class="fas fa-bars"></i>
	</a>

	<ul class="nav nav-tabs user-menu">
		<li class="nav-item dropdown has-arrow main-drop nav-profile-box">
			<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
				<span class="user-img">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="-42 0 512 512"  class="user-img-svg">
						<path d="m210.35 246.63c33.883 0 63.223-12.152 87.195-36.129 23.973-23.973 36.125-53.305 36.125-87.191 0-33.875-12.152-63.211-36.129-87.191-23.977-23.969-53.312-36.121-87.191-36.121-33.887 0-63.219 12.152-87.191 36.125s-36.129 53.309-36.129 87.188c0 33.887 12.156 63.223 36.133 87.195 23.977 23.969 53.312 36.125 87.188 36.125z"/>
						<path d="m426.13 393.7c-0.69141-9.9766-2.0898-20.859-4.1484-32.352-2.0781-11.578-4.7539-22.523-7.957-32.527-3.3086-10.34-7.8086-20.551-13.371-30.336-5.7734-10.156-12.555-19-20.164-26.277-7.957-7.6133-17.699-13.734-28.965-18.199-11.227-4.4414-23.668-6.6914-36.977-6.6914-5.2266 0-10.281 2.1445-20.043 8.5-6.0078 3.918-13.035 8.4492-20.879 13.461-6.707 4.2734-15.793 8.2773-27.016 11.902-10.949 3.543-22.066 5.3398-33.039 5.3398-10.973 0-22.086-1.7969-33.047-5.3398-11.211-3.6211-20.297-7.625-26.996-11.898-7.7695-4.9648-14.801-9.4961-20.898-13.469-9.75-6.3555-14.809-8.5-20.035-8.5-13.312 0-25.75 2.2539-36.973 6.6992-11.258 4.457-21.004 10.578-28.969 18.199-7.6055 7.2812-14.391 16.121-20.156 26.273-5.5586 9.7852-10.059 19.992-13.371 30.34-3.1992 10.004-5.875 20.945-7.9531 32.523-2.0586 11.477-3.457 22.363-4.1484 32.363-0.67969 9.7969-1.0234 19.965-1.0234 30.234 0 26.727 8.4961 48.363 25.25 64.32 16.547 15.746 38.441 23.734 65.066 23.734h246.53c26.625 0 48.512-7.9844 65.062-23.734 16.758-15.945 25.254-37.586 25.254-64.324-0.003906-10.316-0.35156-20.492-1.0352-30.242z"/>
					</svg>
					<span class="status online"></span>
				</span>
				<span>{{ ucfirst(Auth::user()->name) }}</span>
			</a>
			<div class="dropdown-menu">
				@can('user-profile-access')
					<!-- <a class="dropdown-item" href="{{ route('users.profile') }}"><i data-feather="user" class="me-1"></i> Profile</a> -->
				@endcan
				@can('change-setting')
					<a class="dropdown-item" href="#"><i class="fas fa-cogs me-1"></i> Settings</a>
				@endcan
				@can('user-change-password')
					<a class="dropdown-item" href="#"><i class="fas fa-lock me-1"></i> Change Password</a>
				@endcan
				<form method="POST" id="loginSubmit" action="{{ route('logout') }}">
					@csrf
					<button type="submit" class="dropdown-item"> 
						<i data-feather="log-out" class="me-1"></i> Logout
					</button>	
				</form>
			</div>
		</li>
	</ul>

</div>