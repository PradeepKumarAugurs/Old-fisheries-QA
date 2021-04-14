@extends('layouts.app2')
@section('title') Forgot Password @endsection 
@section('bodyname') login-page @endsection 
@section('content')




<div class="login-box">

   
    @if(Session::has('msg'))
      {!!  Session::get("msg") !!}
    @endif

    
      <div class="login-logo">
        <img src="{{asset('images/logo/logo.png')}}" style="height:140px;  "/> 
        <a href="{{url('auth/login')}}"> Reset Password</a>
        <img /> 
      </div>
      @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
      @endif
      <div class="login-box-body">
        <!-- <p class="login-box-msg">{{ __('Reset Password') }}</p> -->
        <form action="{{ route('password.email') }}" method="post">  
        	{{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text"  name="email" class="form-control  @error('email') is-invalid @enderror " placeholder="Email" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
         
          <div class="row">
           
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Send Password Reset Link') }}</button>
            </div><!-- /.col -->
          </div>
        </form>

        <br/>
        <a href="{{url('auth/login')}}" class="text-center">I already have a membership</a>
        <!-- <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a><br>
        <a href="{{url('auth/register')}}" class="text-center">{{__('Register a new membership')}}</a> -->
 
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

@endsection

