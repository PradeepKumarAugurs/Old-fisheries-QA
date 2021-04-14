
@extends('layouts.app')
@section('title') <title> Quality Control </title> 
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header"> Spot Inspection </h2>
            <div class="row">
                <div class="messageDiv">
                </div>
                <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Spot Inspection</a></li>
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
                                <label for="lot_number">Supplier</label>
                                <input type="text" name="lot_number" id="lot_number" class="form-control" placeholder="Enter Lot Number">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Producer</label>
                                    <input type="text" name="production_date" id="production_date" class="form-control" placeholder="Production Date">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="lot_number">Location</label>
                                <input type="text" name="lot_number" id="lot_number" class="form-control" placeholder="Enter Lot Number">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Product</label>
                                    <input type="text" name="production_date" id="production_date" class="form-control" placeholder="Production Date">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="lot_number">Type</label>
                                <input type="text" name="lot_number" id="lot_number" class="form-control" placeholder="Enter Lot Number">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Quality</label>
                                    <input type="text" name="production_date" id="production_date" class="form-control" placeholder="Production Date">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="lot_number">Unit</label>
                                <input type="text" name="lot_number" id="lot_number" class="form-control" placeholder="Enter Lot Number">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Weight/Unit</label>
                                    <input type="text" name="production_date" id="production_date" class="form-control" placeholder="Production Date">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="lot_number">Number of Unit</label>
                                <input type="text" name="lot_number" id="lot_number" class="form-control" placeholder="Enter Lot Number">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Total Qty</label>
                                    <input type="text" name="production_date" id="production_date" class="form-control" placeholder="Production Date">
                                </div>
                            </div>
                        </div> <!--  END Row -->

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="lot_number">Boat</label>
                                <input type="text" name="lot_number" id="lot_number" class="form-control" placeholder="Enter Lot Number">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Fishing Technique</label>
                                    <input type="text" name="production_date" id="production_date" class="form-control" placeholder="Production Date">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="lot_number">Fishing Date</label>
                                <input type="text" name="lot_number" id="lot_number" class="form-control" placeholder="Enter Lot Number">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Fishing Zone</label>
                                    <input type="text" name="production_date" id="production_date" class="form-control" placeholder="Production Date">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="lot_number">Fishing Time</label>
                                <input type="text" name="lot_number" id="lot_number" class="form-control" placeholder="Enter Lot Number">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number"></label>
                                    <input type="text" name="production_date" id="production_date" class="form-control" placeholder="Production Date">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="lot_number">Unloading Place</label>
                                <input type="text" name="lot_number" id="lot_number" class="form-control" placeholder="Enter Lot Number">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lot_number">Unloading Date</label>
                                    <input type="text" name="production_date" id="production_date" class="form-control" placeholder="Production Date">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div><!-- /.tab-pane -->

                   
                </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div>
    </section>
</div> 

@endsection

@section('customjs')

@endsection
