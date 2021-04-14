
@extends('layouts.app')
@section('title') <title>AccountManagement </title> 
<style>
.userimage{
    height: 60px;
    /* width: 60px; */
    border: 2px solid lightgray;
    border-radius: 3%;
    box-shadow: 1px 1px 20px -10px;
}
</style>
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">Update Profile</h2>
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
                @if(Session::has('errors'))
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
                        <form action="{{url('accountmanagement/updateUser/'.$userDetail->id)}}"  method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" name="username" id="username" value="{{$userDetail->username}}" class="form-control  @error('username') is-invalid @enderror" placeholder="Enter User Name">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
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
                                    <div class="col-md-4">
                                        <div class="form-group" id="{{$userDetail->user_image}}">
                                        @if($userDetail->user_image!="")
                                           <img src="{{asset('userImages/'.$userDetail->profileImage->file)}}" image="{{$userDetail->profileImage->file}}" alt="file  path not found!" class="userimage image-responsive">
                                        @endif 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--  END Row -->

                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="company">Company</label>
                                <input type="text" name="company" id="company" value="{{$userDetail->company}}" class="form-control @error('company') is-invalid @enderror" placeholder="Enter Company">
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
                                    <input type="email" name="email" id="email" value="{{$userDetail->email}}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
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
                                <input type="radio" @if($userDetail->role == '2') checked @endif  class="flat-red" name="role" value="2"> Supplier
                                </label>
                                <label>
                                <input type="radio" @if($userDetail->role == '3') checked @endif class="flat-red" name="role" value="3" > Producer
                                </label>
                                <label >
                                <input type="radio" @if($userDetail->role == '4') checked @endif class="flat-red" name="role" value="4" > Third Party Surveyor
                                </label>
                                <label>
                                <input type="radio" @if($userDetail->role == '5') checked @endif class="flat-red" name="role" value="5" > internal User
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
                                   
                                    <input type="text" name="position" id="position" class="form-control @error('position') is-invalid @enderror" value="{{$userDetail->position?$userDetail->position:''}}" placeholder="company Position">
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
                                <input type="text" name="identification" id="identification" value="{{$userDetail->identification}}" class="form-control @error('identification') is-invalid @enderror" placeholder="Enter Identification">
                                @error('identification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="mobile_no">Mobile No.</label>
                                    <input type="text" maxlength="10" onkeypress="return restrictAlphabets(event)" name="mobile_no" id="mobile_no" value="{{$userDetail->mobile_no}}" class="form-control @error('mobile_no') is-invalid @enderror" placeholder="Enter Mobile Number">
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
                                <tr>
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
                                @php $countryC=0; $CountryRowId=NULL; @endphp 
                                @foreach($allUserAffiliationCountries as $userAffflicationCountries)
                                    @if(($userAffflicationCountries->country_id==$country->id))
                                        @php $CountryRowId = $userAffflicationCountries->id; @endphp 
                                        @if(($userAffflicationCountries->is_checked=='1'))
                                        @php $countryC = 1; @endphp 
                                        @break
                                        @endif 
                                    @endif 
                                @endforeach
                              <tr style="background-color:#eee;">
                                <td>
                                    <input type="hidden" name="affiliations[{{$key}}][id]" value="{{$CountryRowId?$CountryRowId:NULL}}">
                                    <input type="hidden" class="minimal" name="affiliations[{{$key}}][country_id]" value="{{$country->id}}">
                                    <input type="checkbox" class="minimal countryCheckboxes" @if($countryC) checked @endif name="affiliations[{{$key}}][is_checked]" >
                                    {{$country->name}}
                                </td>
                                <td></td>
                                <td></td>
                              </tr>
                              
                               @if(isset($country->producers) && count($country->producers))
                                  @foreach($country->producers as $key2=>$producer)
                                   

                                    @php $producerC=0; $producerAC=0; $producersRowId=NULL;  @endphp 
                                    @foreach($allUserAffiliationProducers as $userAffflicationProducers)
                                        @if(($userAffflicationProducers->country_id==$country->id) && ($userAffflicationProducers->producer_id==$producer->id))
                                            @if(($userAffflicationProducers->is_checked=='1'))
                                                @php $producerC=1; @endphp 
                                            @endif 
                                            @if(($userAffflicationProducers->access_is_checked=='1'))
                                                @php $producerAC=1; @endphp  
                                            @endif 
                                            @php $producersRowId=$userAffflicationProducers->id; @endphp 
                                        @endif 
                                        
                                        
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td>
                                        <input type="hidden" name="affiliations[{{$key}}][producers][{{$key2}}][id]" value="{{$producersRowId?$producersRowId:NULL}}">
                                        <input type="hidden" name="affiliations[{{$key}}][producers][{{$key2}}][producer_id]" value="{{$producer->id}}"/> 
                                        <input type="checkbox" @if($producerC) checked @endif name="affiliations[{{$key}}][producers][{{$key2}}][is_checked]" class="minimal producersCheckboxes" >
                                        {{$producer->name}} 
                                        </td>
                                        <td>
                                            <input type="checkbox" @if($producerAC) checked @endif name="affiliations[{{$key}}][producers][{{$key2}}][access_is_checked]" class="minimal restrictionsCheckboxes" >
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
                        <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div><!-- /.tab-pane -->
                   
                
                    <div class="tab-pane @if(Session::has('user_id') && Session::get('user_id')) active  @endif " id="tab_2">
                       <form action="{{ url('accountmanagement\updateAccess') }}" onsubmit="updateAccess(event)" method="post" enctype="multipart/form-data">
                           @csrf
                            <input type="hidden" name="user_id" value="{{$userDetail->id}}">
                            <!-- <button type="button" class="btn btn-xs btn-info" id="expander">expand</button>
                            <button type="button" class="btn btn-xs btn-info" id="collapser">collapse</button> -->
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

                                @php $accessRight=0; $isValidated=0; $producersAccessRowId=NULL; @endphp 
                                @if(isset($user_access) && !empty($user_access))
                                    @foreach($user_access as $userAccess)
                                        @if($userAccess->access_id==$accessDetails->id)
                                            @if($userAccess->access_right=='1')
                                            @php $accessRight=1; @endphp
                                            @endif
                                            @if($userAccess->is_validated=='1')
                                            @php $isValidated=1; @endphp
                                            @endif
                                            @php  $producersAccessRowId=$userAccess->id; @endphp 
                                        @endif 
                                    @endforeach
                                @endif 
                                <tr data-node-id="{{$accessDetails['id']}}" @if($accessDetails['parent_id']  > 0) data-node-pid="{{$accessDetails['parent_id']}}"@endif>
                                <td class="col-md-6"><label> 
                                <input type="hidden" name="access[{{$key}}][id]" value="{{$producersAccessRowId}}">
                                <input type="hidden" name="access[{{$key}}][access_id]" value="{{$accessDetails['id']}}" >
                                <input type="checkbox" @if($accessRight) checked @endif class="minimal" name="access[{{$key}}][access_right]" > {{$accessDetails['title']}} </label></td>
                                <td>
                                <input type="checkbox" @if($isValidated) checked @endif class="minimal" name="access[{{$key}}][is_validated]" ></td>
                                </tr>
                                @endforeach
                            </table>
                        @endif
                        
                          <button type="submit" class="btn btn-primary updateAccess-btn"> Update Access </button>
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
        

    function updateAccess(e){
        $('button.updateAccess-btn').addClass('disabled'); 
        console.log("Hi Disabled")
    }
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
            // $('.icheckbox_minimal-blue').css('border','1px solid #46c0ef');
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
