@extends('layouts.app')
@section('title') <title>Users List </title> 
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        @if(Auth::user()->role=='1')
            Admin
        @elseif(Auth::user()->role=='2')
            Supplier
        @elseif(Auth::user()->role=='3')
            Producer 
        @elseif(Auth::user()->role=='4')
        Supplier and Producer
        @elseif(Auth::user()->role=='5')
        Inspector 
        @elseif(Auth::user()->role=='6')
        New User 
        @else
        Other
        @endif

        - {{ Auth::user()->name }}

        Profile
      </h1>

      <!-- <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{url('technician')}}">Technician</a></li>
            <li class="active" ><a href="{{url('Profile/')}}">Driver details</a></li>
      </ol> -->

      <!-- @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
        
        <!-- /.col -->
        <div class="col-md-6">
            @if(Session::has('msg'))
              {!!  Session::get("msg") !!}
           @endif
            <div class="box box-primary" style="min-height:445px;">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Basic Info</h3> -->
              
            </div>
            <div>
              <div class="timeline-body pre-wrp">
                <form class="form-group" action="{{url('update_profile')}}" method="post">
                  @csrf
                  <fieldset>
                    <legend>&nbsp;&nbsp;Update Information</legend>

                     <div class="col-md-6">
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" name="name" onkeypress="return restrictNumerics(event);" value="{{$user_data->name}}" class="form-control" placeholder="Enter Name">

                        </div>
                     </div>
                    
                     <div class="col-md-6">
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" name="username" value="{{$user_data->username}}"  class="form-control" placeholder="Enter Username">
                        </div>
                     </div>
                     
                     <div class="col-md-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email"  name="email" value="{{$user_data->email?$user_data->email:''}}" readonly class="form-control" >
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                          <label>Mobile Number</label>
                          <input type="text" name="mobile_no" onkeypress="return restrictAlphabets(event);" value="{{$user_data->mobile_no?$user_data->mobile_no:''}}" maxlength="10" class="form-control" placeholder="Enter Mobile Number">
                        </div>
                     </div>
                     <div class="col-md-offset-6 col-md-3">
                       <div class="form-group">
                          <label></label>
                          <button class="btn btn-primary btn-block">Update</button>
                        </div>
                     </div>
                   </fieldset>
                </form>

               
                    
              </div>
             </div>
            </div>
        </div>

        <div class="col-md-6">
           @if(Session::has('msgp'))
              {!!  Session::get("msgp") !!}
           @endif
           
          <div class="box box-primary" style="min-height:245px;">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">About</h3> -->
            </div>
            <div>
              <div class="timeline-body pre-wrp">
                  <form class="form-group" action="{{url('update_password')}}" method="post">
                    @csrf
                    <fieldset>
                      <legend>&nbsp;&nbsp;Change Password</legend>
                       <div class="col-md-6">

                       <div class="form-group">
                       <label>old Password</label>
                          <div class="input-group">
                            <input type="password" name="old_password" id="old_password" value="{{old('old_password')}}"  class="form-control @error('old_password') is-invalid @enderror  " placeholder="Enter Old Password">
                            <div class="input-group-addon">
                              <i class="fa fa-eye" id="toggleOldPassword"></i>
                            </div>
                          </div>
                          @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                          @enderror
                      </div>

                          
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                            <label>New Password</label>
                            <div class="input-group">
                            <input type="password" name="new_password" value="{{old('new_password')}}" id="password" class="form-control @error('new_password') is-invalid @enderror  " placeholder="Enter New Password">
                            <div class="input-group-addon">
                            <i class="fa fa-eye" id="togglePassword"></i>
                            </div>
                            </div>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">
                            <label>Confirm Password</label>
                            <div class="input-group">
                            <input type="password" name="confirm_password" value="{{old('confirm_password')}}"  id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror  " placeholder="Confirm Password">
                            <div class="input-group-addon">
                            <i class="fa fa-eye" id="toggleConfirmPassword"></i>
                            </div>
                            </div>
                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                       </div>
                       <div class="col-md-3">
                         <div class="form-group">
                            <label></label>
                            <button class="btn btn-primary btn-block">Updates</button>
                          </div>
                       </div>
                     </fieldset>
                  </form>
              </div>
            </div>
          </div>
                
        
        </div>

        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection


@section('customjs')


@endsection