<form class="login-form-grid" method="POST" action="{{ route('register') }}">
	@csrf

	<div class="form-group">
		<input id="name" type="text" class="form-control" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" data-field="name" autocomplete="off" required>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Enter your name</label>
		@error('name')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="form-group">
		<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Enter your login email</label>
		@error('email')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="form-group">
		<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Enter your password</label>
		@error('password')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>

	<div class="form-group">
		<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Confirm your password</label>
	</div>

	<div class="form-btns">
		<button class="btn btn-submit" type="submit">Register</button>
	</div>

</form>