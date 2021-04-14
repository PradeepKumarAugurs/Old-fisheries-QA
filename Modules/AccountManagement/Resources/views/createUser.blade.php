
@extends('layouts.app')
@section('title') <title>AccountManagement </title> 

@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">User Profile</h2>
            <div class="row">
                <div class="messageDiv">
                </div>
                <div class="col-md-12">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                
                @if (Session::has('errors'))
                    <div class="alert alert-danger alert-dismissible show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </p>
                    </div>
                @endif
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="@if(!Session::has('user_id')) active  @endif"><a href="#tab_1" data-toggle="tab">Profile</a></li>
                    <li class="@if(Session::has('user_id') && Session::get('user_id')) active  @endif "><a href="#tab_2" data-toggle="tab">Access</a></li>  
                    <!-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> -->
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane @if(!Session::has('user_id')) active  @endif" id="tab_1">
                        <form action="{{url('accountmanagement/saveUser')}}" id="basicInfoForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" name="username" id="username" value="{{old('username')}}" class="form-control  @error('username') is-invalid @enderror" placeholder="Enter User Name">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_image">Profile Image</label>
                                    <input type="file" name="user_image" id="user_image" class="form-control @error('user_image') is-invalid @enderror" >
                                    @error('user_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                                </div>
                            </div>
                        </div> <!--  END Row -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="company">Company</label>
                                <input type="text" name="company" id="company" value="{{old('company')}}" class="form-control @error('company') is-invalid @enderror" placeholder="Enter Company">
                                @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <div class="form-group" class="form-control @error('role') is-invalid @enderror">
                                <label>
                                <input type="radio" @if(old('role') == '2') checked @endif  class="flat-red" name="role" value="2"> Supplier
                                </label>
                                <label>
                                <input type="radio" @if(old('role') == '3') checked @endif class="flat-red" name="role" value="3" > Producer
                                </label>
                                <label >
                                <input type="radio" @if(old('role') == '4') checked @endif class="flat-red" name="role" value="4" > Third Party Surveyor
                                </label>
                                <label>
                                <input type="radio" @if(old('role') == '5') checked @endif class="flat-red" name="role" value="5" > internal User
                                </label>
                                </div>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="position">Position In Company</label>
                                    <!--<select name="position" id="position" class="form-control @error('position') is-invalid @enderror">
                                        <option value="">-- Select Position --</option>
                                        <option @if(old('position')=='1') selected @endif value="1">Quality Manager</option>
                                        <option @if(old('position')=='2') selected @endif value="2">General Manager</option>
                                        <option @if(old('position')=='3') selected @endif value="3">Stock Manager</option>
                                    </select> -->
                                <input type="text" name="position" id="position" value="{{old('position')}}" class="form-control @error('identification') is-invalid @enderror" placeholder="Enter Position In Company">
                                    @error('position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="identification">Identification</label>
                                <input type="text" name="identification" id="identification" value="{{old('identification')}}" class="form-control @error('identification') is-invalid @enderror" placeholder="Enter Identification">
                                @error('identification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile Number</label>
                                    <input type="text" maxlength="10" onkeypress="return restrictAlphabets(event)" name="mobile_no" id="mobile_no" value="{{old('mobile_no')}}" class="form-control @error('mobile_no') is-invalid @enderror" placeholder="Enter Mobile Number">
                                    @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!--  END Row -->


                        <div class="row">
                            <div class="col-md-12">
                            <label for="">Affiliation</label>
                            <table class="table table-hover table-border">
                                <thead>
                                    <tr class="info">
                                        <th>Country</th>
                                        <th>Producer</th>
                                        <th>Lot Access Restriction</th>
                                    </tr>
                                    <tr  style="background-color:#eee;" >
                                        <th><input type="checkbox" class="minimal allCountryList"/> All Country</th>
                                        <th><input type="checkbox" class="minimal allProducerList" /> All Producer</th>
                                        <th><input type="checkbox" class="minimal allRestrictionList" /></th>
                                    </tr>
                                </thead>
                            <tbody>
                            @if(isset($getUserList) && count($getUserList))
                            @foreach($getUserList as $key=>$country)
                            <tr style="background-color:#eee;">
                                <td>
                                    <input type="hidden" class="minimal" name="affiliations[{{$key}}][country_id]" value="{{$country->id}}">
                                    <input type="checkbox" class="minimal countryCheckboxes" name="affiliations[{{$key}}][is_checked]" > {{$country->name}} 
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                            @if(isset($country->producers) && count($country->producers))
                                @foreach($country->producers as $key2=>$producer)
                                    <tr>
                                        <td></td>
                                        <td>
                                        <input type="hidden" name="affiliations[{{$key}}][producers][{{$key2}}][producer_id]" value="{{$producer->id}}"/> 
                                        <input type="checkbox" name="affiliations[{{$key}}][producers][{{$key2}}][is_checked]"   class="minimal producersCheckboxes" >
                                        {{$producer->name}} 
                                        </td>
                                        <td>
                                            <input type="checkbox" name="affiliations[{{$key}}][producers][{{$key2}}][access_is_checked]" class="minimal restrictionsCheckboxes" >
                                        </td>
                                    </tr>
                                @endforeach
                                @endif 
                            @endforeach
                            @endif 
                            </tbody>
                            </table>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div><!-- /.tab-pane -->
                   
                
                    <div class="tab-pane @if(Session::has('user_id') && Session::get('user_id')) active  @endif " id="tab_2">
                       <form action="{{ url('accountmanagement\updateAccess') }}" id="accessForm" method="post" enctype="multipart/form-data">
                           @csrf
                            <input type="hidden" name="user_id" value="@if(Session::has('user_id')){{Session::get('user_id')}}@endif">
                            
                            <!-- <button type="button" id="open1">open 1</button>
                            <button type="button" id="close1">close 1</button> -->
                            
                            @if(isset($master_access) &&  count($master_access))
                            <table id="basic" class="table">
                                <tr>
                                    <th>
                                        <button type="button" class="btn btn-xs btn-info" id="expander">Expand</button>
                                        <button type="button" class="btn btn-xs btn-info" id="collapser">Collapse</button> 
                                    </th>
                                    <th style="color:red;"> To be validated by Leader?</th>
                                </tr>
                                @foreach($master_access as $key => $accessDetails)
                                <tr data-node-id="{{$accessDetails['id']}}" @if($accessDetails['parent_id']  > 0) data-node-pid="{{$accessDetails['parent_id']}}"@endif>
                                <td class="col-md-6">
                                <label> 
                                    <input type="hidden" name="access[{{$key}}][access_id]" value="{{$accessDetails['id']}}" >
                                    <input type="checkbox" class="minimal accessCheckbox" data-accessid="{{$accessDetails['id']}}" name="access[{{$key}}][access_right]" > {{$accessDetails['title']}}
                                </label>
                                </td>
                                <td>
                                <input type="checkbox" class="minimal" name="access[{{$key}}][is_validated]" ></td>
                                </tr>
                                @endforeach
                            </table>
                        @endif
                          <button type="submit" class="btn btn-primary"> Create Access </button>
                        </form>
                    </div><!-- /.tab-pane -->

                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div>
    </section>
</div> 

@endsection

@section('customjs')

<script>
        $('#basic').simpleTreeTable({
            expander: $('#expander'),
            collapser: $('#collapser'),
            store: 'session',
            storeKey: 'simple-tree-table-basic'
        });
        $('#open1').on('click', function() {
            $('#basic').data('simple-tree-table').openByID("1");
        });
        $('#close1').on('click', function() {
            $('#basic').data('simple-tree-table').closeByID("1");
        });
 $(function(){

    
         //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        $('.allCountryList').on('ifChanged', function(event){
            $(this).on('ifChecked', function (event){    
                $('.countryCheckboxes').iCheck('check'); 
            });
            $(this).on('ifUnchecked', function (event) {
                $('.countryCheckboxes').iCheck('uncheck');   
            });
        });
        $('.allProducerList').on('ifChanged', function(event){
            $(this).on('ifChecked', function (event){    
                $('.producersCheckboxes').iCheck('check');   
            });
            $(this).on('ifUnchecked', function (event) {
                $('.producersCheckboxes').iCheck('uncheck');   
            });
        });
        $('.allRestrictionList').on('ifChanged', function(event){
            $(this).on('ifChecked', function (event){    
                $('.restrictionsCheckboxes').iCheck('check');   
            });
            $(this).on('ifUnchecked', function (event) {
                $('.restrictionsCheckboxes').iCheck('uncheck');   
            });
        });
        $('.accessCheckbox').on('ifChanged',function(event){
            var accessId = $(this).attr("data-accessid");
            //alert("accesss id is "+$(this).attr("data-accessid"));
            $.ajax({
                type: "GET",
                url: "{{url('accountmanagement/getAllAccessChildsByAccessId')}}",
                data: {"accessId":accessId,"_token":"{{ csrf_token() }}"},
                beforeSend: function() {
                    //$('.getCitiesByAjax').html('<option><i class="fa fa-spinner fa-spin"></i></option>');
                },
                success: function(result){
                    if(result!=""){
                        $('#city').html(result);
                    }
                }
            });
        });
 });

    var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
    }

</script> 

@endsection
