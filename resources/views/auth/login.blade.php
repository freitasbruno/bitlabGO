<form class="login-form-grid" method="POST" action="{{ route('login') }}">
	@csrf
	<div class="form-group">
		<input type="text" name="email" value="{{ $group->name ?? '' }}" class="form-control" data-field="name" autocomplete="off" required>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Enter your login email</label>
		@error('email')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-group">
		<input type="password" name="password" value="{{ $group->name ?? '' }}" class="form-control" data-field="password" autocomplete="off" required>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Enter your password</label>
		@error('password')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
		@enderror
	</div>
	<div class="form-check">
		<label class="checkboxLabel">
			<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
			<label class="checkboxLabel" for="remember"></label>
		</label>
		<p class="card-text-s">
			{{ __('Remember Me') }}
		</p>
	</div>
	<a href="{{ route('password.request') }}">
		{{ __('Forgot Your Password?') }}
	</a>

	<div class="form-btns">
		<button class="btn btn-submit" type="submit">Login</button>
	</div>
</form>