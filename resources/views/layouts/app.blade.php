<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>BoltFlow</title>

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Bootstrap core JavaScript -->
		<script src="{{ asset('js/jquery/jquery.min.js') }}" defer></script>

		<!-- Custom Scripts -->
		<script src="{{ asset('js/home.js') }}" defer></script>
		{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

		<!-- Custom Styles -->
		{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" />

	</head>

	<body>
		<!-- Top bar -->
		<div id="main-navbar">
			<nav class="navbar-container">

				<div class="navbar-left">						
					<a href="/home"><i class="material-icons white">offline_bolt</i></a>					
					{{-- <i class="material-icons filter-link" data-url="cash">attach_money</i>					
					<i class="material-icons filter-link" data-url="tasks">done</i>					
					<i class="material-icons filter-link" data-url="timers">timer</i>					
					<i class="material-icons filter-link" data-url="bookmarks">bookmark_border</i> --}}
				</div>

				<div class="navbar-center">
					<a class="navbar-logo" href="#">BOLTFLOW</a>
				</div>

				<!-- Authentication Links -->	
				@auth					
				<div class="navbar-right">
					<img class="icon-30" src="/images/prototype/boy.svg" alt="User menu">
					<ul class="navbar-menu">
						<li>
							<a href="{{ route('logout') }}" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
										<i class="material-icons-outlined group-card-action" data-action="logout">exit_to_app</i>
										{{ __('Logout') }}
							</a>							
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>						
						</li>						
						<li id="session-details">
							<a href="/session">
								<i class="material-icons-outlined group-card-action" data-action="session">data_usage</i>
								Session
							</a>
						</li>						
					</ul>
				</div>
				@endauth
				<!-- Authentication Links -->

			</nav>
		</div>
		<!-- /#Top bar -->

		@yield('content')
		
	</body>

</html>