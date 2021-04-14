
@extends('layouts.app2')
@section('title') {{ __('Reset Password') }} @endsection 
@section('bodyname') register-page @endsection 
@section('content')
    <div class="register-box">
        @if(Session::has('msg'))
        {!!  Session::get("msg") !!}
        @endif
      <div class="login-logo">
        <a href="{{url('auth/login')}}"> Reset Password </a>
        <img /> 
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">{{ __('Reset Password') }}  </p>
        <form  action="{{ route('password.update') }}"  method="post">
            @csrf
            <input type="hidden" name="token" value="{{ Request::segment(4) }}">
          <div class="form-group has-feedback">
            <input type="text" class="form-control @error('email') is-invalid @enderror" readonly value="@if(Request::has('email')) {{ Request::input('email')}} @elseif(!empty(old('email'))) {{old('email')}} @endif "  name="email" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control @error('password') is-invalid @enderror " value="{{ old('password') }}" name="password" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror " value="{{ old('password_confirmation') }}" name="password_confirmation" placeholder="Retype password"/>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Reset Password') }}</button>
            </div><!-- /.col -->
          </div>
        </form>        

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div> -->

        <br/>
        <a href="{{url('auth/login')}}" class="text-center">I already have a membership</a>

      </div>
    </div>

@endsection