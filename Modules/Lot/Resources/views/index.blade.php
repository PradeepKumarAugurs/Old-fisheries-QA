
@extends('layouts.app')
@section('title') <title>AccountManagement </title> 
<style>
    a.add-new-column {
    border-radius: 50%;
    }
    a.add-new-row {
        border-radius: 50%;
    }
    .td-data{
        line-height: 3.42857143;
    }
    .pointer {
        cursor: pointer;
    }
</style>
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">New Lot </h2>
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
                    <li class="@if(Session::has('tab') && Session::get('tab') == 'tab_1') active  @endif"><a href="#tab_1" data-toggle="tab">Lot Info</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Online QC</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Finish Product Distribution</a></li>
                    <!--li><a href="#tab_4" data-toggle="tab">Weight</a></li-->
                    <li><a href="#tab_5" data-toggle="tab">Length</a></li>
                    <li class="@if(Session::has('tab') && Session::get('tab') == 'tab_6') active  @endif"><a href="#tab_6" data-toggle="tab">Lab Analysis</a></li>
                    <li><a href="#tab_7" data-toggle="tab">Cold Chain</a></li>
                    <li><a href="#tab_8" data-toggle="tab">Cold Storage</a></li>
                    <li><a href="#tab_9" data-toggle="tab">Thawing Inspection</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>

                    <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <form action="{{ url('lot/createLotInfo') }}" id="lotinfoform" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="lot_number" class="lot_number_text">Lot Number</label>
                                <input type="text" name="lot_number" value="{{old('lot_number')}}" id="lot_number" class="form-control lot_number_border @error('lot_number') is-invalid @enderror" placeholder="Enter Lot Number">
                                @error('production_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="production_date" class="lot_number_text">Production Date</label>
                                    <input type="text" name="production_date"  value="{{old('production_date')}}" id="production_date" class="form-control datepicker lot_number_border @error('production_date') is-invalid @enderror" placeholder="Enter Production Date">
                                    @error('production_date')
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
                                    <label for="producer_id">Producer</label>
                                     <select  class="form-control @error('producer_id') is-invalid @enderror" value="{{old('producer_id')}}" name="producer_id" id="producer_id">
                                        <option value="">-- Select Producer --</option>  
                                        @if(isset($producer_list) && count($producer_list))
                                        @foreach($producer_list as $producer)
                                        <option value="{{$producer->id}}" @if(old('producer_id')) selected @endif >{{($producer->name=="")?ucfirst($producer->name):ucfirst($producer->name)}}</option> 
                                        @endforeach
                                        @endif 
                                    </select> 
                                    @error('producer_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="plant_location">Plant Location</label>
                                    <input type="text" name="plant_location" value="{{old('plant_location')}}" id="plant_location" class="form-control @error('plant_location') is-invalid @enderror" placeholder="Enter Plant Location">
                                    @error('plant_location')
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
                                    <label for="product">Product</label>
                                    <select name="product" id="product" value="{{old('product')}}" class="form-control @error('product') is-invalid @enderror">
                                        <option value="">-- Select Product--</option>
                                        <option value="1">SARDINE</option>
                                        <option value="2">MAKREL</option>
                                    </select>
                                    @error('product')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="type">Type</label>
                                    <select  class="form-control @error('type') is-invalid @enderror" value="{{old('type')}}" name="type" id="type">
                                        <option value="">-- Select Type --</option>  
                                        @if(isset($type) && count($type))
                                        @foreach($type as $type)
                                        <option value="{{$type->id}}" @if(old('type')) selected @endif >{{($type->title=="")?ucfirst($type->title):ucfirst($type->title)}}</option> 
                                        @endforeach
                                        @endif 
                                    </select> 
                                    @error('type')
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
                                    <label for="size">Size/Grade</label>
                                    <input type="text" name="size" value="{{old('size')}}" class="form-control @error('size') is-invalid @enderror" placeholder="Enter Size/Grade">
                                    @error('size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="lot_number">Quality</label>
                                    <select name="quality" id="quality" value="{{old('quality')}}" class="form-control @error('quality') is-invalid @enderror">
                                    <option value="">-- Select Quality --</option>  
                                        @if(isset($quality) && count($quality))
                                        @foreach($quality as $quality)
                                        <option value="{{$quality->id}}" @if(old('quality')) selected @endif >{{($quality->title=="")?ucfirst($quality->title):ucfirst($quality->title)}}</option> 
                                        @endforeach
                                        @endif 
                                    </select>
                                    @error('quality')
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
                                <label for="unit_id">Unit</label>
                                    <select name="unit_id" id="unit_id" class="form-control @error('unit_id') is-invalid @enderror">
                                        <option value="">-- Select Unit --</option>  
                                            @if(isset($unit) && count($unit))
                                            @foreach($unit as $unit)
                                        <option value="{{$unit->id}}" @if(old('unit')) selected @endif >{{($unit->title=="")?ucfirst($unit->title):ucfirst($unit->title)}}</option> 
                                            @endforeach
                                            @endif 
                                    </select>
                                @error('unit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="weight">Weight/Unit</label>
                                    <input type="text" name="weight" value="{{old('weight')}}" class="form-control @error('weight') is-invalid @enderror" placeholder="Size">
                                    @error('weight')
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
                                <label for="number_of_unit">Number Of Unit</label>
                                <input type="text" name="number_of_unit" value="{{old('number_of_unit')}}" id="number_of_unit" class="form-control @error('number_of_unit') is-invalid @enderror" placeholder="Enter Number of Unit">
                                @error('number_of_unit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="total_quantity">Total Quantity</label>
                                    <input type="text" name="total_quantity" value="{{old('total_quantity')}}" id="total_quantity" class="form-control @error('total_quantity') is-invalid @enderror" placeholder="Enter Total Quantity">
                                    @error('total_quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>   
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lot_comments">Enter Comment</label>
                                    <textarea name="lot_comments" value="{{old('lot_comments')}}" class="form-control" placeholder="Enter Comment ..."></textarea>
                                    @error('lot_comments')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                            </div>  
                        </div> <!--  END Row -->

                        <div class="row">
                            <div class="col-md-offset-6 col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div><!--  END Row -->
                        
                        </form>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_2">
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-11">
                                    <table id="control-table" class="table table-border table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th class="info"><input type="text" readonly=""  value="Reading" class="form-control"></th>
                                                <td><input type="text" name=""  class="form-control" placeholder="Enter Reading"></td>
                                                <th class="info"><input type="text" readonly=""  value="Rack #" class="form-control"></th>
                                                <td><input type="text" name=""  class="form-control" placeholder="Enter Rack Temp"></td>
                                            </tr>
                                            <tr>
                                                <th class="info"><input type="text" readonly=""  value="Production Line" class="form-control"></th>
                                                <td><input type="text" name=""  class="form-control" placeholder="Enter Production Line"></td>
                                                <th class="info"><input type="text" readonly=""  value="Fish Temp" class="form-control"></th>
                                                <td><input type="text" name=""  class="form-control" placeholder="Enter Fish Temp"></td>
                                            </tr>
                                            <tr>
                                                <th class="info"><input type="text" readonly=""  value="Invoice Weight" class="form-control"></th>
                                                <td><input type="text" name=""  class="form-control" placeholder="Enter Invoice Weight"></td>
                                                <th class="info"><input type="text" readonly=""  value="Net weight" class="form-control"></th>
                                                <td><input type="text" name=""  class="form-control" placeholder="Enter Net Weight"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="new_rows_button">
                                    <a href="javascript:void(0)" data-table="reading" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table  class="table table-border table-striped">
                                    <thead>
                                    <tr class="info">
                                        <th>Total Species</th>
                                        <th>Total Species</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Mechanical Damage</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Broken Belly</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Slightly Broken Bell</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Soft</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Other Species</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Gill Cut</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Bad Cut</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Light Damage</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Tail </label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Tail <1 cm (pointers)</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Guts</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Guts (weight)</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                   <input type="" name="" class="form-control" placeholder="Enter guts weight gram">
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <h4><label>Resistence Test </label></h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                   <table class="table table-bordered">
                                        <tr>
                                        <th class="info">S</th>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td>6</td>
                                        <td>7</td>
                                        <td>8</td>
                                        <td>9</td>
                                        <td>10</td>
                                        <td>x</td>
                                       </tr>
                                        <tr>
                                        <th class="info">M</th>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td>6</td>
                                        <td>7</td>
                                        <td>8</td>
                                        <td>9</td>
                                        <td>10</td>
                                        <td>x</td>
                                        </tr>
                                        <tr>               
                                        <th class="info">L</th>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td>6</td>
                                        <td>7</td>
                                        <td>8</td>
                                        <td>9</td>
                                        <td>10</td>
                                        <td>x</td>
                                        </tr>
                                        <tr>   
                                   </table>
                                </div>
                            </div>    
                         </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div><!--  END Row -->
                        </form>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_3">
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <table class="table table-bordered">
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">0</label></td>
                                        <td><label for="meat" class="td-data pointer">1</label></td>
                                        <td><label for="meat" class="td-data pointer">2</label></td>
                                        <td><label for="meat" class="td-data pointer">3</label></td>
                                        <td><label for="meat" class="td-data pointer">4</label></td>
                                        <td><label for="meat" class="td-data pointer">5</label></td>
                                        <td><label for="meat" class="td-data pointer">6</label></td>
                                        <td><label for="meat" class="td-data pointer">7</label></td>
                                        <td><label for="meat" class="td-data pointer">8</label></td>
                                        <td><label for="meat" class="td-data pointer">9</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">10</label></td>
                                        <td><label for="meat" class="td-data pointer">11</label></td>
                                        <td><label for="meat" class="td-data pointer">12</label></td>
                                        <td><label for="meat" class="td-data pointer">13</label></td>
                                        <td><label for="meat" class="td-data pointer">14</label></td>
                                        <td><label for="meat" class="td-data pointer">15</label></td>
                                        <td><label for="meat" class="td-data pointer">16</label></td>
                                        <td><label for="meat" class="td-data pointer">17</label></td>
                                        <td><label for="meat" class="td-data pointer">18</label></td>
                                        <td><label for="meat" class="td-data pointer">19</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">20</label></td>
                                        <td><label for="meat" class="td-data pointer">21</label></td>
                                        <td><label for="meat" class="td-data pointer">22</label></td>
                                        <td><label for="meat" class="td-data pointer">23</label></td>
                                        <td><label for="meat" class="td-data pointer">24</label></td>
                                        <td><label for="meat" class="td-data pointer">25</label></td>
                                        <td><label for="meat" class="td-data pointer">26</label></td>
                                        <td><label for="meat" class="td-data pointer">27</label></td>
                                        <td><label for="meat" class="td-data pointer">28</label></td>
                                        <td><label for="meat" class="td-data pointer">29</label></td>
                                        </tr>
                                        <tr>               
                                        <td><label for="meat" class="td-data pointer">30</label></td>
                                        <td><label for="meat" class="td-data pointer">31</label></td>
                                        <td><label for="meat" class="td-data pointer">32</label></td>
                                        <td><label for="meat" class="td-data pointer">33</label></td>
                                        <td><label for="meat" class="td-data pointer">34</label></td>
                                        <td><label for="meat" class="td-data pointer">35</label></td>
                                        <td><label for="meat" class="td-data pointer">36</label></td>
                                        <td><label for="meat" class="td-data pointer">37</label></td>
                                        <td><label for="meat" class="td-data pointer">38</label></td>
                                        <td><label for="meat" class="td-data pointer">39</label></td>
                                        </tr>
                                        <tr>               
                                        <td><label for="meat" class="td-data pointer">40</label></td>
                                        <td><label for="meat" class="td-data pointer">41</label></td>
                                        <td><label for="meat" class="td-data pointer">42</label></td>
                                        <td><label for="meat" class="td-data pointer">43</label></td>
                                        <td><label for="meat" class="td-data pointer">44</label></td>
                                        <td><label for="meat" class="td-data pointer">45</label></td>
                                        <td><label for="meat" class="td-data pointer">46</label></td>
                                        <td><label for="meat" class="td-data pointer">47</label></td>
                                        <td><label for="meat" class="td-data pointer">48</label></td>
                                        <td><label for="meat" class="td-data pointer">49</label></td>
                                        </tr>
                                        <tr>               
                                        <td><label for="meat" class="td-data pointer">50</label></td>
                                        <td><label for="meat" class="td-data pointer">51</label></td>
                                        <td><label for="meat" class="td-data pointer">52</label></td>
                                        <td><label for="meat" class="td-data pointer">53</label></td>
                                        <td><label for="meat" class="td-data pointer">54</label></td>
                                        <td><label for="meat" class="td-data pointer">55</label></td>
                                        <td><label for="meat" class="td-data pointer">56</label></td>
                                        <td><label for="meat" class="td-data pointer">57</label></td>
                                        <td><label for="meat" class="td-data pointer">58</label></td>
                                        <td><label for="meat" class="td-data pointer">59</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">60</label></td>
                                        <td><label for="meat" class="td-data pointer">61</label></td>
                                        <td><label for="meat" class="td-data pointer">62</label></td>
                                        <td><label for="meat" class="td-data pointer">63</label></td>
                                        <td><label for="meat" class="td-data pointer">64</label></td>
                                        <td><label for="meat" class="td-data pointer">65</label></td>
                                        <td><label for="meat" class="td-data pointer">66</label></td>
                                        <td><label for="meat" class="td-data pointer">67</label></td>
                                        <td><label for="meat" class="td-data pointer">68</label></td>
                                        <td><label for="meat" class="td-data pointer">69</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">70</label></td>
                                        <td><label for="meat" class="td-data pointer">71</label></td>
                                        <td><label for="meat" class="td-data pointer">72</label></td>
                                        <td><label for="meat" class="td-data pointer">73</label></td>
                                        <td><label for="meat" class="td-data pointer">74</label></td>
                                        <td><label for="meat" class="td-data pointer">75</label></td>
                                        <td><label for="meat" class="td-data pointer">76</label></td>
                                        <td><label for="meat" class="td-data pointer">77</label></td>
                                        <td><label for="meat" class="td-data pointer">78</label></td>
                                        <td><label for="meat" class="td-data pointer">79</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">80</label></td>
                                        <td><label for="meat" class="td-data pointer">81</label></td>
                                        <td><label for="meat" class="td-data pointer">82</label></td>
                                        <td><label for="meat" class="td-data pointer">83</label></td>
                                        <td><label for="meat" class="td-data pointer">84</label></td>
                                        <td><label for="meat" class="td-data pointer">85</label></td>
                                        <td><label for="meat" class="td-data pointer">86</label></td>
                                        <td><label for="meat" class="td-data pointer">87</label></td>
                                        <td><label for="meat" class="td-data pointer">88</label></td>
                                        <td><label for="meat" class="td-data pointer">89</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">90</label></td>
                                        <td><label for="meat" class="td-data pointer">91</label></td>
                                        <td><label for="meat" class="td-data pointer">92</label></td>
                                        <td><label for="meat" class="td-data pointer">93</label></td>
                                        <td><label for="meat" class="td-data pointer">94</label></td>
                                        <td><label for="meat" class="td-data pointer">95</label></td>
                                        <td><label for="meat" class="td-data pointer">96</label></td>
                                        <td><label for="meat" class="td-data pointer">97</label></td>
                                        <td><label for="meat" class="td-data pointer">98</label></td>
                                        <td><label for="meat" class="td-data pointer">99</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">100</label></td>
                                        <td><label for="meat" class="td-data pointer">101</label></td>
                                        <td><label for="meat" class="td-data pointer">102</label></td>
                                        <td><label for="meat" class="td-data pointer">103</label></td>
                                        <td><label for="meat" class="td-data pointer">104</label></td>
                                        <td><label for="meat" class="td-data pointer">105</label></td>
                                        <td><label for="meat" class="td-data pointer">106</label></td>
                                        <td><label for="meat" class="td-data pointer">107</label></td>
                                        <td><label for="meat" class="td-data pointer">108</label></td>
                                        <td><label for="meat" class="td-data pointer">109</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">110</label></td>
                                        <td><label for="meat" class="td-data pointer">111</label></td>
                                        <td><label for="meat" class="td-data pointer">112</label></td>
                                        <td><label for="meat" class="td-data pointer">113</label></td>
                                        <td><label for="meat" class="td-data pointer">114</label></td>
                                        <td><label for="meat" class="td-data pointer">115</label></td>
                                        <td><label for="meat" class="td-data pointer">116</label></td>
                                        <td><label for="meat" class="td-data pointer">117</label></td>
                                        <td><label for="meat" class="td-data pointer">118</label></td>
                                        <td><label for="meat" class="td-data pointer">119</label></td>
                                        </tr>
                                    </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <table class="table table-bordered">
                                            <tr class="info">
                                                <th># No. </th>
                                                <th>Weight</th>
                                            </tr>
                                            <tr>
                                                <td><label>1</label> </td>
                                                <td><input type="text" name="weight" id="input_value"  class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>2</label> </td>
                                                <td><input type="text" name="weight"  class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>3</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>4</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>5</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>6</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>7</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>8</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>9</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>10</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>11</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>12</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>13</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>14</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>15</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>16</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>17</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>18</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>19</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>20</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>21</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>22</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>23</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>24</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>25</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>26</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Avg</label> </td>
                                                <td><input type="text" name="avg" value="81.8" class="form-control" placeholder="Enter Avg"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Std</label> </td>
                                                <td><input type="text" name="std" value="11.7" class="form-control" placeholder="Enter Std"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Min</label> </td>
                                                <td><input type="text" name="min" value="65" class="form-control" placeholder="Enter Min"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Max</label> </td>
                                                <td><input type="text" name="max" value="101" class="form-control" placeholder="Enter Max"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END Row -->
                            <button type="submit" class="btn btn-primary"> Submit </button>
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <table class="table table-bordered">
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">0</label></td>
                                        <td><label for="meat" class="td-data pointer">1</label></td>
                                        <td><label for="meat" class="td-data pointer">2</label></td>
                                        <td><label for="meat" class="td-data pointer">3</label></td>
                                        <td><label for="meat" class="td-data pointer">4</label></td>
                                        <td><label for="meat" class="td-data pointer">5</label></td>
                                        <td><label for="meat" class="td-data pointer">6</label></td>
                                        <td><label for="meat" class="td-data pointer">7</label></td>
                                        <td><label for="meat" class="td-data pointer">8</label></td>
                                        <td><label for="meat" class="td-data pointer">9</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">10</label></td>
                                        <td><label for="meat" class="td-data pointer">11</label></td>
                                        <td><label for="meat" class="td-data pointer">12</label></td>
                                        <td><label for="meat" class="td-data pointer">13</label></td>
                                        <td><label for="meat" class="td-data pointer">14</label></td>
                                        <td><label for="meat" class="td-data pointer">15</label></td>
                                        <td><label for="meat" class="td-data pointer">16</label></td>
                                        <td><label for="meat" class="td-data pointer">17</label></td>
                                        <td><label for="meat" class="td-data pointer">18</label></td>
                                        <td><label for="meat" class="td-data pointer">19</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">20</label></td>
                                        <td><label for="meat" class="td-data pointer">21</label></td>
                                        <td><label for="meat" class="td-data pointer">22</label></td>
                                        <td><label for="meat" class="td-data pointer">23</label></td>
                                        <td><label for="meat" class="td-data pointer">24</label></td>
                                        <td><label for="meat" class="td-data pointer">25</label></td>
                                        <td><label for="meat" class="td-data pointer">26</label></td>
                                        <td><label for="meat" class="td-data pointer">27</label></td>
                                        <td><label for="meat" class="td-data pointer">28</label></td>
                                        <td><label for="meat" class="td-data pointer">29</label></td>
                                        </tr>
                                        <tr>               
                                        <td><label for="meat" class="td-data pointer">30</label></td>
                                        <td><label for="meat" class="td-data pointer">31</label></td>
                                        <td><label for="meat" class="td-data pointer">32</label></td>
                                        <td><label for="meat" class="td-data pointer">33</label></td>
                                        <td><label for="meat" class="td-data pointer">34</label></td>
                                        <td><label for="meat" class="td-data pointer">35</label></td>
                                        <td><label for="meat" class="td-data pointer">36</label></td>
                                        <td><label for="meat" class="td-data pointer">37</label></td>
                                        <td><label for="meat" class="td-data pointer">38</label></td>
                                        <td><label for="meat" class="td-data pointer">39</label></td>
                                        </tr>
                                        <tr>               
                                        <td><label for="meat" class="td-data pointer">40</label></td>
                                        <td><label for="meat" class="td-data pointer">41</label></td>
                                        <td><label for="meat" class="td-data pointer">42</label></td>
                                        <td><label for="meat" class="td-data pointer">43</label></td>
                                        <td><label for="meat" class="td-data pointer">44</label></td>
                                        <td><label for="meat" class="td-data pointer">45</label></td>
                                        <td><label for="meat" class="td-data pointer">46</label></td>
                                        <td><label for="meat" class="td-data pointer">47</label></td>
                                        <td><label for="meat" class="td-data pointer">48</label></td>
                                        <td><label for="meat" class="td-data pointer">49</label></td>
                                        </tr>
                                        <tr>               
                                        <td><label for="meat" class="td-data pointer">50</label></td>
                                        <td><label for="meat" class="td-data pointer">51</label></td>
                                        <td><label for="meat" class="td-data pointer">52</label></td>
                                        <td><label for="meat" class="td-data pointer">53</label></td>
                                        <td><label for="meat" class="td-data pointer">54</label></td>
                                        <td><label for="meat" class="td-data pointer">55</label></td>
                                        <td><label for="meat" class="td-data pointer">56</label></td>
                                        <td><label for="meat" class="td-data pointer">57</label></td>
                                        <td><label for="meat" class="td-data pointer">58</label></td>
                                        <td><label for="meat" class="td-data pointer">59</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">60</label></td>
                                        <td><label for="meat" class="td-data pointer">61</label></td>
                                        <td><label for="meat" class="td-data pointer">62</label></td>
                                        <td><label for="meat" class="td-data pointer">63</label></td>
                                        <td><label for="meat" class="td-data pointer">64</label></td>
                                        <td><label for="meat" class="td-data pointer">65</label></td>
                                        <td><label for="meat" class="td-data pointer">66</label></td>
                                        <td><label for="meat" class="td-data pointer">67</label></td>
                                        <td><label for="meat" class="td-data pointer">68</label></td>
                                        <td><label for="meat" class="td-data pointer">69</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">70</label></td>
                                        <td><label for="meat" class="td-data pointer">71</label></td>
                                        <td><label for="meat" class="td-data pointer">72</label></td>
                                        <td><label for="meat" class="td-data pointer">73</label></td>
                                        <td><label for="meat" class="td-data pointer">74</label></td>
                                        <td><label for="meat" class="td-data pointer">75</label></td>
                                        <td><label for="meat" class="td-data pointer">76</label></td>
                                        <td><label for="meat" class="td-data pointer">77</label></td>
                                        <td><label for="meat" class="td-data pointer">78</label></td>
                                        <td><label for="meat" class="td-data pointer">79</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">80</label></td>
                                        <td><label for="meat" class="td-data pointer">81</label></td>
                                        <td><label for="meat" class="td-data pointer">82</label></td>
                                        <td><label for="meat" class="td-data pointer">83</label></td>
                                        <td><label for="meat" class="td-data pointer">84</label></td>
                                        <td><label for="meat" class="td-data pointer">85</label></td>
                                        <td><label for="meat" class="td-data pointer">86</label></td>
                                        <td><label for="meat" class="td-data pointer">87</label></td>
                                        <td><label for="meat" class="td-data pointer">88</label></td>
                                        <td><label for="meat" class="td-data pointer">89</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">90</label></td>
                                        <td><label for="meat" class="td-data pointer">91</label></td>
                                        <td><label for="meat" class="td-data pointer">92</label></td>
                                        <td><label for="meat" class="td-data pointer">93</label></td>
                                        <td><label for="meat" class="td-data pointer">94</label></td>
                                        <td><label for="meat" class="td-data pointer">95</label></td>
                                        <td><label for="meat" class="td-data pointer">96</label></td>
                                        <td><label for="meat" class="td-data pointer">97</label></td>
                                        <td><label for="meat" class="td-data pointer">98</label></td>
                                        <td><label for="meat" class="td-data pointer">99</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">100</label></td>
                                        <td><label for="meat" class="td-data pointer">101</label></td>
                                        <td><label for="meat" class="td-data pointer">102</label></td>
                                        <td><label for="meat" class="td-data pointer">103</label></td>
                                        <td><label for="meat" class="td-data pointer">104</label></td>
                                        <td><label for="meat" class="td-data pointer">105</label></td>
                                        <td><label for="meat" class="td-data pointer">106</label></td>
                                        <td><label for="meat" class="td-data pointer">107</label></td>
                                        <td><label for="meat" class="td-data pointer">108</label></td>
                                        <td><label for="meat" class="td-data pointer">109</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">110</label></td>
                                        <td><label for="meat" class="td-data pointer">111</label></td>
                                        <td><label for="meat" class="td-data pointer">112</label></td>
                                        <td><label for="meat" class="td-data pointer">113</label></td>
                                        <td><label for="meat" class="td-data pointer">114</label></td>
                                        <td><label for="meat" class="td-data pointer">115</label></td>
                                        <td><label for="meat" class="td-data pointer">116</label></td>
                                        <td><label for="meat" class="td-data pointer">117</label></td>
                                        <td><label for="meat" class="td-data pointer">118</label></td>
                                        <td><label for="meat" class="td-data pointer">119</label></td>
                                        </tr>
                                    </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <table class="table table-bordered">
                                            <tr class="info">
                                                <th># No. </th>
                                                <th>Weight</th>
                                            </tr>
                                            <tr>
                                                <td><label>1</label> </td>
                                                <td><input type="text" name="weight" id="input_value"  class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>2</label> </td>
                                                <td><input type="text" name="weight"  class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>3</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>4</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>5</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>6</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>7</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>8</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>9</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>10</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>11</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>12</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>13</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>14</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>15</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>16</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>17</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>18</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>19</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>20</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>21</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>22</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>23</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>24</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>25</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>26</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Weight"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Avg</label> </td>
                                                <td><input type="text" name="avg" value="81.8" class="form-control" placeholder="Enter Avg"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Std</label> </td>
                                                <td><input type="text" name="std" value="11.7" class="form-control" placeholder="Enter Std"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Min</label> </td>
                                                <td><input type="text" name="min" value="65" class="form-control" placeholder="Enter Min"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Max</label> </td>
                                                <td><input type="text" name="max" value="101" class="form-control" placeholder="Enter Max"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END Row -->
                            <button type="submit" class="btn btn-primary"> Submit </button>
                        </form>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_4">
                            <form action="#" method="post">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number_voyages">Number Of Voyages</label>
                                            <input type="text" name="number_voyages" id="number_voyages" class="form-control" placeholder="Enter Number Of Voyages">
                                        </div>
                                    </div>
                                </div> <!--  END Row -->
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Truck Id</th>
                                            <th>Production From Wich Hatch?</th>
                                            <th>Port Departure Time</th>
                                            <th>Plant Arrival Time</th>
                                            <th>Transportaion Time</th>
                                            <th>Added Ice</th>
                                            <th>Added Water</th>
                                            <th>Type Of Recipient</th>
                                            <th>Weight/bundle</th>
                                            <th>Net Weight</th>
                                            <th>Gross Weight</th>
                                            <th>Climate Controlled?</th>            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><label for="transportation">1</label></td>
                                            <td><label for="transportation">2</label></td>
                                            <td><label for="transportation">12:30 AM</label></td>
                                            <td><label for="transportation">12:30 AM</label></td>
                                            <td><label for="transportation">12:30 AM</label></td>
                                            <td><label for="transportation">25</label></td>
                                            <td><label for="transportation">30</label></td>
                                            <td><label for="transportation">20</label></td>
                                            <td><label for="transportation">25</label></td>
                                            <td><label for="transportation">35</label></td>
                                            <td><label for="transportation">45</label></td>
                                            <td><label for="transportation">yes</label></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                    </div>
                                </div> <!--  END Row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="lot_number">Comment</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter Comment..."></textarea>
                                        </div>
                                    </div>
                                </div> <!--  END Row -->
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="truck_image">Truck Images</label>
                                        <input type="file" name="truck_image" id="truck_image" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="reipient_image">Type Of Recipient Image</label>
                                            <input type="file" name="reipient_image" id="reipient_image" class="form-control">
                                    </div>
                                    </div>
                                </div> <!--  END Row -->
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div> <!--  END Row -->
                            </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_5">
                            <form action="#" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <table class="table table-bordered">
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">80</label></td>
                                        <td><label for="meat" class="td-data pointer">81</label></td>
                                        <td><label for="meat" class="td-data pointer">82</label></td>
                                        <td><label for="meat" class="td-data pointer">83</label></td>
                                        <td><label for="meat" class="td-data pointer">84</label></td>
                                        <td><label for="meat" class="td-data pointer">85</label></td>
                                        <td><label for="meat" class="td-data pointer">86</label></td>
                                        <td><label for="meat" class="td-data pointer">87</label></td>
                                        <td><label for="meat" class="td-data pointer">88</label></td>
                                        <td><label for="meat" class="td-data pointer">89</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">90</label></td>
                                        <td><label for="meat" class="td-data pointer">91</label></td>
                                        <td><label for="meat" class="td-data pointer">92</label></td>
                                        <td><label for="meat" class="td-data pointer">93</label></td>
                                        <td><label for="meat" class="td-data pointer">94</label></td>
                                        <td><label for="meat" class="td-data pointer">95</label></td>
                                        <td><label for="meat" class="td-data pointer">96</label></td>
                                        <td><label for="meat" class="td-data pointer">97</label></td>
                                        <td><label for="meat" class="td-data pointer">98</label></td>
                                        <td><label for="meat" class="td-data pointer">99</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">100</label></td>
                                        <td><label for="meat" class="td-data pointer">101</label></td>
                                        <td><label for="meat" class="td-data pointer">102</label></td>
                                        <td><label for="meat" class="td-data pointer">103</label></td>
                                        <td><label for="meat" class="td-data pointer">104</label></td>
                                        <td><label for="meat" class="td-data pointer">105</label></td>
                                        <td><label for="meat" class="td-data pointer">106</label></td>
                                        <td><label for="meat" class="td-data pointer">107</label></td>
                                        <td><label for="meat" class="td-data pointer">108</label></td>
                                        <td><label for="meat" class="td-data pointer">109</label></td>
                                        </tr>
                                        <tr>               
                                        <td><label for="meat" class="td-data pointer">110</label></td>
                                        <td><label for="meat" class="td-data pointer">111</label></td>
                                        <td><label for="meat" class="td-data pointer">112</label></td>
                                        <td><label for="meat" class="td-data pointer">113</label></td>
                                        <td><label for="meat" class="td-data pointer">114</label></td>
                                        <td><label for="meat" class="td-data pointer">115</label></td>
                                        <td><label for="meat" class="td-data pointer">116</label></td>
                                        <td><label for="meat" class="td-data pointer">117</label></td>
                                        <td><label for="meat" class="td-data pointer">118</label></td>
                                        <td><label for="meat" class="td-data pointer">119</label></td>
                                        </tr>
                                        <tr>               
                                        <td><label for="meat" class="td-data pointer">120-124</label></td>
                                        <td><label for="meat" class="td-data pointer">125-129</label></td>
                                        <td><label for="meat" class="td-data pointer">130-134</label></td>
                                        <td><label for="meat" class="td-data pointer">135-139</label></td>
                                        <td><label for="meat" class="td-data pointer">140-144</label></td>
                                        <td><label for="meat" class="td-data pointer">145-149</label></td>
                                        <td><label for="meat" class="td-data pointer">150-154</label></td>
                                        <td><label for="meat" class="td-data pointer">155-159</label></td>
                                        <td><label for="meat" class="td-data pointer">160-164</label></td>
                                        <td><label for="meat" class="td-data pointer">164-169</label></td>
                                        </tr>
                                        <tr>               
                                        <td><label for="meat" class="td-data pointer">170-174</label></td>
                                        <td><label for="meat" class="td-data pointer">175-179</label></td>
                                        <td><label for="meat" class="td-data pointer">180-184</label></td>
                                        <td><label for="meat" class="td-data pointer">185-189</label></td>
                                        <td><label for="meat" class="td-data pointer">190-194</label></td>
                                        <td><label for="meat" class="td-data pointer">195-199</label></td>
                                        <td><label for="meat" class="td-data pointer">200-209</label></td>
                                        <td><label for="meat" class="td-data pointer">210-219</label></td>
                                        <td><label for="meat" class="td-data pointer">220-229</label></td>
                                        <td><label for="meat" class="td-data pointer">230-239</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">240-249</label></td>
                                        <td><label for="meat" class="td-data pointer">250-259</label></td>
                                        <td><label for="meat" class="td-data pointer">260-269</label></td>
                                        <td><label for="meat" class="td-data pointer">270-279</label></td>
                                        <td><label for="meat" class="td-data pointer">280-289</label></td>
                                        <td><label for="meat" class="td-data pointer">290-299</label></td>
                                        <td><label for="meat" class="td-data pointer">300-309</label></td>
                                        <td><label for="meat" class="td-data pointer">310-319</label></td>
                                        <td><label for="meat" class="td-data pointer">320-329</label></td>
                                        <td><label for="meat" class="td-data pointer">330-339</label></td>
                                        </tr>
                                        <tr>
                                        <td><label for="meat" class="td-data pointer">340-349</label></td>
                                        <td><label for="meat" class="td-data pointer">350-359</label></td>
                                        <td><label for="meat" class="td-data pointer">360-369</label></td>
                                        <td><label for="meat" class="td-data pointer">370-379</label></td>
                                        <td><label for="meat" class="td-data pointer">380-389</label></td>
                                        <td><label for="meat" class="td-data pointer">390-399</label></td>
                                        <td><label for="meat" class="td-data pointer">400-409</label></td>
                                        <td><label for="meat" class="td-data pointer">410-419</label></td>
                                        <td><label for="meat" class="td-data pointer">420-429</label></td>
                                        <td><label for="meat" class="td-data pointer">430-439</label></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                             
                            <div class="form-group">
                                <div class="col-md-4">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><input type="" name="" class="form-control" placeholder="Enter 170-174"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter 175-179"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter 160-164"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter 164-169"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter 170-174"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter 164-169"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter 164-169"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter 164-169"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter 164-169"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter 164-169"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter 164-169"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><input type="" name="" class="form-control" placeholder="Enter value"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </form> 
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_6">
                        <form action="{{ url('lot/createLabAnalysis') }}" id="histamineForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="histamine_reception">Histamine At Reception</label>
                                  <input type="text" name="histamine_reception" value="{{old('histamine_reception')}}" id="histamine_reception" class="form-control" placeholder="Enter Histamine Reception">
                                  @error('histamine_reception')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hista_after_freezing">Histamine After Freezing</label>
                                        <input type="text" name="hista_after_freezing" value="{{old('hista_after_freezing')}}" id="hista_after_freezing" class="form-control" placeholder="Enter Histamine Freezing">
                                    @error('hista_after_freezing')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="comment">Histamine Comment</label>
                                  <textarea name="comment" type="" value="{{old('comment')}}" class="form-control" placeholder="Enter Histamine Comment"></textarea>
                                  @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-11 table-responsive">
                                <table id="histamine-table" class="table table-border table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th class="info"><input type="text" readonly=""  value="Fat Content Measure" class="form-control"></th>
                                            <td><input type="text" name="fat_content_measure" value="{{old('fat_content_measure')}}" class="form-control" placeholder="Enter Fat Content Measure">
                                            @error('fat_content_measure')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="new_rows_button">
                                  <a href="javascript:void(0)" data-table="histamine" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="fat_content_comment"> Comment</label>
                                  <textarea name="fat_content_comment" type="" value="{{old('fat_content_comment')}}" class="form-control" placeholder="Enter Comment"></textarea>
                                    @error('fat_content_comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="new_rows_button">
                                    <a href="javascript:void(0)" data-table="histamine" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div> <!--  END Row -->   
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div><!-- /.tab-pane -->

                     
                    <div class="tab-pane" id="tab_7">
                        <form action="#" id="basicInfoForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="username">Freezing Technique</label>
                                    <select name="" class="form-control">
                                            <option value="a">A</option>
                                            <option value="b">B</option>
                                            <option value="c">C</option>
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                      <label for="user_image">Technology</label>
                                        <select name="" class="form-control">
                                            <option value="a">A</option>
                                            <option value="b">B</option>
                                            <option value="c">C</option>
                                        </select>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Start Time</label>
                                    <input type="" name="" class="form-control" placeholder="Enter Start Time">
                                </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="user_image">Stop Time</label>
                                    <input type="" name="" class="form-control" placeholder="Enter Stop Time">
                                </div>
                            </div>
                        </div> <!--  END Row --> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Freezing Time</label>
                                    <input type="" name="" class="form-control" placeholder="Enter Freezing Time">
                                </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="user_image">Total Load </label>
                                    <input type="" name="" class="form-control" placeholder="Enter Total Load">
                                </div>
                            </div>
                        </div> <!--  END Row --> 
                        <div class="row">
                            <div class="col-md-11">
                                <table id="reading-table" class="table table-border table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th class="info"><input type="text" readonly=""  value="Reading" class="form-control"></th>
                                            <td><input type="text" name=""  class="form-control" placeholder="Enter Reading Time"></td>
                                            <td><input type="text" name=""  class="form-control" placeholder="Enter Reading Temp"></td>
                                            <td><input type="file" name=""  class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="new_rows_button">
                                <a href="javascript:void(0)" data-table="reading" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="javascript:void(0)" data-table="reading" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                </div>
                            </diV>    
                            <div class="col-md-6">
                                <div class="form-group">
                                <a href="#" class="fa fa-plus">Add New Reading</a>
                                </div>
                            </diV>    
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Start Time</label>
                                    <input type="" name="" class="form-control" placeholder="Enter Start Time">
                                </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="user_image">Stop Time </label>
                                    <input type="" name="" class="form-control" placeholder="Enter Stop Time">
                                </div>
                            </div>
                        </div> <!--  END Row --> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Start Time</label>
                                    <input type="" name="" class="form-control" placeholder="Enter Start Time">
                                </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="user_image">Stop Time </label>
                                    <input type="" name="" class="form-control" placeholder="Enter Stop Time">
                                </div>
                            </div>
                        </div> <!--  END Row --> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <a href="#" class="fa fa-plus">Add New Tunnel</a>
                                </div>
                            </diV>    
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Freezing Time</label>
                                    <input type="" name="" class="form-control" placeholder="Enter Freezing Time">
                                </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="user_image">Quantity/Hour</label>
                                    <input type="" name="" class="form-control" placeholder="Enter Quantity/Hour">
                                </div>
                            </div>
                        </div> <!--  END Row --> 
                        <div class="row">
                            <div class="col-md-11">
                                <table id="reading-table" class="table table-border table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th class="info"><input type="text" readonly=""  value="Reading" class="form-control"></th>
                                            <td><input type="text" name=""  class="form-control" placeholder="Enter Reading Time"></td>
                                            <td><input type="text" name=""  class="form-control" placeholder="Enter Reading Temp"></td>
                                            <td><input type="file" name=""  class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="new_rows_button">
                                <a href="javascript:void(0)" data-table="reading" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="username"> Comment</label>
                                  <textarea name="comment" class="form-control" placeholder="Enter Comment"></textarea>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_8">
                        <form action="{{ url('lot/createColdChainStorage') }}" id="coldstorageForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row" id="cold_storage_reading">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reading_date">Reading Date</label>
                                    <input type="text" name="reading_date" value="{{old('reading_date')}}" class="form-control datepicker" placeholder="Enter Reading Date">
                                    @error('reading_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cold_room_number">Cold Room Number</label>
                                    <input type="text" name="cold_room_number" value="{{old('cold_room_number')}}" class="form-control" placeholder="Enter Cold Room Number">
                                    @error('cold_room_number')
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
                                    <label for="fish_temp">Fish Temp</label>
                                    <input type="text" name="fish_temp" value="{{old('fish_temp')}}" class="form-control" placeholder="Enter Fish Temp">
                                    @error('fish_temp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cold_room_temp">Cold Room Temp</label>
                                    <input type="text" name="cold_room_temp" value="{{old('cold_room_temp')}}" class="form-control" placeholder="Enter Cold Room Temp">
                                    @error('cold_room_temp')
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
                                    <label for="cold_temp_image">Fish Temp Image</label>
                                    <input type="file" name="cold_temp_image"  value="{{old('cold_temp_image')}}" class="form-control">
                                    @error('cold_temp_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cold_temp_images">Cold Room Temp Image</label>
                                    <input type="file" name="cold_temp_images" value="{{old('cold_temp_images')}}" class="form-control">
                                    @error('cold_temp_images')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!--  END Row --> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comment"> Comment</label>
                                    <textarea name="comment" class="form-control" value="{{old('comment')}}" placeholder="Enter Comment"></textarea>
                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="javascript:void(0)" data-table="cold_storage_reading" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                </div>
                            </diV> 
                        </div>    
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div><!-- /.tab-pane -->

                    
                <div class="tab-pane" id="tab_9">
                    <form action="#" id="thawingForm" method="post" enctype="multipart/form-data">
                    @csrf 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_image">Invoiced Weight</label>
                                <input type="" name="" class="form-control" placeholder="Enter Invoiced Weight" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                 <label for="user_image">Frozen Weight</label>
                                 <input type="" name="" class="form-control" placeholder="Enter Frozen Weight">
                            </div>
                        </div>
                    </div> <!--  END Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_image">Picture Of Good Fish</label>
                                <input type="" name="good_fish_image" class="form-control" placeholder="Enter Invoiced Weight" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                 <label for="user_image">Picture Of Discrepancies</label>
                                 <input type="discrepanices_image" name="" class="form-control" placeholder="Enter Frozen Weight">
                            </div>
                        </div>
                    </div> <!--  END Row -->
                    <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table  class="table table-border table-striped">
                                    <thead>
                                    <tr class="info">
                                        <th>Total Species</th>
                                        <th>Total Species</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Mechanical Damage</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="hiddem"  id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                         </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Broken Belly</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Slighlty Broken Belly</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Soft</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                        <td>
                                       </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Other Species</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                       </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Gill Cut</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Bad Cut</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                       </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Light Damage</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Tail</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Tail <1 cm (pointers)</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Guts</label>
                                        </td>
                                        <td> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="myNumber" class="form-control input-number" value="0.1" />
                                                        <div class="input-group-btn">
                                                            <button id="down" class="btn btn-default" onclick="down('0.100')"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </div>
                                                        <input type="text" id="myNumber" class="form-control input-number" value="1" />
                                                        <div class="input-group-btn">
                                                            <button id="up" class="btn btn-default" onclick="up('100')"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" name="mechnical damage" class="form-control" >
                                                </div> 
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <input type="checkbox" name="visel2" class="minimal" >
                                        <label for="company">Guts(weight)</label>
                                        </td>
                                        <td><input type="" name="" class="form-control" placeholder="Enter Guts Weights" ></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_image">Total Discrepanices weight</label>
                                            <input type="" name="good_fish_image" class="form-control" placeholder="Enter Invoiced Weight" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_image">Net Thawed weight</label>
                                            <input type="discrepanices_image" name="" class="form-control" placeholder="Enter Frozen Weight">
                                        </div>
                                    </div>
                                </div> <!--  END Row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_image">Net Thawed Image</label>
                                            <input type="file" name="net_thawed_image" class="form-control" placeholder="Enter Invoiced Weight" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_image"></label>
                                        </div>
                                    </div>
                                </div> <!--  END Row -->
                            </div>
                        </div> <!--  END Row -->
                        <button type="submit" class="btn btn-primary">Submit</button>
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
    $(function(){

        $('#lot_number').val(new Date().getUTCMilliseconds());

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


        //Date picker
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            endDate: new Date(), 
            autoclose: true
            });
          $('.datepicker').on('keyup keypress keydown', function(e){
              e.preventDefault();
          });
        // $('input[name=type]').on('ifChecked', function(event){
        //     alert($(this).val());
        // });
    });
     $('#basicInfoForm').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        $('#image-input-error').text('');

        $.ajax({
            type:'POST',
            url: '{{url("accountmanagement/updateBasicInfo/user_id")}}',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
            // this.reset();
            alert('saved Successfully ..');
            }
            },
            error: function(response){
                console.log("Error List")
                console.log(response.responseJSON.error)
                printErrorMsg(response.responseJSON.error);
            }
        });

    }); 

    function printErrorMsg (msg) {
      
        // messageDiv
         var errormsg='<ul>';
        $.each( msg, function( key, value ) {
            errormsg+='<li>'+value[0]+'</li>';
            // console.log(value[0])
            // console.log(key)
        });
        errormsg+='</ul>';
        $(".messageDiv").html('<div class="alert alert-danger">'+errormsg+'</div>'); 
        setTimeout(function(){
            $('.alert').remove(); 
        }, 5000);

    }

    //Timepicker
    $(".timepicker").timepicker({
            showInputs: true
        });

</script>

@endsection
