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
		<script src="{{ asset('js/app.js') }}" defer></script>

		<!-- Custom Styles -->
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">

	</head>

	<body>
		<!-- Top bar -->
		<nav id="welcome-navbar" class="navbar-container">

			<div class="navbar-left">						
				<a href="/home"><i class="material-icons">offline_bolt</i></a>						
			</div>

			<div class="navbar-center">
				<a class="navbar-logo" href="#">BOLTFLOW</a>
			</div>

			<!-- Authentication Links -->	
			<div class="navbar-right">
				@auth
					<a href="{{ url('/home') }}">Home</a>
				@else
					<a href="#" id="loginBtn">Login</a>
					<a href="{{ route('register') }}">Register</a>
				@endauth
			</div>
			<!-- Authentication Links -->

		</nav>
		<!-- /#Top bar -->

		@yield('content')
				
		<!-- Modals -->
		@include('modal')
	</body>

</html>
