
@extends('layouts.app2')
@section('title') Registration @endsection 
@section('bodyname') register-page @endsection 
@section('content')
    <div class="register-box">
        @if(Session::has('msg'))
        {!!  Session::get("msg") !!}
        @endif
      <div class="login-logo">
        <img src="{{asset('images/logo/logo.png')}}" style="height:140px;  "/> 
        <a href="{{url('auth/login')}}">{{ ucfirst(config('app.name', '')) }} Registration</a>
        <img /> 
      </div>

      <div class="register-box-body">
        <!-- <p class="login-box-msg"><b>Register a new User</b></p> -->
        <form  action="{{ route('register') }}"  method="post">
            @csrf
          <div class="form-group has-feedback">
            <input type="text" class="form-control @error('name') is-invalid @enderror " value="{{ old('name') }}"  name="name" placeholder="Name" />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <!--<div class="form-group has-feedback">
            <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"  name="username" placeholder="Username"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>-->
          <div class="form-group has-feedback">
            <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  name="email" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group has-feedback">
              <input type="text" maxlength="10" onkeypress="return restrictAlphabets(event)" name="mobile_no" id="mobile_no" value="{{old('mobile_no')}}" class="form-control @error('mobile_no') is-invalid @enderror" placeholder="Enter Mobile Number">
              <span class="glyphicon glyphicon-phone form-control-feedback"></span>
              @error('mobile_no')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <div class="form-group has-feedback">
              <input type="text"  name="company" id="company" value="{{old('company')}}" class="form-control @error('company') is-invalid @enderror" placeholder="Enter Company Name">
              <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
              @error('company')
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
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="agree" class="@error('agree') is-invalid @enderror" @if(old('agree')) checked @endif > I agree to the <a href="{{asset('Privacy-Policy.pdf')}}" target="_blank"> privacy policy</a>
                </label>
                <label for="error">
                  @error('agree')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </label>
               
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
          </div>
        </form>        

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div> -->

        <a href="{{url('auth/login')}}" class="text-center">I already have User.</a>
      </div>
    </div>

@endsection