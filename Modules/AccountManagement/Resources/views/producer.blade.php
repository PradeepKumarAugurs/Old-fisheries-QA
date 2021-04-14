@extends('layouts.app')
@section('title') <title>Producer List </title> 
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <div class="row">
            <div class="col-xs-12">
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
                <div class="box box-primary">
                <div class="box-header ">
                    <h3 class="box-title">All Producers List</h3> <div class="pull-right alertmessage"></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                @if(!empty($getProducersList) && count($getProducersList))
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Producer Name</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Created Date</th>
                        <th>Status</th>
                        <th>Manage</th> 
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($getProducersList as $row)
                    
                    <tr id="row_{{$row->id}}">
                        <td>{{ucfirst($row['name'])}}</td>
                        <td>@if(isset($row->countries['name'])){{$row->countries['name'] }}@endif</td>
                        <td>@if(isset($row->citys['name'])){{ $row->citys['name'] }}@endif</td>
                        
                        <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$row->created_at)->format('d/m/Y')}} </td>
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
                        <a href="{{url('accountmanagement/editProducers/'.$row->id)}}" title="editProducers"><i class="fa fa-edit text-success"></i></a></td> 
                        </tr>
                        @endforeach
                    </tbody>
                    
                    </table>
                    @else
                    <h5 class="box-title text-danger">There is no data.</h3>
                    @endif
                    <div class="row">
                    <div class="col-md-2">
                    <a href="{{url('accountmanagement/addProducer')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Producer</a>
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

