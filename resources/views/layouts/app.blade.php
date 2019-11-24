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
		<script src="{{ asset('js/uikit/uikit.min.js') }}" defer></script>
		<script src="{{ asset('js/uikit/uikit-icons.min.js') }}" defer></script>

		<!-- Custom Scripts -->
		<script src="{{ asset('js/home.js') }}" defer></script>

		<!-- Custom Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">

		<!-- FontAwesome icons kit -->
		<script src="https://kit.fontawesome.com/7015b7b51b.js" crossorigin="anonymous"></script>

	</head>

	<body>
			<!-- Top bar -->
			<div
				uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
				<nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;">
					<div class="uk-navbar-left">
						<a class="uk-navbar-item uk-logo" href="#">BOLTFLOW</a>
						<ul class="uk-navbar-nav">
							<li class="uk-active"><a href="#">Active</a></li>
							<li>
								<a href="#">Parent</a>
								<div class="uk-navbar-dropdown">
									<ul class="uk-nav uk-navbar-dropdown-nav">
										<li class="uk-active"><a href="#">Active</a></li>
										<li><a href="#">Item</a></li>
										<li><a href="#">Item</a></li>
									</ul>
								</div>
							</li>
							<li><a href="#">Item</a></li>
						</ul>
					</div>

					<!-- Authentication Links -->	
					@auth					
					<div class="uk-navbar-right">
						<ul class="uk-navbar-nav">
							<li><a href="">{{ Auth::user()->name }}</a>
								<div class="uk-navbar-dropdown">
									<ul class="uk-nav uk-navbar-dropdown-nav">
										<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
											{{ __('Logout') }}</a></li>								
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										</li>
									</ul>
								</div>						
							</li>						
						</ul>
					</div>
					@endauth
					<!-- Authentication Links -->

				</nav>
			</div>
		</div>
		<!-- /#Top bar -->

		@yield('content')
		
	</body>

</html>