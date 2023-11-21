@extends('layouts.app')
@section('content')




					<form method="POST" action="{{ route('login') }}">
							@csrf
						<fieldset>
							<div class="form-group">
								<input class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control  @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" name="password" type="password" value="">
							</div>
							<div class="" style="display:flex;">
								<div class="checkbox" style="margin-top:0px;flex-grow:1">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">{{ __('Remember Me') }}
									</label>
								</div>
							</div>
							<button class="btn btn-primary btn-lg" type="submit" style="width:100%;">{{ __('Login') }}</button></fieldset>
					</form>
					<br>
					
					<div class="text-center" style="font-size:15px;font-weight:bold">
						<p><b><a href="{{ url('register') }}">{{ __('Register') }}</a>.</b></p>
					</div>



@endsection