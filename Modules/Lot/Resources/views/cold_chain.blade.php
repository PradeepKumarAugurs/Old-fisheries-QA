

@extends('layouts.app')
@section('title') <title>Production & Quality </title> 

@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">New Lot Lists</h2>
            <div class="row">
                <div class="messageDiv">
                </div>
                <div class="col-md-12">
                
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Lot Info</a></li>
                        <li class="@if(Session::has('arrival_id') && Session::get('arrival_id')) active  @endif"><a href="#tab_2" data-toggle="tab">Online Qc</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Finish Product Distribution</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Lab Analysis</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Cold Chain</a></li>
                        <li><a href="#tab_6" data-toggle="tab">Thawing Inspection</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
					
                    <div class="tab-pane active" id="tab_1">
					    <div class="box box-primary">   
                <div class="box-header ">
                    <h3 class="box-title">New Lot</h3> <div class="pull-right alertmessage"></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                @if(isset($FishArrivalList) && count($FishArrivalList))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Landing Data</th>
                        <th>Unloading Place</th>
                        <th>#</th>
                        <th>Boat</th>
                        <th>Truck Id</th> 
                        <th>ETA</th>
                        <th>ETD</th>
                        <th>Yoyage</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($FishArrivalList as $row)
                    
                    <tr id="row_{{$row->id}}">
                        <td></td>
                        <td>{{ $row['landing_date'] }}</td>
                        <td>{{ $row['unloading_place'] }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                        <td>
                            @if($row->role=='1')
                                Admin
                            @elseif($row->role=='2')
                                Supplier
                            @elseif($row->role=='3')
                                Producer 
                            @elseif($row->role=='4')
                                Supplier and Producer
                            @elseif($row->role=='5')
                                Inspector 
                            @elseif($row->role=='6')
                                New User 
                            @else
                                Other
                            @endif
                        </td>
                        <td>
                        <!-- <a href="javascript:void(0);" title="delete" onclick="delete_driver({{$row->id}});" ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; -->
                        
                        <!--<a href="{{url('accountmanagement/updateVessels/'.$row->id)}}" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>-->
                        <a href="#" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    </table>
                    @else
                    <h5 class="box-title text-danger">There is no data.</h3>
                    @endif
                    <div class="row">
                    <div class="col-md-2">
                    <!--<a href="{{url('accountmanagement/createVessele')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Vessel</a> -->
                    </div>
                    </div>
                </div><!-- /.box-body -->
                </div><!-- /.box -->
					
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_2">
                    <div class="box box-primary">   
                <div class="box-header ">
                    <h3 class="box-title">Online Qc Summary List</h3> <div class="pull-right alertmessage"></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                @if(isset($Online_qc_list) && count($Online_qc_list))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Lot Number</th>
                        <th>Production Date </th>
                        <th>Production Line</th>
                        <th>Standard Weight</th>
                        <th>Balance Reading</th> 
                        <th>Balance Accuracy</th>
                        <th>Control Name</th>
                        <th>Other</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Online_qc_list as $row)
                    
                    <tr id="row_{{$row->id}}">
                        <td></td>
                        <td>{{ $row['lot_number'] }}</td>
                        <td>{{ $row['production_date'] }}</td>
                        <td>{{ $row['production_line'] }}</td>
                        <td>{{ $row['standard_weight'] }}</td>
                        <td>{{ $row['balance_reading'] }}</td>
                        <td>{{ $row['balance_accuracy'] }}</td>
                        <td>{{ $row['control_name'] }}</td>
                        <td></td>
                        <td>
                            @if($row->role=='1')
                                Admin
                            @elseif($row->role=='2')
                                Supplier
                            @elseif($row->role=='3')
                                Producer 
                            @elseif($row->role=='4')
                                Supplier and Producer
                            @elseif($row->role=='5')
                                Inspector 
                            @elseif($row->role=='6')
                                New User 
                            @else
                                Other
                            @endif
                        </td>
                        <td>
                        <!-- <a href="javascript:void(0);" title="delete" onclick="delete_driver({{$row->id}});" ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; -->
                        
                        <!--<a href="{{url('accountmanagement/updateVessels/'.$row->id)}}" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>-->
                        <a href="#" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    </table>
                    @else
                    <h5 class="box-title text-danger">There is no data.</h3>
                    @endif
                    <div class="row">
                    <div class="col-md-2">
                    <!--<a href="{{url('accountmanagement/createVessele')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Vessel</a> -->
                    </div>
                    </div>
                </div><!-- /.box-body -->
                </div><!-- /.box -->
                    </div><!-- /.tab-pane -->

                   
                    <div class="tab-pane" id="tab_3">
                    <div class="box box-primary">   
                <div class="box-header ">
                    <h3 class="box-title">Finish Product List</h3> <div class="pull-right alertmessage"></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                @if(isset($finish_list) && count($finish_list))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>lot Number</th>
                        <th>Production Date</th>
                        <th>Type</th>
                        <th>Weight</th>
                        <th>Discription</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($finish_list as $row)
                    
                    <tr id="row_{{$row->id}}">
                        <td>{{ $row['lot_number'] }}</td>
                        <td>{{ $row['production_date'] }}</td>
                        <td>{{ $row['type'] }}</td>
                        <td>{{ $row['weight'] }}</td>
                        <td>{{ $row['discription'] }}</td>
                        <td></td>
                        
                        <td>
                            @if($row->role=='1')
                                Admin
                            @elseif($row->role=='2')
                                Supplier
                            @elseif($row->role=='3')
                                Producer 
                            @elseif($row->role=='4')
                                Supplier and Producer
                            @elseif($row->role=='5')
                                Inspector 
                            @elseif($row->role=='6')
                                New User 
                            @else
                                Other
                            @endif
                        </td>
                        <td>
                        <!-- <a href="javascript:void(0);" title="delete" onclick="delete_driver({{$row->id}});" ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; -->
                        
                        <!--<a href="{{url('accountmanagement/updateVessels/'.$row->id)}}" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>-->
                        <a href="#" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    </table>
                    @else
                    <h5 class="box-title text-danger">There is no data.</h3>
                    @endif
                    <div class="row">
                    <div class="col-md-2">
                    <!--<a href="{{url('accountmanagement/createVessele')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Vessel</a> -->
                    </div>
                    </div>
                </div><!-- /.box-body -->
                </div><!-- /.box -->
                    </div><!--- TAB panel --->

                    <div class="tab-pane" id="tab_4">
                    <div class="box box-primary">   
                <div class="box-header ">
                    <h3 class="box-title">Lab Analysis</h3> <div class="pull-right alertmessage"></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                @if(isset($lab_lists) && count($lab_lists))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Lot Number</th>
                        <th>Production Date</th>
                        <th>Histamine Reception</th>
                        <th>Hista After Freezing</th>
                        <th>Comment</th> 
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lab_lists as $row)
                    
                    <tr id="row_{{$row->id}}">
                    
                        <td></td>
                        <td>{{ $row['lot_number'] }}</td>
                        <td>{{ $row['production_date'] }}</td>
                        <td>{{ $row['histamine_reception'] }}</td>
                        <td>{{ $row['hista_after_freezing'] }}</td>
                        <td>{{ $row['comment'] }}</td>
                        <td>
                            @if($row->role=='1')
                                Admin
                            @elseif($row->role=='2')
                                Supplier
                            @elseif($row->role=='3')
                                Producer 
                            @elseif($row->role=='4')
                                Supplier and Producer
                            @elseif($row->role=='5')
                                Inspector 
                            @elseif($row->role=='6')
                                New User 
                            @else
                                Other
                            @endif
                        </td>
                        <td>
                        <!-- <a href="javascript:void(0);" title="delete" onclick="delete_driver({{$row->id}});" ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; -->
                        
                        <!--<a href="{{url('accountmanagement/updateVessels/'.$row->id)}}" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>-->
                        <a href="#" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    </table>
                    @else
                    <h5 class="box-title text-danger">There is no data.</h3>
                    @endif
                    <div class="row">
                    <div class="col-md-2">
                    <!--<a href="{{url('accountmanagement/createVessele')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Vessel</a> -->
                    </div>
                    </div>
                </div><!-- /.box-body -->
                </div><!-- /.box -->
                    </div> <!--- Tab panel --->

                    <div class="tab-pane" id="tab_5">
                    <div class="box box-primary">   
                <div class="box-header ">
                    <h3 class="box-title">Cold chain List</h3> <div class="pull-right alertmessage"></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                @if(isset($cold_list) && count($cold_list))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Lot Number</th>
                        <th>Production Date</th>
                        <th>Reading Date</th>
                        <th>Cold Room Number</th>
                        <th>Fish Temp</th>
                        <th>Cold Room Temp</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cold_list as $row)
                    
                    <tr id="row_{{$row->id}}">
                        <td></td>
                        <td>{{ $row['lot_number'] }}</td>
                        <td>{{ $row['production_date'] }}</td>
                        <td>{{ $row['reading_date'] }}</td>
                        <td>{{ $row['cold_room_number'] }}</td>
                        <td>{{ $row['fish_temp'] }}</td>
                        <td>{{ $row['cold_room_temp'] }}</td>
                        <td>{{ $row['comment'] }}</td>
                       
                        <td>
                            @if($row->role=='1')
                                Admin
                            @elseif($row->role=='2')
                                Supplier
                            @elseif($row->role=='3')
                                Producer 
                            @elseif($row->role=='4')
                                Supplier and Producer
                            @elseif($row->role=='5')
                                Inspector 
                            @elseif($row->role=='6')
                                New User 
                            @else
                                Other
                            @endif
                        </td>
                        <td>
                        <!-- <a href="javascript:void(0);" title="delete" onclick="delete_driver({{$row->id}});" ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; -->
                        
                        <!--<a href="{{url('accountmanagement/updateVessels/'.$row->id)}}" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>-->
                        <a href="#" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    </table>
                    @else
                    <h5 class="box-title text-danger">There is no data.</h3>
                    @endif
                    <div class="row">
                    <div class="col-md-2">
                    <!--<a href="{{url('accountmanagement/createVessele')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Vessel</a> -->
                    </div>
                    </div>
                </div><!-- /.box-body -->
                </div><!-- /.box -->
                    </div> <!-- tab panel -->

                   
                    <div class="tab-pane" id="tab_6">
                    <div class="box box-primary">   
                <div class="box-header ">
                    <h3 class="box-title">Thawing Inspection</h3> <div class="pull-right alertmessage"></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                @if(isset($ThawingList) && count($ThawingList))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Lot Number</th>
                        <th>Production Date</th>
                        <th>Invoice Weight</th>
                        <th>Frozen Weight</th>
                        <th>Total Pieces</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ThawingList as $row)
                    
                    <tr id="row_{{$row->id}}">
                        <td></td>
                        <td>{{ $row['lot_number'] }}</td>
                        <td>{{ $row['production_date'] }}</td>
                        <td>{{ $row['invoiced_weight'] }}</td>
                        <td>{{ $row['frozen_weight'] }}</td>
                        <td>{{ $row['total_pieces'] }}</td>
                        <td>{{ $row['comment'] }}</td>
                        <td>
                            @if($row->role=='1')
                                Admin
                            @elseif($row->role=='2')
                                Supplier
                            @elseif($row->role=='3')
                                Producer 
                            @elseif($row->role=='4')
                                Supplier and Producer
                            @elseif($row->role=='5')
                                Inspector 
                            @elseif($row->role=='6')
                                New User 
                            @else
                                Other
                            @endif
                        </td>
                        <td>
                        <!-- <a href="javascript:void(0);" title="delete" onclick="delete_driver({{$row->id}});" ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; -->
                        
                       <!-- <a href="{{url('lot/ThawingList/'.$row->id)}}" title="edit Thawing"><i class="fa fa-edit text-success"></i></a></td>-->
                        <a href="#" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    @else
                    <h5 class="box-title text-danger">There is no data.</h5>
                    @endif
                    <div class="row">
                    <div class="col-md-2">
                    <!--<a href="{{url('accountmanagement/createVessele')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Vessel</a> -->
                    </div>
                    </div>
                </div><!-- /.box-body -->
                </div><!-- /.box -->   
                    </div> <!-- tab panel -->

                </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div>
    </section>
</div> 

@endsection

@section('customjs')

@endsection

