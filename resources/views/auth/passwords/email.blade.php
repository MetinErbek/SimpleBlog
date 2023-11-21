@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('password.email') }}">
	@csrf
	<fieldset>
	
	@if (session('status'))
		<div class="alert alert-success" role="alert">
			{{ session('status') }}
		</div>
	@endif
	<div class="form-group ">
		<label for="email" class="">{{ __('E-Mail Address') }}</label>

		
		<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
			value="{{ old('email') }}" required autocomplete="email" autofocus>

	
	</div>

	<div class="form-group  mb-0">
		
			<button style="width:100%;" type="submit" class="btn btn-primary">
				{{ __('Send Password Reset Link') }}
			</button>
	
	</div>
	</fieldset>
	<br>
	<div class="text-center" style="font-size:15px;font-weight:bold">
		<p><b>{{ __('Giriş sayfasına gitmek için') }} <a href="{{ url('login') }}">{{ __('Tıklayınız') }}</a>.</b></p>
	</div>
	<br>
	
</form>



@endsection
