<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Boltflow is an application designed to give you control over your data">
		<meta name="author" content="Bitlab - Bruno Freitas">

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
		<nav id="main-navbar" class="navbar-container">

			<div class="navbar-left">						
				<a href="/home"><i class="material-icons icon-btn white">offline_bolt</i></a>					
				<i class="material-icons icon-btn filter-link white toggleDisplayBtn">filter_list</i>	
				<i class="material-icons icon-btn filter-link white hidden toggleDisplayBtn">list</i>	
			</div>

			<div class="navbar-center">
				<a class="navbar-logo" href="#">BOLTFLOW</a>
			</div>

			<!-- Authentication Links -->	
			@auth					
			<div class="navbar-right">
				<i class="material-icons icon-btn white">account_circle</i>
				<ul class="navbar-menu">
					<li>
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
						</a>							
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>						
					</li>						
					<li id="session-details">
						<a href="/session" target="blank">
							Session
						</a>
					</li>						
				</ul>
			</div>
			@endauth
			<!-- Authentication Links -->

		</nav>
		<!-- /#Top bar -->

		@yield('content')
		
	</body>

</html>