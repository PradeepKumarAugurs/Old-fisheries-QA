@extends('layouts.app')
@section('title') <title>Vessel List </title> 
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
                    <h3 class="box-title">All Vessels List</h3> <div class="pull-right alertmessage"></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                @if(isset($getVesselList) && count($getVesselList))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Vessel Name</th>
                        <th>Vessel Registration</th>
                        <th>Unique Indentification</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($getVesselList as $row)
                    
                    <tr id="row_{{$row->id}}">
                        <td>{{ucfirst($row['vessel_name'])}}</td>
                        <td>{{ $row['vessel_registration'] }}</td>
                        <td>{{ $row['unique_indentification'] }}</td>
                        
                        <!--td>
                            @if($row->status=='1')
                                <span class="btn btn-xs btn-success">Active</span>
                            @elseif($row->role!='1')
                                <span class="btn btn-xs btn-danger">Inactive</span>
                            @endif 
                        </td-->
                        <td>
                        <!-- <a href="javascript:void(0);" title="delete" onclick="delete_driver({{$row->id}});" ><i class="fa fa-trash text-danger"></i>&nbsp;&nbsp; -->
                        
                        <a href="{{url('accountmanagement/updateVessels/'.$row->id)}}" title="editProducers"><i class="fa fa-edit text-success"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    </table>
                    @else
                    <h5 class="box-title text-danger">There is no data.</h3>
                    @endif
                    <div class="row">
                    <div class="col-md-2">
                    <a href="{{url('accountmanagement/createVessele')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Vessel</a>
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

