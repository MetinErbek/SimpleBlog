@extends('layouts.app')

@section('content')
<div class="">    

    <div class="col-md-12">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                    <label for="name" class="">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                
            </div>

            <div class="form-group ">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
             
            </div>

            <div class="form-group">
                <label for="password" >{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group mb-0">
                <button type="submit" style="width:100%" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
            <br>
					
					<div class="text-center" style="font-size:15px;font-weight:bold">
						<p><b><a href="{{ url('login') }}">{{ __('Login') }}</a>.</b></p>
					</div>
        </form>
    </div>

</div>

@endsection
