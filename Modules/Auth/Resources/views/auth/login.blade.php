@extends('layouts.app2')
@section('title') Login @endsection 
@section('bodyname') login-page @endsection 
@section('content')
<!-- <div class="row">
   <div class="col-md-offset-2 col-md-8">
   <img src="{{url('images/logo/logo.png')}}" style="height:300px;  "/>
   </div>
</div>  -->
<div class="login-box">


    @if(Session::has('msg'))
      {!!  Session::get("msg") !!}
    @endif

      <div class="login-logo">
        <img src="{{asset('images/logo/logo.png')}}" style="height:140px;  "/> 
        <a href="{{url('auth/login')}}">{{ ucfirst(config('app.name', '')) }} Login</a>
      </div>
      <div class="login-box-body">
        <!-- <p class="login-box-msg">FisheriesQA Login</p> -->
        <form action="{{ url('auth/login') }}" method="post">  <!--dashboard-->
        	{{ csrf_field() }}
          <div class="form-group has-feedback">
            <input type="text"  name="email"  class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror " placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="row">
            <div class="col-xs-8">    
            
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

    

        <p><b><a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a><b></p>
        <p><b><a href="{{url('auth/register')}}" class="text-center">{{__('Register a new User.')}}</a></b></p>
 
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

@endsection