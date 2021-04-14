@extends('layouts.app')
@section('title') <title>AccountManagement </title> 
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">Add Vessel</h2>
            <div class="row">
                <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Vessel</a></li>
                    <li><a href="#tab_2" data-toggle="tab"></a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <form action="{{ url('accountmanagement/createVesselRecord') }}" id="basicInfoForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <!--div class="row">
                            <div class="col-md-offset-8 col-md-12">
                                <label for="status">
                                    <input type="checkbox" @if(old('status')) checked @endif value="1"  name="status" id="status" class="minimal"> Active / Inactive
                                </label>
                            </div>
                        </div-->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="vessel_name">Vessel Name</label> <i class="fa fa-info-circle" title=" Verbal moniker of a fishing vessel for identifying it visually and on vessel registries." data-toggle="tooltip"></i>
                                <input type="text" name="vessel_name" id="vessel_name" value="{{old('vessel_name')}}" class="form-control @error('vessel_name') is-invalid @enderror" placeholder="Enter Vessel Name">
                                @error('vessel_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vessel_registration">Vessel Registration</label> <i class="fa fa-info-circle" title=" Standardized number or identifier for distinguishing vessels registered under the same flag nation." data-toggle="tooltip"></i>
                                    <input type="text" name="vessel_registration" id="vessel_registration" value="{{old('vessel_registration')}}" class="form-control @error('vessel_registration') is-invalid @enderror" placeholder="Vessel Registration">
                                    @error('vessel_registration')
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
                                <label for="unique_indentification">Unique Indentification</label> <i class="fa fa-info-circle" title=" Identifier associated with a vessel for the duration of its existence that cannot be reused by any other vessel with a permanent physical marking on the craft." data-toggle="tooltip"></i>
                                <input type="text" name="unique_indentification" id="unique_indentification" value="{{old('unique_indentification')}}" class="form-control @error('unique_indentification') is-invalid @enderror" placeholder="EnterUnique Indentification">
                                @error('unique_indentification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="public_registry_hyperlink">Public Registry Hyperlink</label> <i class="fa fa-info-circle" title=" Website address of the public registry containing the listing of the fishing vessel." data-toggle="tooltip"></i>
                                    <input type="text" name="public_registry_hyperlink" id="public_registry_hyperlink" value="{{old('public_registry_hyperlink')}}" class="form-control @error('public_registry_hyperlink') is-invalid @enderror" placeholder="Enter Public Registry Hyperlink">
                                    @error('public_registry_hyperlink')
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
                                <label for="vessel_flag">Vessel Flag</label> <i class="fa fa-info-circle" title=" Nation with supervision over safety, fishing operations, and catch reporting." data-toggle="tooltip"></i>
                                <input type="text" name="vessel_flag" id="vessel_flag"  value="{{old('vessel_flag')}}" class="form-control @error('vessel_flag') is-invalid @enderror" placeholder="Enter Vessel Flag">
                                @error('vessel_flag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="availlability_catch_coordinates">Availability Catch Coordinates</label> <i class="fa fa-info-circle" title=" Indicator whether GPS coordinates were collected and are available." data-toggle="tooltip"></i>
                                    <input type="text" name="availlability_catch_coordinates" id="availlability_catch_coordinates" value="{{old('availlability_catch_coordinates')}}"  class="form-control @error('availlability_catch_coordinates') is-invalid @enderror" placeholder="Enter Availlability Catch Coordinates">
                                    @error('availlability_catch_coordinates')
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
                                <label for="satellite_tracking_authority">Satellite Tracking Authority</label> <i class="fa fa-info-circle" title=" Indicator of satellite vessel tracking.
Authority responsible for satellite tracking or verification." data-toggle="tooltip"></i>
                                <input type="text" name="satellite_tracking_authority" id="satellite_tracking_authority" value="{{old('satellite_tracking_authority')}}"  class="form-control @error('satellite_tracking_authority') is-invalid @enderror" placeholder="Enter Satellite Tracking Authority">
                                @error('satellite_tracking_authority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transshipment_vessel_name">Transshipment Vessel Name</label> <i class="fa fa-info-circle" title=" Verbal moniker of a transshipment vessel for identifying it visually and on vessel registries." data-toggle="tooltip"></i>
                                    <input type="text" name="transshipment_vessel_name" id="transshipment_vessel_name" value="{{old('transshipment_vessel_name')}}" class="form-control @error('transshipment_vessel_name') is-invalid @enderror" placeholder="Enter Transshipment Vessel Name">
                                    @error('transshipment_vessel_name')
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
                                <label for="transshipment_unique_identification">Transshipment Unique Identification</label> <i class="fa fa-info-circle" title=" Identifier associated with a vessel for the duration of its existence that cannot be reused by any other vessel with a permanent physical marking on the craft." data-toggle="tooltip"></i>
                                <input type="text" name="transshipment_unique_identification" id="transshipment_unique_identification" value="{{old('transshipment_unique_identification')}}" class="form-control @error('transshipment_unique_identification') is-invalid @enderror" placeholder="Enter Transshipment Unique Identification">
                                @error('transshipment_unique_identification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transshipment_vessel_flag">Transshipment Vessel Flag</label> <i class="fa fa-info-circle" title=" Nation with supervision over safety, transshipment operations, and catch transfer reporting." data-toggle="tooltip"></i>
                                    <input type="text" name="transshipment_vessel_flag" id="transshipment_vessel_flag" value="{{old('transshipment_vessel_flag')}}" class="form-control @error('transshipment_vessel_flag') is-invalid @enderror" placeholder="Enter Transshipment Vessel Flag">
                                    @error('transshipment_vessel_flag')
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
                                <label for="transshipment_vessel_registration">Transshipment Vessel Registration</label> <i class="fa fa-info-circle" title=" Standardized number or identifier for distinguishing vessels registered under the same flag nation." data-toggle="tooltip"></i>
                                <input type="text" name="transshipment_vessel_registration" id="transshipment_vessel_registration" value="{{old('transshipment_vessel_registration')}}" class="form-control @error('transshipment_vessel_registration') is-invalid @enderror" placeholder="Enter Transshipment Vessel Registration">
                                @error('transshipment_vessel_registration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fishery_improvement_project">Fishery Improvement Project</label> <i class="fa fa-info-circle" title=" Publicly listed name of the fishery improvement project that the harvest event is subject to." data-toggle="tooltip"></i>
                                    <input type="text" name="fishery_improvement_project" id="fishery_improvement_project" value="{{old('fishery_improvement_project')}}" class="form-control @error('fishery_improvement_project') is-invalid @enderror" placeholder="Enter Fishery Improvement Project">
                                    @error('fishery_improvement_project')
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
                                <label for="fishing_authorization">Fishing Authorization</label> <i class="fa fa-info-circle" title="Unique number associated with a regulatory document from the relevant authority, granting permission for the wild capture of seafood by a fisher or fishing vessel." data-toggle="tooltip"></i>
                                <input type="text" name="fishing_authorization" id="fishing_authorization" value="{{old('fishing_authorization')}}" class="form-control @error('fishing_authorization') is-invalid @enderror" placeholder="EnterFishing Authorization">
                                @error('fishing_authorization')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hervest_certification">Hervest Certification</label> <i class="fa fa-info-circle" title="Name of the harvest standards body that a particular harvest seafood is subject to and the unique identifier associated with the certified entity." data-toggle="tooltip"></i>
                                    <input type="text" name="hervest_certification" id="hervest_certification" value="{{old('hervest_certification')}}" class="form-control @error('hervest_certification') is-invalid @enderror" placeholder="Enter Hervest Certification">
                                    @error('hervest_certification')
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
                                <label for="hervest_certification_chain_custody">Hervest Certification Chain Of Custody</label> <i class="fa fa-info-circle" title="Name of the chain of custody standards body that particular harvest seafood is subject to and the unique identifier associated with the certified entity." data-toggle="tooltip"></i>
                                <input type="text" name="hervest_certification_chain_custody" id="hervest_certification_chain_custody" value="{{old('hervest_certification_chain_custody')}}" class="form-control @error('hervest_certification_chain_custody') is-invalid @enderror" placeholder="EnterHervest Certification Chain Custody">
                                @error('hervest_certification_chain_custody')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transshipment_authorization">Transshipment Authorization</label> <i class="fa fa-info-circle" title="Unique number associated with a regulatory document from the relevant authority, granting permission for the discharge of the wild capture of seafood from a fishing vessel to a transshipment vessel." data-toggle="tooltip"></i>
                                    <input type="text" name="transshipment_authorization" id="transshipment_authorization" value="{{old('transshipment_authorization')}}" class="form-control @error('transshipment_authorization') is-invalid @enderror" placeholder="Enter Transshipment Authorization">
                                    @error('transshipment_authorization')
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
                                <label for="landing_authorization">Landing Authorization</label> <i class="fa fa-info-circle" title="Unique number associated with a regulatory document from the relevant authority, granting permission for the discharge of the wild capture of seafood to land by a fisher, fishing vessel, or transshipment vessel." data-toggle="tooltip"></i>
                                <input type="text" name="landing_authorization" id="landing_authorization" value="{{old('landing_authorization')}}" class="form-control @error('landing_authorization') is-invalid @enderror" placeholder="Enter Landing Authorization">
                                @error('landing_authorization')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="human_welfare_policy_standards">Human Welfare Policy Standards</label> <i class="fa fa-info-circle" title="Name of internationally recognized standards to which policy on a vessel/trip claims conformity" data-toggle="tooltip"></i>
                                    <input type="text" name="human_welfare_policy_standards" id="human_welfare_policy_standards" value="{{old('human_welfare_policy_standards')}}" class="form-control @error('human_welfare_policy_standards') is-invalid @enderror" placeholder="Enter Human Welfare Policy Standards">
                                    @error('human_welfare_policy_standards')
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
                                <label for="existence_human_wefare_policy">Existence Human Wefare Policy</label> <i class="fa fa-info-circle" title="Indicator of human welfare policies in place on a vessel/trip, answering the question “What kind of human welfare, labor, or anti-slavery policy was in place on this vessel/trip?” If an internal policy is subject to a third-party audit, select “3P Audit.”" data-toggle="tooltip"></i>
                                <input type="text" name="existence_human_wefare_policy" id="existence_human_wefare_policy" value="{{old('existence_human_wefare_policy')}}" class="form-control @error('existence_human_wefare_policy') is-invalid @enderror" placeholder="Enter Existence Human Wefare Policy">
                                @error('existence_human_wefare_policy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fishing_gear">Fishing Gear</label> <i class="fa fa-info-circle" title="Type of fishing gear" data-toggle="tooltip"></i>
                                    <input type="text" name="fishing_gear" id="fishing_gear" value="{{old('fishing_gear')}}" class="form-control @error('fishing_gear') is-invalid @enderror" placeholder="Enter Fishing Gear">
                                    @error('fishing_gear')
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
                                <label for="fish_transfer">Fish Transfer</label> <i class="fa fa-info-circle" title="Type of fish transfer (pump, brail, manual,..)" data-toggle="tooltip"></i>
                                <input type="text" name="fish_transfer" id="fish_transfer" value="{{old('fish_transfer')}}" class="form-control @error('fish_transfer') is-invalid @enderror" placeholder="Enter Fish Transfer">
                                @error('fish_transfer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nominal_capacity">Nominal Capacity</label> <i class="fa fa-info-circle" title="Nominal capacity in mt of fish" data-toggle="tooltip"></i>
                                    <input type="text" name="nominal_capacity" id="nominal_capacity" value="{{old('nominal_capacity')}}" class="form-control @error('nominal_capacity') is-invalid @enderror" placeholder="Enter Nominal Capacity">
                                    @error('nominal_capacity')
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
                                <label for="hatches">Number Of Hatches</label> <i class="fa fa-info-circle" title="Number of hatches" data-toggle="tooltip"></i>
                                <input type="text" name="hatches" id="hatches" value="{{old('hatches')}}" class="form-control @error('hatches') is-invalid @enderror" placeholder="Enter Number Of Hatches">
                                @error('hatches')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rsw">RSW</label> <i class="fa fa-info-circle" title="Refrigerated seawater system" data-toggle="tooltip"></i>
                                    <input type="text" name="rsw" id="rsw" value="{{old('rsw')}}" class="form-control @error('rsw') is-invalid @enderror" placeholder="Enter RSW">
                                    @error('rsw')
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
                                <label for="hp_rsw">HP RSW</label> <i class="fa fa-info-circle" title="Power of RSW system" data-toggle="tooltip"></i>
                                <input type="text" name="hp_rsw" id="hp_rsw" value="{{old('hp_rsw')}}" class="form-control @error('hp_rsw') is-invalid @enderror" placeholder="Enter HP RSW">
                                @error('hp_rsw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ice_trip">Ice/Trip</label> <i class="fa fa-info-circle" title="Mt of ice per trip" data-toggle="tooltip"></i>
                                    <input type="text" name="ice_trip" id="ice_trip" value="{{old('ice_trip')}}" class="form-control @error('ice_trip') is-invalid @enderror" placeholder="Enter Ice/Trip">
                                    @error('ice_trip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                               </div>
                            </div>
                        </div> <!--  END Row -->
                    
                        <div class="row">
                            <div class="col-md-2">
                                <button class="btn btn-primary">Add Vessel</button>
                            </div>
                        </div>
                    </form>
                </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div>
    </section>
</div> 

@endsection

@section('customjs')
<script>
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
 });

</script>
@endsection
