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
		<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}" defer></script>		
		<script src="{{ asset('js/bootstrap/bootstrap-select.min.js') }}" defer></script>
		
		<!-- Custom Scripts -->
		<script src="{{ asset('js/custom.js') }}" defer></script>
		<script src="{{ asset('js/app.js') }}" defer></script>

		<!-- Bootstrap core CSS -->
		<link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/bootstrap/bootstrap-select.min.css') }}" rel="stylesheet">

		<!-- Custom Styles -->
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">

		<!-- FontAwesome icons kit -->
		<script src="https://kit.fontawesome.com/7015b7b51b.js" crossorigin="anonymous"></script>

	</head>

  	<body>
	  	<div id="app">
			<!-- Top bar -->
			<div class="navbar navbar-expand-lg static-top">
				<!-- Logo container -->
				<div>
					<a href="index.html" class="navbar-brand">
						BoltFlow
					</a>             
				</div>
				<!-- /#Logo container -->

				<!-- Right Side Of Navbar -->
				<ul class="navbar-nav ml-auto">
					<!-- Authentication Links -->
					@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@if (Route::has('register'))
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
							</li>
						@endif
					@else
						<li class="nav-item">
							<a>{{ Auth::user()->name }} <span class="caret"></span></a>

							<a href="{{ route('logout') }}"
								onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>

						</li>
					@endguest
				</ul>
				
				<button class="navbar-toggler" type="button" id="menu-toggle">
					<i class="fas fa-bars dark right"></i>
				</button>
			</div>
			<!-- /#Top bar -->

			<main class="py-4">
				@yield('content')
			</main>
		</div>
  	</body>

</html>