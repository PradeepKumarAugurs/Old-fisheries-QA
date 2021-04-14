@extends('layouts.app')
@section('title') <title>AccountManagement </title> 
@endsection
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">Update Vessel</h2>
            <div class="row">
                <div class="messageDiv">
                </div>
                <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Vessel</a></li>
                    <li><a href="#tab_2" data-toggle="tab"></a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <form action="{{ url('accountmanagement/updateVesselRecord') }}" id="basicInfoForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <!--div class="row">
                            <div class="col-md-offset-8 col-md-12">
                                <label for="status">
                                    <input type="checkbox" @if($vesselData['status']=='1') checked @endif value="1"  name="status" id="status" class="minimal"> Active / Inactive
                                </label>
                            </div>
                        </div-->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="user_id" id="user_id" value="{{$vesselData['id']}}" />
                                <label for="lot_number">Vessel Name</label> <i class="fa fa-info-circle" title=" Verbal moniker of a fishing vessel for identifying it visually and on vessel registries." data-toggle="tooltip"></i>
                                <input type="text" name="vessel_name" id="vessel_name" value="{{ $vesselData['vessel_name'] }}" class="form-control @error('vessel_name') is-invalid @enderror" placeholder="Enter Vessel Name">
                                @error('vessel_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Vessel Registration</label> <i class="fa fa-info-circle" title=" Standardized number or identifier for distinguishing vessels registered under the same flag nation." data-toggle="tooltip"></i>
                                    <input type="text" name="vessel_registration" id="vessel_registration" value="{{ $vesselData['vessel_registration'] }}" class="form-control @error('vessel_registration') is-invalid @enderror" placeholder="Vessel Registration">
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
                                <label for="lot_number">Unique Indentification</label> <i class="fa fa-info-circle" title=" Identifier associated with a vessel for the duration of its existence that cannot be reused by any other vessel with a permanent physical marking on the craft." data-toggle="tooltip"></i>
                                <input type="text" name="unique_indentification" id="unique_indentification" value="{{ $vesselData['unique_indentification'] }}" class="form-control @error('unique_indentification') is-invalid @enderror" placeholder="EnterUnique Indentification">
                                @error('unique_indentification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Public Registry Hyperlink</label> <i class="fa fa-info-circle" title=" Website address of the public registry containing the listing of the fishing vessel." data-toggle="tooltip"></i>
                                    <input type="text" name="public_registry_hyperlink" id="public_registry_hyperlink" value="{{ $vesselData['public_registry_hyperlink'] }}" class="form-control @error('public_registry_hyperlink') is-invalid @enderror" placeholder="Enter Public Registry Hyperlink">
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
                                <label for="lot_number">Vessel Flag</label> <i class="fa fa-info-circle" title=" Nation with supervision over safety, fishing operations, and catch reporting." data-toggle="tooltip"></i>
                                <input type="text" name="vessel_flag" id="vessel_flag" value="{{ $vesselData['vessel_flag'] }}" class="form-control @error('vessel_flag') is-invalid @enderror" placeholder="Enter Vessel Flag">
                                @error('vessel_flag')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Availlability Catch Coordinates</label> <i class="fa fa-info-circle" title=" Indicator whether GPS coordinates were collected and are available." data-toggle="tooltip"></i>
                                    <input type="text" name="availlability_catch_coordinates" id="availlability_catch_coordinates" value="{{ $vesselData['availlability_catch_coordinates'] }}" class="form-control @error('availlability_catch_coordinates') is-invalid @enderror" placeholder="Enter Availlability Catch Coordinates">
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
                                <label for="lot_number">Satellite Tracking Authority</label> <i class="fa fa-info-circle" title=" Indicator of satellite vessel tracking.
Authority responsible for satellite tracking or verification." data-toggle="tooltip"></i>
                                <input type="text" name="satellite_tracking_authority" id="satellite_tracking_authority" value="{{ $vesselData['satellite_tracking_authority'] }}" class="form-control @error('satellite_tracking_authority') is-invalid @enderror" placeholder="Enter Satellite Tracking Authority">
                                @error('satellite_tracking_authority')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Transshipment Vessel Name</label> <i class="fa fa-info-circle" title=" Verbal moniker of a transshipment vessel for identifying it visually and on vessel registries." data-toggle="tooltip"></i>
                                    <input type="text" name="transshipment_vessel_name" id="transshipment_vessel_name" value="{{ $vesselData['transshipment_vessel_name'] }}" class="form-control @error('transshipment_vessel_name') is-invalid @enderror" placeholder="Enter Transshipment Vessel Name">
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
                                <label for="lot_number">Transshipment Unique Identification</label> <i class="fa fa-info-circle" title=" Identifier associated with a vessel for the duration of its existence that cannot be reused by any other vessel with a permanent physical marking on the craft." data-toggle="tooltip"></i>
                                <input type="text" name="transshipment_unique_identification" id="transshipment_unique_identification" class="form-control @error('transshipment_unique_identification') is-invalid @enderror" value="{{ $vesselData['transshipment_unique_identification'] }}" placeholder="Enter Transshipment Unique Identification">
                                @error('transshipment_unique_identification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Transshipment Vessel Flag</label> <i class="fa fa-info-circle" title=" Nation with supervision over safety, transshipment operations, and catch transfer reporting." data-toggle="tooltip"></i>
                                    <input type="text" name="transshipment_vessel_flag" id="transshipment_vessel_flag" value="{{ $vesselData['transshipment_vessel_flag'] }}" class="form-control @error('transshipment_vessel_flag') is-invalid @enderror" placeholder="Enter Transshipment Vessel Flag">
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
                                <label for="lot_number">Transshipment Vessel Registration</label> <i class="fa fa-info-circle" title=" Standardized number or identifier for distinguishing vessels registered under the same flag nation." data-toggle="tooltip"></i>
                                <input type="text" name="transshipment_vessel_registration" id="transshipment_vessel_registration" value="{{ $vesselData['transshipment_vessel_registration'] }}" class="form-control @error('transshipment_vessel_registration') is-invalid @enderror" placeholder="Enter Transshipment Vessel Registration">
                                @error('transshipment_vessel_registration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Fishery Improvement Project</label> <i class="fa fa-info-circle" title=" Publicly listed name of the fishery improvement project that the harvest event is subject to." data-toggle="tooltip"></i>
                                    <input type="text" name="fishery_improvement_project" id="fishery_improvement_project" value="{{ $vesselData['fishery_improvement_project'] }}" class="form-control @error('fishery_improvement_project') is-invalid @enderror" placeholder="Enter Fishery Improvement Project">
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
                                <label for="lot_number">Fishing Authorization</label> <i class="fa fa-info-circle" title=" Unique number associated with a regulatory document from the relevant authority, granting permission for the wild capture of seafood by a fisher or fishing vessel." data-toggle="tooltip"></i>
                                <input type="text" name="fishing_authorization" id="fishing_authorization" value="{{ $vesselData['fishing_authorization'] }}" class="form-control @error('fishing_authorization') is-invalid @enderror" placeholder="Enter Fishing Authorization">
                                @error('fishing_authorization')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Hervest Certification</label> <i class="fa fa-info-circle" title="Name of the harvest standards body that a particular harvest seafood is subject to and the unique identifier associated with the certified entity." data-toggle="tooltip"></i>
                                    <input type="text" name="hervest_certification" id="hervest_certification" value="{{ $vesselData['hervest_certification'] }}" class="form-control @error('hervest_certification') is-invalid @enderror" placeholder="Enter Hervest Certification">
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
                                <label for="lot_number">Hervest Certification Chain Of Custody</label> <i class="fa fa-info-circle" title="Name of the chain of custody standards body that particular harvest seafood is subject to and the unique identifier associated with the certified entity." data-toggle="tooltip"></i>
                                <input type="text" name="hervest_certification_chain_custody" id="hervest_certification_chain_custody" value="{{ $vesselData['hervest_certification_chain_custody'] }}" class="form-control @error('hervest_certification_chain_custody') is-invalid @enderror" placeholder="EnterHervest Certification Chain Custody">
                                @error('hervest_certification_chain_custody')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Transshipment Authorization</label> <i class="fa fa-info-circle" title="Unique number associated with a regulatory document from the relevant authority, granting permission for the discharge of the wild capture of seafood from a fishing vessel to a transshipment vessel." data-toggle="tooltip"></i>
                                    <input type="text" name="transshipment_authorization" id="transshipment_authorization" value="{{ $vesselData['transshipment_authorization'] }}" class="form-control @error('transshipment_authorization') is-invalid @enderror" placeholder="Enter Transshipment Authorization">
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
                                <input type="text" name="landing_authorization" id="landing_authorization" value="{{ $vesselData['landing_authorization'] }}" class="form-control @error('landing_authorization') is-invalid @enderror" placeholder="Enter Landing Authorization">
                                @error('landing_authorization')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Human Welfare Policy Standards</label> <i class="fa fa-info-circle" title="Name of internationally recognized standards to which policy on a vessel/trip claims conformity" data-toggle="tooltip"></i>
                                    <input type="text" name="human_welfare_policy_standards" id="human_welfare_policy_standards" value="{{ $vesselData['human_welfare_policy_standards'] }}" class="form-control @error('human_welfare_policy_standards') is-invalid @enderror" placeholder="Enter Human Welfare Policy Standards">
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
                                <input type="text" name="existence_human_wefare_policy" id="existence_human_wefare_policy" value="{{ $vesselData['existence_human_wefare_policy'] }}" class="form-control @error('existence_human_wefare_policy') is-invalid @enderror" placeholder="Enter Existence Human Wefare Policy">
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
                                    <input type="text" name="fishing_gear" id="fishing_gear" value="{{ $vesselData['fishing_gear'] }}" class="form-control @error('fishing_gear') is-invalid @enderror" placeholder="Enter Fishing Gear">
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
                                <input type="text" name="fish_transfer" id="fish_transfer" value="{{ $vesselData['fish_transfer'] }}" class="form-control @error('fish_transfer') is-invalid @enderror" placeholder="Enter Fish Transfer">
                                @error('fish_transfer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Nominal Capacity</label> <i class="fa fa-info-circle" title="Nominal capacity in mt of fish" data-toggle="tooltip"></i>
                                    <input type="text" name="nominal_capacity" id="nominal_capacity" value="{{ $vesselData['nominal_capacity'] }}" class="form-control @error('nominal_capacity') is-invalid @enderror" placeholder="Enter Nominal Capacity">
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
                                <label for="hatches"> Number Of Hatches</label> <i class="fa fa-info-circle" title="Number of hatches" data-toggle="tooltip"></i>
                                <input type="text" name="hatches" id="hatches" value="{{ $vesselData['hatches'] }}" class="form-control @error('hatches') is-invalid @enderror" placeholder="Enter Hatches">
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
                                    <input type="text" name="rsw" id="rsw" value="{{ $vesselData['rsw'] }}" class="form-control @error('rsw') is-invalid @enderror" placeholder="Enter RSW">
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
                                <input type="text" name="hp_rsw" id="hp_rsw" value="{{ $vesselData['hp_rsw'] }}" class="form-control @error('hp_rsw') is-invalid @enderror" placeholder="Enter HP RSW">
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
                                    <input type="text" name="ice_trip" id="ice_trip" value="{{ $vesselData['ice_trip'] }}" class="form-control @error('ice_trip') is-invalid @enderror" placeholder="Enter Ice Trip">
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
                                <button class="btn btn-primary"> Update Vessel</button>
                               
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
