

@extends('layouts.app')
@section('title') <title>Production & Quality </title> 
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
            <h2 class="page-header">New Fish Arrival</h2>
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
                @if(isset($row_id))
                {{$row_id}} {{$tab}}
                @endif 
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="@if(Session::has('tab') && Session::get('tab') == 'tab_1') active  @endif"><a href="#tab_1" data-toggle="tab">Fishing</a></li>
                    <li class="@if(Session::has('tab') && Session::get('tab') == 'tab_2') active  @endif"><a href="#tab_2" data-toggle="tab">Unloading</a></li>
                    <li class="@if(Session::has('tab') && Session::get('tab') == 'tab_3') active  @endif"><a href="#tab_3" data-toggle="tab">Transport</a></li>
                    <li class="@if(Session::has('tab') && Session::get('tab') == 'tab_4') active  @endif"><a href="#tab_4" data-toggle="tab">Parasitism</a></li>
                    <li><a href="#tab_5" data-toggle="tab">Organoleptic/feed/Resistance</a></li>
                    <li><a href="#tab_11" data-toggle="tab">Raw Material Weight</a></li>
                    <li><a href="#tab_12" data-toggle="tab">Raw Material Length</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane @if(Session::has('tab') && Session::get('tab') == 'tab_1') active  @endif" id="tab_1">
                        <form action="{{ url('lot/createFishingInfo') }}" id="fishinInfoForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="landing_date">Landing Date</label>

                                <input type="text" name="landing_date" id="landing_date" value="{{old('landing_date')}}" class="form-control datepicker @error('landing_date') is-invalid @enderror" placeholder="Enter Landing Date">

                                @error('landing_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                            </div>  
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="unloading_place">Unloading Place</label>
                                    <select  class="form-control @error('unloading_place') is-invalid @enderror" value="{{old('unloading_place')}}" name="unloading_place">
                                        <option value="">-- Select Unloading Place --</option>  
                                        @if(isset($getCitylList) && count($getCitylList))
                                        @foreach($getCitylList as $city)
                                        <option value="{{$city->id}}" @if(old('unloading_place')) selected @endif >{{($city->name=="")?ucfirst($city->name):ucfirst($city->name)}}</option> 
                                        @endforeach
                                        @endif 
                                    </select> 
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="vessel">Vessel </label>
                                    <select  class="form-control @error('vessel_id') is-invalid @enderror" value="{{old('vessel_id')}}" name="vessel_id">
                                        <option value="">-- Select Vessel --</option>  
                                        @if(isset($getVesselList) && count($getVesselList))
                                        @foreach($getVesselList as $vessel)
                                        <option value="{{$vessel->id}}" @if(old('vessel_id')) selected @endif >{{($vessel->vessel_name=="")?ucfirst($vessel->vessel_name):ucfirst($vessel->vessel_name)}}</option> 
                                        @endforeach
                                        @endif 
                                    </select> 
                            </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="sequence">Sequence</label>
                                        <select  class="form-control @error('sequence') is-invalid @enderror" value="{{old('sequence')}}" name="sequence">
                                            <option value="">-- Select Sequence --</option> 
                                            <option value="1">1</option> 
                                            <option value="2">2</option> 
                                            <option value="3">3</option> 
                                            <option value="4">4</option> 
                                            <option value="5">5</option> 
                                        </select>    
                                    @error('sequence')
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
                                <label for="fishing_date">Fishing Date </label>
                                <input type="text" name="fishing_date" id="fishing_date" value="{{old('fishing_date')}}" class="form-control datepicker @error('fishing_date') is-invalid @enderror" placeholder="Enter Fishing Date">
                                @error('fishing_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                            </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="fishing_zone">Fishing Zone</label>
                                    <select  class="form-control @error('fishing_zone') is-invalid @enderror" value="{{old('fishing_zone')}}" name="fishing_zone">
                                        <option value="">-- Select Zone --</option>  
                                        @if(isset($getZonelList) && count($getZonelList))
                                        @foreach($getZonelList as $zones)
                                        <option value="{{$zones->id}}" @if(old('fishing_zone')) selected @endif >{{($zones->title=="")?ucfirst($zones->title):ucfirst($zones->title)}}</option> 
                                        @endforeach
                                        @endif 
                                    </select>  
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="ice_onboard">Ice Onboard </label>
                                <input type="text" name="ice_onboard" id="ice_onboard" value="{{old('ice_onboard')}}"  class="form-control @error('ice_onboard') is-invalid @enderror" placeholder="Enter Ice Onboard">
                                @error('ice_onboard')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                            </div>
                            </div>
                            
                        </div> <!--  END Row -->

                        <input type="hidden" name="sections[0][name]" value="catchs">
                        <input type="hidden" name="sections[0][name_key]" value="catchs">
                        <div class="row">
                            <div class="col-md-11">
                            <table id="catchs-table" class="table table-border table-striped">
                                    <thead>
                                    <tr class="info">
                                    <th> <input name="sections[0][custom_fields][name][]" value="Catch No." class="form-control">
                                    <input type="hidden" name="sections[0][custom_fields][type][]" value="1" class="form-control">
                                    <input type="hidden" name="sections[0][custom_fields][item_list][]" value="a,b,c" class="form-control">
                                    </th>
                                    <th><input type="text" name="sections[0][custom_fields][name][]" value="Hour" class="form-control">
                                    <input type="hidden" name="sections[0][custom_fields][type][]" value="1" class="form-control">
                                    <input type="hidden" name="sections[0][custom_fields][item_list][]" value="a,b,c" class="form-control">
                                    </th>
                                    <th><input type="text" name="sections[0][custom_fields][name][]" value="Quantity" class="form-control">
                                    <input type="hidden" name="sections[0][custom_fields][type][]" value="1" class="form-control">
                                    <input type="hidden" name="sections[0][custom_fields][item_list][]" value="a,b,c" class="form-control">
                                    </th>
                                    <th>
                                    <input type="text" name="sections[0][custom_fields][name][]" value="Fish Temp" class="form-control">
                                    <input type="hidden" name="sections[0][custom_fields][type][]" value="1" class="form-control">
                                    <input type="hidden" name="sections[0][custom_fields][item_list][]" value="a,b,c" class="form-control">
                                    </th>
                                    <th>
                                    <input type="text" name="sections[0][custom_fields][name][]" value="Hatch" class="form-control">
                                    <input type="hidden" name="sections[0][custom_fields][type][]" value="1" class="form-control">
                                    <input type="hidden" name="sections[0][custom_fields][item_list][]" value="a,b,c" class="form-control">
                                    </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <td> <input type="text" name="sections[0][custom_rows][customdata][0][value][]" class="form-control @error('catch') is-invalid @enderror" placeholder="catch"></label></td>
                                    <td> <input type="text" name="sections[0][custom_rows][customdata][1][value][]" class="form-control @error('hour') is-invalid @enderror" placeholder="hour"></label></td>
                                    <td> <input type="text" name="sections[0][custom_rows][customdata][2][value][]" class="form-control @error('qunty') is-invalid @enderror" placeholder="qunty"></label></td>
                                    <td> <input type="text" name="sections[0][custom_rows][customdata][3][value][]" class="form-control @error('fish_temp') is-invalid @enderror" placeholder="fish_temp"></label></td>
                                    <td> <input type="text" name="sections[0][custom_rows][customdata][4][value][]" class="form-control @error('hatch') is-invalid @enderror" placeholder="hatch"></label></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="new_rows_button">
                                  <a href="javascript:void(0)" data-table="catchs" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                            </div>
                        </div> <!--  END Row -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="javascript:void(0)" data-table="catchs" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="number_of_catches">Number of Catches</label>
                                <input type="text" name="number_of_catches" id="number_of_catches" value="{{old('number_of_catches')}}" class="form-control @error('number_of_catches') is-invalid @enderror" placeholder="Enter User Name">
                                @error('number_of_catches')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                            </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="total_fish_quantity">Total Quantity</label>
                                    <input type="text" name="total_fish_quantity" id="total_fish_quantity" value="{{old('total_fish_quantity')}}" class="form-control @error('total_fish_quantity') is-invalid @enderror" placeholder="Enter Total Quantity">
                                    @error('total_fish_quantity')
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
                                <label for="total_fishing_time">Total Fishing Time </label>
                                <input type="text" name="total_fishing_time" id="total_fishing_time" value="{{old('total_fishing_time')}}" class="form-control  @error('total_fishing_time') is-invalid @enderror" placeholder="Enter Total Fishig Time">
                                @error('total_fishing_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                            </div>
                            </div>
                        </div> <!--  END Row -->
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="submit" class="btn btn-primary">Save & Create Lot</button>
                            <button type="submit" class="btn btn-danger">Abandon</button>
                     </form>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_2">
                        <form action="{{ url('lot/createUnloadingInfo') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="arrival_id" value="@if(Session::has('arrival_id')){{Session::get('arrival_id')}}@endif" />

                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="unloading_places">Unloading Place </label>
                                <input type="text" name="unloading_places" id="unloading_places" value="{{old('unloading_places')}}" class="form-control @error('unloading_places') is-invalid @enderror" placeholder="Enter Unloading Place">
                                @error('unloading_places')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                            </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label for="unloading_date">Unloading Date</label>
                                    <input type="text" name="unloading_date" id="unloading_date" value="{{old('unloading_date')}}" class="form-control datepicker @error('unloading_date') is-invalid @enderror" placeholder="Enter Unloading Date">
                                    @error('unloading_date')
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
                                <label for="added_ice">Added Ice </label>
                                <input type="text" name="added_ice" id="added_ice" value="{{old('added_ice')}}" class="form-control @error('added_ice') is-invalid @enderror" placeholder="Enter Added Ice">
                                @error('added_ice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                            </div>
                            </div>
                        </div> <!--  END Row -->
                        <input type="hidden" name="sections[0][name]" value="hatches">
                        <input type="hidden" name="sections[0][name_key]" value="hatches">
                        <div class="row">
                            <div class="col-md-11">
                                <table id="hatches-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>
                                        <input type="text" name="sections[0][custom_fields][name][]" value="Number Of Hatches" class="form-control">
                                        <input type="hidden" name="sections[0][custom_fields][type][]" value="1" class="form-control">
                                        <input type="hidden" name="sections[0][custom_fields][item_list][]" value="a,b,c" class="form-control">
                                        </th>
                                        <th>
                                        <input type="text" name="sections[0][custom_fields][name][]" value="Hatch #" class="form-control">
                                        <input type="hidden" name="sections[0][custom_fields][type][]" value="1" class="form-control">
                                        <input type="hidden" name="sections[0][custom_fields][item_list][]" value="a,b,c" class="form-control">
                                        </th>
                                        <th>
                                        <input type="text" name="sections[0][custom_fields][name][]" value="Time(Start)" class="form-control">
                                        <input type="hidden" name="sections[0][custom_fields][type][]" value="1" class="form-control">
                                        <input type="hidden" name="sections[0][custom_fields][item_list][]" value="a,b,c" class="form-control">
                                        </th>
                                        <th>
                                        <input type="text" name="sections[0][custom_fields][name][]" value="Time(End)" class="form-control">
                                        <input type="hidden" name="sections[0][custom_fields][type][]" value="1" class="form-control">
                                        <input type="hidden" name="sections[0][custom_fields][item_list][]" value="a,b,c" class="form-control">
                                        </th>    
                                        <th>
                                        <input type="text" name="sections[0][custom_fields][name][]" value="Fish Temp" class="form-control">
                                        <input type="hidden" name="sections[0][custom_fields][type][]" value="1" class="form-control">
                                        <input type="hidden" name="sections[0][custom_fields][item_list][]" value="a,b,c" class="form-control">
                                        </th> 
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td> <input type="text" name="sections[0][custom_rows][customdata][1][value][]" class="form-control @error('fishing_hatch_id') is-invalid @enderror" value="{{old('sections.0.custom_rows.customdata.1.value.0')}}" placeholder="#"></label></td>
                                            <td> <input type="text" name="sections[0][custom_rows][customdata][2][value][]" class="form-control @error('hatch_id') is-invalid @enderror" value="{{old('sections.0.custom_rows.customdata.2.value.0')}}" placeholder="Hatch "></label></td>
                                            <td> <input type="text" name="sections[0][custom_rows][customdata][3][value][]" class="form-control @error('start_time') is-invalid @enderror" value="{{old('sections.0.custom_rows.customdata.3.value.0')}}" placeholder="Time(Start)"></label></td>
                                            <td> <input type="text" name="sections[0][custom_rows][customdata][4][value][]" class="form-control @error('end_time') is-invalid @enderror" value="{{old('sections.0.custom_rows.customdata.4.value.0')}}" placeholder="Time(End)"></label></td>
                                            <td> <input type="text" name="sections[0][custom_rows][customdata][5][value][]" class="form-control @error('fish_teprature') is-invalid @enderror" value="{{old('sections.0.custom_rows.customdata.5.value.0')}}" placeholder="Fish Temp"></label></td>
                                        </tr>
                                    </tbody>
                                </table>
                                    <div class="new_rows_button">
                                            <a href="javascript:void(0)" data-table="hatches" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                        </div>
                            </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="hatches" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                        </div> <!--  END Row -->
                        
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea name="unloading_comment" class="form-control" rows="3" value="{{old('unloading_comment')}}" placeholder="Enter Comment ..."></textarea>
                                @error('unloading_comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  
                            </div>
                            </div>
                        </div> <!--  END Row -->
                        <button type="submit" class="btn btn-primary"> Save </button>
                        <button type="submit" class="btn btn-primary"> Save & Create Lot</button>
                        <button type="submit" class="btn btn-danger">Abandon</button>
                    </form>
                    </div><!-- /.tab-pane -->

                   
                    <div class="tab-pane" id="tab_3">
                        <form action="{{ url('lot/createTransportInfo') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="arrival_id" value="@if(Session::has('arrival_id')){{Session::get('arrival_id')}}@endif" />
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                    <table id="voyages-table" class="table table-border table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th class="info"><input type="text" readonly=""  value="Number Of Voyage" class="form-control"></th>
                                                <td><input type="text" name="number_of_voyages" value="{{old('number_of_voyages')}}" class="form-control" placeholder="Enter Number Of Voyage"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!--  END Row -->
                            <!--div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="number_of_voyage" class=""> Number Of Voyage </label>
                                        <input type="text" name="number_of_voyage" id="number_of_voyage" class="form-control number_of_voyage " placeholder="Enter number of voyage">
                                    </div>
                                </div>
                            </div--> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="truck_id">Truck Id</label>
                                    <input type="text" name="truck_id" id="truck_id" value="{{old('truck_id')}}" class="form-control @error('truck_id') is-invalid @enderror" placeholder="Enter Truck Id">
                                    @error('truck_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                                </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="production_which_from">Production From which what? </label>
                                        <input type="text" name="production_which_from" id="production_which_from" value="{{old('production_which_from')}}" class="form-control @error('production_which_from') is-invalid @enderror" placeholder="Enter Production Which From">
                                        @error('production_which_from')
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
                                    <label for="port_departure_time">Port Departure Time</label>
                                    <input type="text" name="port_departure_time" id="port_departure_time" value="{{old('port_departure_time')}}" class="form-control @error('port_departure_time') is-invalid @enderror" placeholder="Enter Port Departure Time">
                                    @error('port_departure_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                                </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="factory_arrival_time">Factory Arrival Time </label>
                                        <input type="text" name="factory_arrival_time" id="factory_arrival_time" value="{{old('factory_arrival_time')}}" class="form-control @error('factory_arrival_time') is-invalid @enderror" placeholder="Enter Factory Arrival Time">
                                        @error('factory_arrival_time')
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
                                    <label for="transportation_time">Transportation Time</label>
                                    <input type="text" name="transportation_time" id="transportation_time" value="{{old('transportation_time')}}" class="form-control @error('transportation_time') is-invalid @enderror" placeholder="Enter Transportation Time">
                                    @error('unloading_place')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                                </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="added_ice">Added Ice</label>
                                        <input type="text" name="added_ice" id="added_ices" value="{{old('added_ice')}}" class="form-control @error('added_ice') is-invalid @enderror" placeholder="Added Ice">
                                        @error('added_ice')
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
                                    <label for="add_water">Added Water</label>
                                    <input type="text" name="add_water" id="add_water" value="{{old('add_water')}}" class="form-control @error('add_water') is-invalid @enderror" placeholder="Enter Add Water">
                                    @error('add_water')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                                </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="type_of_recipient">Type Of Recipient</label>
                                        <input type="text" name="type_of_recipient" value="{{old('type_of_recipient')}}" id="type_of_recipient" class="form-control @error('type_of_recipient') is-invalid @enderror" placeholder="enter Type Of Recipient">
                                        @error('type_of_recipient')
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
                                    <label for="weight_bundle">Weight/Bundle</label>
                                    <input type="text" name="weight_bundle" id="weight_bundle" value="{{old('weight_bundle')}}" class="form-control @error('weight_bundle') is-invalid @enderror" placeholder="Enter Weight Bundle">
                                    @error('weight_bundle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                                </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="number_of_bundles">Number Of Bundles</label>
                                        <input type="text" name="number_of_bundles" id="number_of_bundles" value="{{old('number_of_bundles')}}" class="form-control @error('number_of_bundles') is-invalid @enderror"placeholder="Entter Number of Bundles" >
                                        @error('number_of_bundles')
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
                                    <label for="net_weight">Net Weight</label>
                                    <input type="text" name="net_weight" id="net_weight" value="{{old('net_weight')}}" class="form-control @error('net_weight') is-invalid @enderror" placeholder="Enter Net Weight">
                                    @error('net_weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                                </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="gross_weight">Gross Weight</label>
                                        <input type="text" name="gross_weight" id="gross_weight" value="{{old('gross_weight')}}" class="form-control @error('gross_weight') is-invalid @enderror" placeholder="Enter Gross Weight">
                                        @error('gross_weight')
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
                                        <label for="unloading_place">Climate Contol?</label>
                                    </div>
                                 </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="checkbox" name="climate_controle" value="0" class="minimal" style="position: absolute; opacity: 0;">  
                                                <label for="lot_number">Yes</label>                              
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="checkbox" name="climate_controle" value="1" class="minimal" style="position: absolute; opacity: 0;"> 
                                                <label for="lot_number">No</label>                             
                                            </div>
                                        </div>
                                    </div> <!--  END Row -->
                                    @error('unloading_place')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                               
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="truck_image">Truck Image</label>
                                    <input type="file" name="truck_image" id="truck_image" class="form-control @error('truck_image') is-invalid @enderror" placeholder="Enter vessel">
                                    @error('truck_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                                </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="recipient_image">Recipent Image</label>
                                        <input type="file" name="recipient_image" id="recipient_image" class="form-control @error('recipient_image') is-invalid @enderror" >
                                        @error('recipient_image')
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
                                        <label>Comment</label>
                                        <textarea class="form-control" name="comment" rows="3" value="{{old('comment')}}" placeholder="Enter Comment ..."></textarea>
                                    </div>
                                </div>
                            </div> <!--  END Row -->
                            <button type="submit" class="btn btn-primary"> Save </button>
                            <button type="submit" class="btn btn-primary"> Save & Create Lot </button>
                            <button type="submit" class="btn btn-danger"> Abandon </button>
						 </form>
                    </div><!--- TAB panel --->

                    <div class="tab-pane" id="tab_4">
                       <form action="{{ url('lot/updateParasitismInfo') }}" method="post" enctype="multipart/form-data">
                       @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary"> Anisakis </button>
                                <button type="submit" class="btn btn-primary"> Guts </button>
                                <button type="submit" class="btn btn-primary">Meat</button>
                                <button type="submit" class="btn btn-primary">Anus</button>
                                <button type="submit" class="btn btn-primary">Other</button>
                            </div>
                        </div> <!--  END Row -->

                        <!--div class="row">
                           
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th><button class="btn btn-primary">Anisakis</button></th>
                                        <th><button class="btn btn-primary">Guts</button></th>
                                        <th><button class="btn btn-primary">Meat</button></th>
                                        <th><button class="btn btn-primary">Anus</button></th>
                                        <th><button class="btn btn-primary">Other</button></th>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6"></div>
                        </div--> <!--  END Row -->

                        <div class="row">
                            <div class="col-md-12 add_anisakis">
                            @php @endphp
                                <!--button class="btn btn-primary p"></button-->
                            @php @endphp    
                            </div>
                        </div> <!--  END Row -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                   <table class="table table-bordered">
                                        <tr>
                                            <th><a href="javascript:void(0)" onclick="addNewParasite(this.value)" class="fa fa-plus" id="parasite_ids" >Add New Parasite</a></th>
                                        </tr>
                                    </table>    
                                    <table class="table table-bordered">
                                            @php $p=0; $k = 10; @endphp
                                            @for($i=1;$i < 5; $i++)
                                                <tr id="{{$p+1}}">
                                            @for($j=$p+1;$j <= $k*$i; $j++)
                                                <td><label for="meat" class="td-data pointer">{{$j}}</label></td>
                                            @php $p = $j; @endphp
                                            @endfor
                                                </tr>
                                            @endfor
                                    </table>
                                </div>
                            </div>
                            
                    <div class="form-group">
                        <div class="col-md-3">
                            <table class="table table-bordered">
                                <tr class="info">
                                    <th># No. </th>
                                    <th>Anisakis</th>
                                </tr>
                                @php @endphp
                                    @for($i1=1; $i1 < 16; $i1++)
                                        <tr id="{{$i1+1}}">
                                        <td class="anisakis_input"><label>{{ $i1 }}</label> </td>
                                        <td><input type="" name="" class="form-control anisakis_input" placeholder="Enter Anisakis"></td>
                                    @endfor
                                        </tr> 
    
                                    @php @endphp
                            </table>
                        </div>
                    </div>
                    
                </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table class="table table-bordered"> 
                                        <tr>
                                            <th class="info">Prevalance</th>
                                            <td><label for="meat">79%</label></td>
                                            <td><label for="meat">28%</label></td>
                                        </tr>
                                    </table> 
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table class="table table-bordered"> 
                                        <tr>
                                            <th class="info">Intensity</th>
                                            <td><label for="meat">average</label></td>
                                            <td><label for="meat">3.7</label></td>
                                            <td><label for="meat">0.9</label></td>
                                        </tr>
                                        <tr>
                                            <th class="info">Intensity</th>
                                            <td><label for="meat">std</label></td>
                                            <td><label for="meat">5.4</label></td>
                                            <td><label for="meat">1.3</label></td>
                                        </tr>
                                        <tr>
                                            <th class="info">Intensity</th>
                                            <td><label for="meat">min</label></td>
                                            <td><label for="meat">0</label></td>
                                            <td><label for="meat">0</label></td>
                                        </tr>
                                        <tr>
                                            <th class="info">Intensity</th>
                                            <td><label for="meat">max</label></td>
                                            <td><label for="meat">12</label></td>
                                            <td><label for="meat">4</label></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                       <button class="btn btn-primary">Save</button>
                       <button class="btn btn-primary">Save & Create Lot</button>
                       <button class="btn btn-danger">Abandon</button>
                     </form>
                    </div> <!--- Tab panel --->

                    <div class="tab-pane" id="tab_5">
                        <form action="{{ url('lot/createOrganolepticResistance') }}" method="post" enctype="multipart/form-data"> 
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table class="table table-bordered">
                                        <tr>
                                        <th>Meat Texture</th>
                                        <td><input type="text" name="meat_texture" placeholder="1" class="form-control"></td>
                                        <td class="bg-info"><input type="text" name="meat_texture" placeholder="2" class="form-control"></td>
                                        <td><input type="text" name="meat_texture" placeholder="3" class="form-control"></td>
                                        <td><input type="text" name="meat_texture" placeholder="4" class="form-control" ></td>
                                        <td><input type="text" name="meat_texture" placeholder="5" class="form-control"></td>
                                        <td><input type="text" name="meat_texture" readonly="" value="/5"  class="form-control"></td>
                                        </tr>
                                        <tr>
                                        <th>Freshness</th>
                                        <td><input type="text" name="freshness" placeholder="1" class="form-control"></td>
                                        <td><input type="text" name="freshness" placeholder="2" class="form-control"></td>
                                        <td><input type="text" name="freshness" placeholder="3" class="form-control"></td>
                                        <td class="bg-info"><input type="text" name="freshness" placeholder="4" class="form-control"></td>
                                        <td><input type="text" name="freshness" placeholder="5" class="form-control"></td>
                                        <td><input type="text" name="freshness" readonly="" value="/5" class="form-control"></td>
                                        </tr>
                                        <tr>
                                        <th>Scales</th>
                                        <td><input type="text" name="scales" placeholder="1" class="form-control"></td>
                                        <td><input type="text" name="scales" placeholder="2" class="form-control"></td>
                                        <td class="bg-info"><input type="text" name="scales" placeholder="3" class="form-control"></td>
                                        <td><input type="text" name="scales" placeholder="4" class="form-control"></td>
                                        <td><input type="text" name="scales" placeholder="5" class="form-control"></td>
                                        <td><input type="text" name="scales" readonly="" value="/5" class="form-control"></td>
                                        </tr>
                                        <tr>               
                                        <th>Belly Thickness</th>
                                        <td><input type="text" name="belly_thickness" placeholder="1" class="form-control"></td>
                                        <td class="bg-info"><input type="text" name="belly_thickness" placeholder="2" class="form-control"></td>
                                        <td><input type="text" name="belly_thickness" placeholder="3" class="form-control"></td>
                                        <td><input type="text" name="belly_thickness" placeholder="4" class="form-control"></td>
                                        <td><input type="text" name="belly_thickness" placeholder="5" class="form-control"></td>
                                        <td><input type="text" name="belly_thickness" readonly="" value="/5" class="form-control"></td>
                                        </tr>
                                        <tr>               
                                        <th>Belly Strength</th>
                                        <td><input type="text" name="belly_strength" placeholder="1" class="form-control"></td>
                                        <td><input type="text" name="belly_strength" placeholder="2" class="form-control"></td>
                                        <td><input type="text" name="belly_strength" placeholder="3" class="form-control"></td>
                                        <td><input type="text" name="belly_strength" placeholder="4" class="form-control"></td>
                                        <td class="bg-info"><input type="text" name="belly_strength" placeholder="5" class="form-control"></td>
                                        <td><input type="text" name="belly_strength" readonly="" value="/5"  class="form-control"></td>
                                        </tr>
                                        <tr>               
                                        <th>Fat Content </th>
                                        <td><input type="text" name="fat_content" placeholder="1" class="form-control"></td>
                                        <td><input type="text" name="fat_content" placeholder="2" class="form-control"></td>
                                        <td><input type="text" name="fat_content" placeholder="3" class="form-control"></td>
                                        <td><input type="text" name="fat_content" placeholder="4" class="form-control"></td>
                                        <td class="bg-info"><input type="text" name="fat_content" placeholder="5" class="form-control"></td>
                                        <td><input type="text" name="fat_content" readonly="" value="/5"  class="form-control"></td>
                                        </tr>
                                        <tr>               
                                        <th>Fat Content % </th>
                                        <td><input type="text" name="fat_content_percentage" placeholder="100%" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                        <th>Fat Content Image</th>
                                        <td><input type="file" name="fat_content_image" class="form-control" /></td>
                                        </tr>
                                    </table>
                                    
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Feed</th>
                                            <th>No Need</th>
                                            <th>Vegetal</th>
                                            <th>Animal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><label>S</label></td> 
                                            <td><input type="text" name="small_feed" class="form-control" placeholder="Enter small_feed"/></td> 
                                            <td><label>L</label></td> 
                                            <td><input type="text" name="large_feed" class="form-control" placeholder="Enter large_feed"/></td> 
                                        </tr>
                                        <tr>
                                            <td><label>M</label></td> 
                                            <td><input type="text" name="medium_feed" class="form-control" placeholder="Enter medium_feed"/></td> 
                                            <td><label>Xl</label></td> 
                                            <td><input type="text" name="extra_large_feed" class="form-control" placeholder="Enter extra_large_feed"/></td> 
                                        </tr>
                                        <tr>
                                            <td><label>Feed Image</label></td> 
                                            <td><input type="file" name="feed_charatestic_image" class="form-control" ></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="feed_comment">Fish Reception</label>
                                    <input type="text" name="feed_comment" value="{{old('feed_comment')}}" id="feed_comment" class="form-control" placeholder="Enter Fish Reception">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="fish_temp_image">Fish Reception Image</label>
                                        <input type="file" name="fish_temp_image" class="form-control" />
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                   <table class="table table-bordered">
                                        <tr>
                                        <th>S</th>
                                        <td><input type="text" name="resistance_test_small" class="form-control" placeholder="1"></td>
                                        <td><input type="text" name="resistance_test_small" class="form-control" placeholder="2"></td>
                                        <td><input type="text" name="resistance_test_small" class="form-control" placeholder="3"></td>
                                        <td><input type="text" name="resistance_test_small" class="form-control" placeholder="4"></td>
                                        <td><input type="text" name="resistance_test_small" class="form-control" placeholder="5"></td>
                                        </tr>
                                        <tr>
                                        <th>M</th>
                                        <td><input type="text" name="resistance_test_medium" class="form-control" placeholder="1"></td>
                                        <td><input type="text" name="resistance_test_medium" class="form-control" placeholder="2"></td>
                                        <td><input type="text" name="resistance_test_medium" class="form-control" placeholder=""></td>
                                        <td><input type="text" name="resistance_test_medium" class="form-control" placeholder=""></td>
                                        <td><input type="text" name="resistance_test_medium" class="form-control" placeholder=""></td>
                                        </tr>
                                        <tr>               
                                        <th>L</th>
                                        <td><input type="text" name="resistance_test_large" class="form-control" placeholder=""></td>
                                        <td><input type="text" name="resistance_test_large" class="form-control" placeholder=""></td>
                                        <td><input type="text" name="resistance_test_large" class="form-control" placeholder=""></td>
                                        <td><input type="text" name="resistance_test_large" class="form-control" placeholder=""></td>
                                        <td><input type="text" name="resistance_test_large" class="form-control" placeholder=""></td>
                                        </tr>
                                        <tr>   
                                   </table>
                                </div>
                            </div>    
                         </div> <!--  END Row -->
                         <button type="submit" class="btn btn-primary"> Save </button>
                         <button type="submit" class="btn btn-primary"> Save & Create Lot</button>
                         <button type="submit" class="btn btn-danger"> Abandon </button>
                         <a href="{{ url('lot/updateMaterial') }}" class="fa fa-plus">Update Organoleptic</a>
                       </form>
                    </div><!-- /.tab-content -->
                    <div class="tab-pane" id="tab_11">
                        <form action="{{ url('lot/createWeight') }}" method="post" enctype="multipart/form-data">
                        @csrf
                         <button type="submit" class="btn btn-primary"> Discrepancy </button>
                         <button type="submit" class="btn btn-primary"> Other Species</button>
                         <button type="submit" class="btn btn-primary"> Foreign Matter</button>
                         <button type="submit" class="btn btn-primary"> Back </button>
                         <button type="submit" class="btn btn-primary"> Done </button>
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
                                                <td><input type="text" name="weight" id="input_value"  class="form-control" placeholder="Enter Value"></td>
                                            </tr>
                                            <tr>
                                                <td><label>2</label> </td>
                                                <td><input type="text" name="weight" id="input_value2" class="form-control" placeholder="Enter Value"></td>
                                            </tr>
                                            <tr>
                                                <td><label>3</label> </td>
                                                <td><input type="text" name="weight" id="input_value3" class="form-control" placeholder="Enter Value"></td>
                                            </tr>
                                            <tr>
                                                <td><label>4</label> </td>
                                                <td><input type="text" name="weight" id="input_value4" class="form-control" placeholder="Enter Value"></td>
                                            </tr>
                                            <tr>
                                                <td><label>5</label> </td>
                                                <td><input type="text" name="weight" id="input_value5" class="form-control" placeholder="Enter Value"></td>
                                            </tr>
                                            <tr>
                                                <td><label>6</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>7</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>8</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>9</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>10</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>11</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>12</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>13</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>14</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>15</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>16</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>17</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>18</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>19</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>20</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>21</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>22</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>23</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>24</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>25</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>26</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>27</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>28</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>29</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                            <tr>
                                                <td><label>30</label> </td>
                                                <td><input type="text" name="weight" class="form-control" placeholder="Enter Anisakis"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div> <!--  END Row -->
                        <button type="submit" class="btn btn-primary"> Save </button>
                        <button type="submit" class="btn btn-primary"> Save & Create Lot</button>
                        <button type="submit" class="btn btn-danger"> Abandon </button>
                       </form> 
                    </div> <!-- tab panel -->

                   
                    <div class="tab-pane" id="tab_12">
                       <form action="#" method="post" enctype="multipart/form-data" >
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
                        <button type="submit" class="btn btn-primary"> Save </button>
                        <button type="submit" class="btn btn-primary"> Save & Create Lot</button>
                        <button type="submit" class="btn btn-danger"> Abandon </button>
                    </form> 
                    </div> <!-- tab panel -->

                </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div>
    </section>
</div> 

<!-- Modal -->
<div class="modal fade" id="AddColumn_Modal" role="dialog">
        <div class="modal-dialog modal-xs">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"> </h4>
            </div>
            <form action="javascript:void(0)" id="addColumnModalForm" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="tableName" id="tableName">
              <div class="modal-body">
              <div class="row">
                <div class="col-md-12 newcolumnError">
                </div>
              </div>
              <div class="row">
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Column Name</label>
                            <input type="text" name="name" id="name" placeholder="Custom Fields " class="form-control">
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Column Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">-- Select Type --</option>
                                <option value="2">TextInput</option>
                                <option value="3">Checkbox</option>
                                <option value="4">Dropdown</option>
                            </select>
                        </div>
                   </div>
              </div>
              <div class="row ">
                   <div class="col-md-6 ">
                        <div class="form-group item_list_column">
                            
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-block btn-primary">Create New Column</button>
                        </div>
                   </div>
              </div>
              </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
            </div> -->
            </form>
          </div>
        </div>
      </div>


    <!-- Modal -->
    <div class="modal fade" id="add_parasites" role="dialog">
        <div class="modal-dialog modal-xs">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"> </h4>
              <label for="name">Add New Parasite</label>
            </div>
            <form action="javascript:void(0)" id="parasites_modal_form" method="post">
	 @csrf
	  <div class="modal-body">
	   <div class="row">
		   <div class="col-md-6">
				<div class="form-group">
					<input type="text" name="parasite_name" id="parasite_name" placeholder="Enter Parasite Name" class="form-control">
				</div>
		   </div>
		   <div class="col-md-6">
				<div class="form-group">
					<input type="text" name="description" id="description" placeholder="Enter Parasite Description" class="form-control">
				</div>
		   </div>
	  </div>
	  <div class="row">
		   <div class="col-md-6">
				<div class="form-group">
				    <input type="file" name="parasite_image" id="parasite_image" placeholder="Enter Parasite Image" class="form-control">
				</div>
		   </div>
		   <div class="col-md-6">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-sm btn-block btn-primary">Create New Parasite</button>
				</div>
		   </div>
	  </div>
	  </div>
         <!-- <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
            </div> -->
    </form>
    </div>
</div>
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

   /* $('.td-data').click(function(){
            //console.log($(this).html());
            alert($(this).html());
        });*/


        $('.td-data').click(function(){

            var a = $("#input_value").val($(this).html());
            var a = $("#input_value2").val($(this).html());
            var a = $("#input_value3").val($(this).html());
            var a = $("#input_value4").val($(this).html());
            var a = $("#input_value5").val($(this).html());
        });

    function addNewParasite(){
        $('#add_parasites').modal('toggle');
    }

    $('#parasites_modal_form').submit(function(e) { 
        e.preventDefault();
        var parasite_name = $('#parasite_name').val();
		var description = $('#description').val();
		var parasite_image = $('#parasite_image').val();
		
        $.ajax({
            type: "POST",
            url: '{{ url("lot/addParasiteData") }}', 
            data: {'_token': '{{ csrf_token() }}', parasite_name: parasite_name, description: description, parasite_image: parasite_image},
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
    
    $(document).ready(function(){
       
        $("#parasite_ids").click(function(){
            $(".add_anisakis").append("<button class='btn btn-primary p'> Parasite 1 </button> <button class='btn btn-primary p'> Guts </button> <button class='btn btn-primary p'> Meat </button> <button class='btn btn-primary p'> Anus </button> <button class='btn btn-primary p'> Other </button>");
        });
    });

    $(document).ready(function(){

       $("#parasite_ids").click(function(){
           $(".anisakis_1").append('<tr><td class="anisakis_input"><label>1</label> </td><td><input type="" name="" class="form-control anisakis_input" placeholder="Enter Anisakis"></td></tr>');
       });
   });

</script>

@endsection

