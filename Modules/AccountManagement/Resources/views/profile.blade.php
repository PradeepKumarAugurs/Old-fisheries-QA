
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
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Profile</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Access</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <form action="javascript:void(0)" id="basicInfoForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="lot_number" class="lot_number_text">Lot Number</label>
                                <input type="text" name="lot_number" id="lot_number" class="form-control lot_number_border " placeholder="Enter Lot Number">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number" class="lot_number_text">Production Date</label>
                                    <input type="text" name="production_date" id="production_date" class="form-control datepicker lot_number_border" placeholder="Production Date">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        
                        
                        </form>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_2">
                        <form action="#" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_name" class="">User Name</label>
                                    <input type="text" name="user_name" id="user_name" class="form-control user_name" placeholder="Enter User Name">
                                </div>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <input type="checkbox" class="minimal" style="position: absolute; opacity: 0;">
                                            <label for="user_name" class=""> Quality Control </label>
                                    </div>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">  
                                    <label for="lot_number">Export QC database</label>                              
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;"> 
                                    <label for="lot_number">Export Consolidation quality status</label>                               </div>
                            </div>
                        </div> <!--  END Row -->
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">
                                            <label for="user_name" class="">New Lot</label>
                                    </div>
                                </div>
                            </div> <!--  END Row -->
                            
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal" style="position: absolute; opacity: 0;">  
                                    <label for="lot_number">Distributors</label>                              
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal" style="position: absolute; opacity: 0;"> 
                                    <label for="lot_number">Online Qc</label>                               </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;"> 
                                    <label for="lot_number">Rejections Values</label>                               </div>
                            </div>
                        </div> <!--  END Row -->
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal" style="position: absolute; opacity: 0;">  
                                    <label for="lot_number">Cold Chain Monitering</label>                              
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal" style="position: absolute; opacity: 0;"> 
                                    <label for="lot_number">Thawing Block Inspection(Access to the Value)</label>                               </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;"> 
                                    <label for="lot_number">Thawign Block Inspection(Authorization to fill) </label>                               </div>
                            </div>
                        </div> <!--  END Row -->
                        
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">
                                            <label for="user_name" class="">Lot Consolidation</label>
                                    </div>
                                </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">  
                                    <label for="lot_number">Edit </label>                              
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;"> 
                                    <label for="lot_number">Qc Report</label>                              
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;"> 
                                    <label for="lot_number">Export Qc Lot Report</label>                              
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">
                                            <label for="user_name" class="">Lot Status</label>
                                    </div>
                                </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">  
                                    <label for="lot_number">Size Allocations</label>                              
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;"> 
                                    <label for="lot_number">Status</label>                              
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;"> 
                                    <label for="lot_number">Priority</label>                              
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">
                                            <label for="user_name" class="">Scars</label>
                                    </div>
                                </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">  
                                    <label for="lot_number">Export Scars Sheet</label>                              
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;"> 
                                    <label for="lot_number">Export Scars Database</label>                              
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">
                                            <label for="user_name" class="">Inventory & Shipment</label>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                            <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">
                                            <label for="user_name" class="">Inventory Management </label>
                                    </div>
                                </div>
                        </div> <!--  END Row -->
                        
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                            <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">
                                            <label for="user_name" class="">Order Summary </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">
                                    <label for="user_name" class="">Order Summary </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">
                                    <label for="user_name" class="">Inventory </label>
                                    </div>
                                </div>
                        </div> <!--  END Row -->
                        
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <input type="checkbox" class="minimal"  style="position: absolute; opacity: 0;">
                                            <label for="user_name" class="">Shipment Preparation</label>
                                    </div>
                                </div>
                        </div> <!--  END Row -->
                        
                        <div class="row">
                                    <div class="col-md-offset-6 col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                    </div>
                        </div> <!--  END Row -->
                        
                    </div><!-- /.tab-content -->
                </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div>
    </section>
</div> 

@endsection

@section('customjs')

@endsection
