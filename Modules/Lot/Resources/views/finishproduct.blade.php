@extends('layouts.app')
@section('title') <title>New Fish Arrival List </title> 
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <div class="row">
            <div class="col-xs-12">
                @if (Session::has('success'))
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
                <div class="box box-primary">   
                <div class="box-header ">
                    <h3 class="box-title">Fish Arrivals List</h3> <div class="pull-right alertmessage"></div>
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
                        <td>{{ $row['landing_date'] }}</td>
                        <td>{{ $row['unloading_place'] }}</td>
                        <td></td>
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
            </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection
@section('customjs')
<script>
$(function () {
    $('#example1').dataTable({
    "ordering": false,
    //"bPaginate": true,
    "bLengthChange": true,
    "pageLength": 2,
    "bFilter": true,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": false
    });

});
</script>

@endsection

