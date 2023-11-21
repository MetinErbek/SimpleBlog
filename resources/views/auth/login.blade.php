@extends('layouts.app')
@section('content')


    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
          <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> {{ env('LOGO_TEXT_PART_ONE') }} <span class="tx-info"> {{ env('LOGO_TEXT_PART_SECOND', 'Login') }}</span> <span class="tx-normal">]</span></div>
          <div class="tx-center mg-b-60">{{ __('Login with your username and password') }}</div>

          <div class="form-group">
            <input type="text"  id="email" name="email" value="{{ old('email') }}"  class="form-control  @error('email') is-invalid @enderror" placeholder="{{ __('Enter your username') }}">
          </div><!-- form-group -->
          <div class="form-group">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Enter your password') }}">
            <a href="{{ route('password.request') }}" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
          </div><!-- form-group -->
          <button type="submit" class="btn btn-info btn-block">Sign In</button>
          <!--
          <div class="mg-t-60 tx-center">Not yet a member? <a href="" class="tx-info">Sign Up</a></div>
        -->
        </div><!-- login-wrapper -->
      </div><!-- d-flex -->
    </form>

@endsection