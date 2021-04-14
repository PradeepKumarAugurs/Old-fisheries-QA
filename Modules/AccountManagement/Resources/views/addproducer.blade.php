@extends('layouts.app')
@section('title') <title>AccountManagement </title> 
<style>
a.add-new-column {
    border-radius: 50%;
}
a.add-new-row {
    border-radius: 50%;
}
</style>
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">Add Producer Profile</h2>
            <div class="row">
                <div class="messageDiv">
                </div>
                <div class="col-md-12">
                <!-- Custom Tabs -->
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
               
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="@if(!Session::has('tab')) active @endif"><a href="#tab_1" data-toggle="tab">Profile</a></li>
                        <li class="@if(Session::has('tab') && Session::get('tab')=='tab_2') active @endif"><a href="#tab_2" data-toggle="tab">Customization</a></li>
                        <li class="@if(Session::has('tab') && Session::get('tab')=='tab_3') active @endif"><a href="#tab_3" data-toggle="tab">Specs & Sops</a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane @if(!Session::has('tab')) active @endif" id="tab_1">
                        <form action="{{ url('accountmanagement/createProducer') }}" id="basicInfoForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <h4>Producer Info </h4>
                        
                        <div class="row">
                         <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Producer Name</label>
                                            <input type="text" name="name" value="{{old('name')}}"  class="@error('name') is-invalid @enderror form-control" >
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image"></label>
                                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                        </div>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>
                                </div> <!--  END Row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-hover table-border">
                                          <thead>
                                          <tr>
                                           <th class="info">Code</th>
                                           <th class="info" >Alpha Code</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                            <td> 
                                                <input type="text" value="{{old('code')}}"  name="code" class="form-control @error('code') is-invalid @enderror">
                                                @error('code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror 
                                            </td>
                                            <td> 
                                                <input type="text"  value="{{old('alpha_code')}}" name="alpha_code" class="@error('alpha_code') is-invalid @enderror form-control">
                                                @error('alpha_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            </tr>
                                            
                                          </tbody>
                                        </table>
                                    </div>
                                </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover table-border">
                                        <tbody>
                                        <tr>
                                        <th class="info">Country</th>
                                        <td>
                                        <select name="country" id="country" value="{{old('country')}}" class="form-control @error('country') is-invalid @enderror getCitiesByAjax">
                                            <option value="">-- Select Country --</option>
                                            @if(isset($getAllCountries) && count($getAllCountries))
                                                @foreach($getAllCountries as $country)
                                                    <option value="{{$country->id}}" @if(old('country')==$country->id) selected  @endif >{{$country->name}}</option>
                                                @endforeach
                                            @endif 
                                        </select>
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </td>
                                        </tr>
                                        <tr>
                                        <th class="info">City</th>
                                        <td>
                                        <select name="city" id="city" value="{{old('city')}}" class="form-control @error('city') is-invalid @enderror">
                                        <option value="">-- Select City --</option>
                                            @if(old('country'))
                                            @foreach(Modules\AccountManagement\Entities\City::where('country_id',old('country'))->get() as $value)
                                               <option value="{{$value->id}}" @if(old('city')==$value->id) selected @endif >{{$value->name}}</option>
                                            @endforeach
                                            @endif 
                                        </select>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </td>
                                        </tr>
                                        <tr>
                                        <th class="info">Address</th>
                                        <td>
                                        <input type="text" name="address" value="{{old('address')}}" class="form-control @error('address') is-invalid @enderror">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- End of the Row -->
                        </div>
                        
                        <div class="col-md-6">
                            <div class="row"> 
                                <div class="col-md-12">
                                    <table class="table table-hover table-border">
                                        <thead>
                                        <tr>
                                        <th class="info">User having access to this producer</th>
                                        <th class="info">Name of The Leader</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                        <td>
                                           <div class="form-group">
                                                <select  class="form-control @error('producerAccess.user_id.0') is-invalid @enderror " name="producerAccess[user_id][]">
                                                    <option value="">-- Select Users --</option>
                                                    @if(isset($getAllProducerUser) && count($getAllProducerUser))
                                                    @foreach($getAllProducerUser as $producer)
                                                    <option value="{{$producer->id}}" @if(old('producerAccess.user_id.0') ==$producer->id ) selected @endif >{{($producer->name=="")?ucfirst($producer->username):ucfirst($producer->name)}}</option> 
                                                    @endforeach
                                                    @endif 
                                                </select>
                                                @error('producerAccess.user_id.0')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                           </div>
                                           <div class="form-group">
                                                <select  class="form-control @error('producerAccess.user_id.1') is-invalid @enderror " name="producerAccess[user_id][]">
                                                    <option value="">-- Select Users --</option>  
                                                    @if(isset($getAllProducerUser) && count($getAllProducerUser))
                                                    @foreach($getAllProducerUser as $producer)
                                                    <option value="{{$producer->id}}" @if(old('producerAccess.user_id.1') ==$producer->id ) selected @endif >{{($producer->name=="")?ucfirst($producer->username):ucfirst($producer->name)}}</option> 
                                                    @endforeach
                                                    @endif  
                                                </select>
                                                @error('producerAccess.user_id.1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                           </div>
                                           <div class="form-group">
                                                <select  class="form-control @error('producerAccess.user_id.2') is-invalid @enderror " name="producerAccess[user_id][]">
                                                    <option value="">-- Select Users --</option>  
                                                    @if(isset($getAllProducerUser) && count($getAllProducerUser))
                                                    @foreach($getAllProducerUser as $producer)
                                                    <option value="{{$producer->id}}" @if(old('producerAccess.user_id.2') ==$producer->id ) selected @endif >{{($producer->name=="")?ucfirst($producer->username):ucfirst($producer->name)}}</option> 
                                                    @endforeach
                                                    @endif 
                                                </select>
                                                @error('producerAccess.user_id.2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                           </div>
                                        </td>
                                        <td> 
                                            <div class="form-group">
                                                <select  class="form-control @error('leader_id') is-invalid @enderror " name="leader_id">
                                                    <option value="">-- Select Leader --</option>  
                                                    @if(isset($getAllProducerUser) && count($getAllProducerUser))
                                                    @foreach($getAllProducerUser as $producer)
                                                    <option value="{{$producer->id}}" @if(old('leader_id')) selected @endif >{{($producer->name=="")?ucfirst($producer->username):ucfirst($producer->name)}}</option> 
                                                    @endforeach
                                                    @endif 
                                                </select>
                                                @error('leader_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                           </div>
                                        </td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- End of the Row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover table-border">
                                        <tbody>
                                        <tr>
                                            <th class="info">Producer Type</th>
                                            <td>
                                                <select  class="form-control @error('producer_type') is-invalid @enderror " name="producer_type">
                                                    <option value="">-- Select Producer Type --</option>
                                                    <option @if(old('producer_type')=='1') selected @endif  value="1" >Landbased</option>
                                                    <option @if(old('producer_type')=='2') selected @endif value="2">Onboard Processing</option>
                                                </select>
                                                @error('producer_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- End fo  the Row -->
                            

                         </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                            <table   class="table table-border table-striped">
                            <thead>
                                <tr class="info">
                                   <th></th>
                                </tr>
                            </thead>    
                            <tbody>
                                 <tr>
                                 <td>
                                <div class="col-md-6">
                                <a href="javascript:void(0)" class="fa fa-plus add-new-city">Add New City</a>
                                </div>
                                </td>
                                </tr>
                              </tbody>
                            </table>  
                          </div>  
                        </div> <!--  END Row -->
                        
                        <h4>Fishing Info</h4>
                        <input type="hidden" name="sections[0][name]" value="Fishing">
                        <input type="hidden" name="sections[0][name_key]" value="fishing">
                        <div class="row">
                                <div class="col-md-11 table-responsive">
                                        <table  id="fishing-table" class="table table-border table-striped">
                                            <thead>
                                            <tr class="info" >
                                                <th>
                                                <input type="text" name="sections[0][custom_fields][name][]" value="@if(old('sections.0.custom_fields.name.0')) {{old('sections.0.custom_fields.name.0')}} @else Vissel list @endif" class="form-control @error('sections.0.custom_fields.name.0') is-invalid @enderror ">
                                                <input type="hidden" name="sections[0][custom_fields][type][]" value="@if(old('sections.0.custom_fields.type.0')) {{old('sections.0.custom_fields.type.0')}} @else 4 @endif" class="form-control">
                                                <input type="hidden" name="sections[0][custom_fields][item_list][]" value="@if(old('sections.0.custom_fields.item_list.0')) {{old('sections.0.custom_fields.item_list.0')}} @else a,b,c @endif" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[0][custom_fields][name][]" value="@if(old('sections.0.custom_fields.name.1')) {{old('sections.0.custom_fields.name.1')}} @else Self Owned @endif" class="form-control @error('sections.0.custom_fields.name.1') is-invalid @enderror">
                                                <input type="hidden" name="sections[0][custom_fields][type][]" value="@if(old('sections.0.custom_fields.type.1')) {{old('sections.0.custom_fields.type.1')}} @else 2 @endif"   class="form-control">
                                                <input type="hidden" name="sections[0][custom_fields][item_list][]" value="@if(old('sections.0.custom_fields.item_list.1')) {{old('sections.0.custom_fields.item_list.1')}} @else  @endif" value="a,b,c" class="form-control ">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[0][custom_fields][name][]"  value="@if(old('sections.0.custom_fields.name.2')) {{old('sections.0.custom_fields.name.2')}} @else Exclusivity @endif" class="form-control @error('sections.0.custom_fields.name.2') is-invalid @enderror">
                                                <input type="hidden" name="sections[0][custom_fields][type][]" value="@if(old('sections.0.custom_fields.type.2')) {{old('sections.0.custom_fields.type.2')}} @else 2 @endif" class="form-control">
                                                <input type="hidden" name="sections[0][custom_fields][item_list][]" value="@if(old('sections.0.custom_fields.item_list.2')) {{old('sections.0.custom_fields.item_list.2')}} @else  @endif"  class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[0][custom_fields][name][]"  value="@if(old('sections.0.custom_fields.name.3')) {{old('sections.0.custom_fields.name.3')}} @else Priority @endif" class="form-control @error('sections.0.custom_fields.name.3') is-invalid @enderror">
                                                <input type="hidden" name="sections[0][custom_fields][type][]" value="@if(old('sections.0.custom_fields.type.3')) {{old('sections.0.custom_fields.type.3')}} @else 2 @endif"value="2" class="form-control">
                                                <input type="hidden" name="sections[0][custom_fields][item_list][]" value="@if(old('sections.0.custom_fields.item_list.3')) {{old('sections.0.custom_fields.item_list.3')}} @else  @endif"value="a,b,c" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[0][custom_fields][name][]" value="@if(old('sections.0.custom_fields.name.4')) {{old('sections.0.custom_fields.name.4')}} @else Capacity @endif" class="form-control @error('sections.0.custom_fields.name.4') is-invalid @enderror">
                                                <input type="hidden" name="sections[0][custom_fields][type][]" value="@if(old('sections.0.custom_fields.type.4')) {{old('sections.0.custom_fields.type.4')}} @else 2 @endif" class="form-control">
                                                <input type="hidden" name="sections[0][custom_fields][item_list][]" value="@if(old('sections.0.custom_fields.item_list.4')) {{old('sections.0.custom_fields.item_list.4')}} @else  @endif" class="form-control">
                                                </th>
                                            </tr>
                                            <thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                <input type="text" class="form-control @error('sections.0.custom_rows.customdata.0.value.0') is-invalid @enderror" name="sections[0][custom_rows][customdata][0][value][]" value="@if(old('sections.0.custom_rows.customdata.0.value.0')){{old('sections.0.custom_rows.customdata.0.value.0')}}@else internal Onboard @endif"> 
                                                
                                                </td> 
                                                <td><input type="text" name="sections[0][custom_rows][customdata][1][value][]" class="form-control @error('sections.0.custom_rows.customdata.1.value.0') is-invalid @enderror" value="{{old('sections.0.custom_rows.customdata.1.value.0')}}">  </td>
                                                <td><input type="text" name="sections[0][custom_rows][customdata][2][value][]" class="form-control @error('sections.0.custom_rows.customdata.2.value.0') is-invalid @enderror" value="{{old('sections.0.custom_rows.customdata.2.value.0')}}"> </td>
                                                <td><input type="text" name="sections[0][custom_rows][customdata][3][value][]" class="form-control @error('sections.0.custom_rows.customdata.3.value.0') is-invalid @enderror" value="{{old('sections.0.custom_rows.customdata.3.value.0')}}"> </td>
                                                <td><input type="text" name="sections[0][custom_rows][customdata][4][value][]" class="form-control @error('sections.0.custom_rows.customdata.0.value.0') is-invalid @enderror" value="{{old('sections.0.custom_rows.customdata.4.value.0')}}"> </td>
                                               
                                            </tr>
                                            <tr>
                                                <td>
                                                  <select  class="form-control @error('sections.0.custom_rows.customdata.0.value.1') is-invalid @enderror" name="sections[0][custom_rows][customdata][0][value][]" >
                                                   <option value="">-- Select vessels--</option>
                                                   @if(isset($getVesselList) && count($getVesselList))
                                                   @foreach($getVesselList as $vessel)
                                                    <option value="{{$vessel->id}}" @if(old('sections.0.custom_rows.customdata.0.value.1')==$vessel->id) selected @endif >{{$vessel->vessel_name}}</option>
                                                   @endforeach
                                                   @endif 
                                                  </select>
                                                </td>
                                                <td><input type="checkbox" name="sections[0][custom_rows][customdata][1][value][]" @if(old('sections.0.custom_rows.customdata.1.value.1')=='1') checked @endif value="1" class="minimal @error('sections.0.custom_rows.customdata.1.value.1') is-invalid @enderror" ></td>
                                                <td><input type="checkbox" name="sections[0][custom_rows][customdata][2][value][]" @if(old('sections.0.custom_rows.customdata.2.value.1')=='1') checked @endif value="1" class="minimal @error('sections.0.custom_rows.customdata.2.value.1') is-invalid @enderror" ></td>
                                                <td><input type="checkbox" name="sections[0][custom_rows][customdata][3][value][]" @if(old('sections.0.custom_rows.customdata.3.value.1')=='1') checked @endif value="1" class="minimal @error('sections.0.custom_rows.customdata.3.value.1') is-invalid @enderror" ></td>
                                                <td><input type="text" name="sections[0][custom_rows][customdata][4][value][]"  value="@if(old('sections.0.custom_rows.customdata.4.value.1')){{old('sections.0.custom_rows.customdata.4.value.1')}}@endif "class="form-control @error('sections.0.custom_rows.customdata.4.value.1') is-invalid @enderror"> </td>
                                               
                                            </tr>
                                            <tr>
                                                <td>
                                                  <select  class="form-control @error('sections.0.custom_rows.customdata.0.value.2') is-invalid @enderror" name="sections[0][custom_rows][customdata][0][value][]" >
                                                   <option value="">-- Select vessels--</option>
                                                   @if(isset($getVesselList) && count($getVesselList))
                                                   @foreach($getVesselList as $vessel)
                                                    <option value="{{$vessel->id}}" @if(old('sections.0.custom_rows.customdata.0.value.2')==$vessel->id) selected @endif>{{$vessel->vessel_name}}</option>
                                                   @endforeach
                                                   @endif 
                                                  </select>
                                                </td>
                                                <td><input type="checkbox" name="sections[0][custom_rows][customdata][1][value][]" @if(old('sections.0.custom_rows.customdata.1.value.2')=='1') checked @endif value="1"class="minimal @error('sections.0.custom_rows.customdata.1.value.2') is-invalid @enderror" ></td>
                                                <td><input type="checkbox" name="sections[0][custom_rows][customdata][2][value][]" @if(old('sections.0.custom_rows.customdata.2.value.2')=='1') checked @endif value="1" class="minimal @error('sections.0.custom_rows.customdata.2.value.2') is-invalid @enderror" ></td>
                                                <td><input type="checkbox" name="sections[0][custom_rows][customdata][3][value][]" @if(old('sections.0.custom_rows.customdata.3.value.2')=='1') checked @endif value="1" class="minimal @error('sections.0.custom_rows.customdata.3.value.2') is-invalid @enderror" ></td>
                                                <td><input type="text" name="sections[0][custom_rows][customdata][4][value][]"  value="@if(old('sections.0.custom_rows.customdata.4.value.2')){{old('sections.0.custom_rows.customdata.4.value.2')}}@endif " class="form-control @error('sections.0.custom_rows.customdata.4.value.2') is-invalid @enderror"> </td>
                                             </tr>
                                        </table>
                                       <div class="new_rows_button">
                                            <a href="javascript:void(0)" data-table="fishing" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                       </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="fishing" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> <!--  END Row -->

                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="fao_fishing_zone">FAO Fising Zone</label>
                                            <select class="form-control @error('fao_fishing_zone') is-invalid @enderror" name="fao_fishing_zone">
                                                <option @if(old('fao_fishing_zone')=='') selected @endif value="">-- Select Fishing Zone --</option>
                                                <option @if(old('fao_fishing_zone')=='1') selected @endif value="1">Area 18 (Arctic Sea)</option>
                                                <option @if(old('fao_fishing_zone')=='2') selected @endif value="2">Area 21 (Atlantic, Northwest)</option>
                                                <option @if(old('fao_fishing_zone')=='3') selected @endif value="3">Area 27 (Atlantic, Northeast)</option>
                                                <option @if(old('fao_fishing_zone')=='4') selected @endif value="4">Area 31 ( Atlantic, Western Central)</option>
                                                <option @if(old('fao_fishing_zone')=='5') selected @endif value="5">Area 34 (Atlantic, Eastern Central)</option>
                                                <option @if(old('fao_fishing_zone')=='6') selected @endif value="6">Area 37 (Mediterranean and Black Sea)</option>
                                                <option @if(old('fao_fishing_zone')=='7') selected @endif value="7">Area 41 (Atlantic, Southwest)</option>
                                                <option @if(old('fao_fishing_zone')=='8') selected @endif value="8">Area 47 (Atlantic, Southeast)</option>
                                                <option @if(old('fao_fishing_zone')=='9') selected @endif value="9">Area 48 (Atlantic, Antarctic)</option>
                                                <option @if(old('fao_fishing_zone')=='10') selected @endif value="10">Area 51 ( Indian Ocean, Western)</option>
                                                <option @if(old('fao_fishing_zone')=='11') selected @endif value="11">Area 57 (Indian Ocean, Eastern)</option>
                                                <option @if(old('fao_fishing_zone')=='12') selected @endif value="12">Area 58 (Indian Ocean, Antarctic and Southern)</option>
                                                <option @if(old('fao_fishing_zone')=='13') selected @endif value="13">Area 61 (Pacific, Northwest)</option>
                                                <option @if(old('fao_fishing_zone')=='14') selected @endif value="14">Area 67 (Pacific, Northeast)</option>
                                                <option @if(old('fao_fishing_zone')=='15') selected @endif value="15">Area 71 (Pacific, Western Central)</option>
                                                <option @if(old('fao_fishing_zone')=='16') selected @endif value="16">Area 77 (Pacific, Eastern Central)</option>
                                                <option @if(old('fao_fishing_zone')=='17') selected @endif value="17">Area 81 (Pacific, Southwest)</option>
                                                <option @if(old('fao_fishing_zone')=='18') selected @endif value="18">Area 87 (Pacific, Southeast)</option>
                                                <option @if(old('fao_fishing_zone')=='19') selected @endif value="19">Area 88 (Pacific, Antarctic)</option>
                                              
                                            </select>
                                            @error('fao_fishing_zone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="col-md-6"></div>
                            </div> <!--  END Row -->

                            <h4>Unloading info </h4>
                            <input type="hidden" name="sections[1][name]" value="Unloading">
                            <input type="hidden" name="sections[1][name_key]" value="unloading">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table id="unloading-table" class="table table-border table-striped">
                                            <thead>
                                            <tr class="info">
                                                <th>
                                                <input type="text" name="sections[1][custom_fields][name][]" value="Unloading Site" class="form-control @error('sections.1.custom_fields.name.0') is-invalid @enderror ">
                                                <input type="hidden" name="sections[1][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[1][custom_fields][item_list][]" value="" class="form-control">
                                                
                                                </th>
                                                <th>
                                                <input type="text" name="sections[1][custom_fields][name][]" value="Unloading Type" class="form-control @error('sections.1.custom_fields.name.1') is-invalid @enderror">
                                                <input type="hidden" name="sections[1][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[1][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[1][custom_fields][name][]" value="Distance" class="form-control @error('sections.1.custom_fields.name.2') is-invalid @enderror">
                                                <input type="hidden" name="sections[1][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[1][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[1][custom_fields][name][]" value="Typical Trucking Time" class="form-control @error('sections.1.custom_fields.name.3') is-invalid @enderror">
                                                <input type="hidden" name="sections[1][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[1][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>                   
                                                 <td><input type="text" name="sections[1][custom_rows][customdata][0][value][]"  class="form-control" > </td>
                                                <td> <select class="form-control" name="sections[1][custom_rows][customdata][1][value][]">
                                                    <option value="">-- Select Unloading Type--</option>
                                                    <option value="1">Positive Pressure</option>
                                                    <option value="2">Peristaltic</option>
                                                    <option value="3">Brail</option>
                                                    <option value="4">Transvac Type</option>
                                                    <option value="5">Manual</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="sections[1][custom_rows][customdata][2][value][]" class="form-control"> </td>
                                                <td><input type="text" name="sections[1][custom_rows][customdata][3][value][]"  class="form-control" > </td>
                                                
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="new_rows_button">
                                            <a href="javascript:void(0)" data-table="unloading" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                        </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="unloading" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> <!--  END Row -->
                            <h4>Storage At Reception </h4>
                            <input type="hidden" name="sections[2][name]" value="Storage At Reception">
                            <input type="hidden" name="sections[2][name_key]" value="storageAtReception">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table id="storageAtReception-table" class="table table-border table-striped">
                                            <thead>
                                                <tr class="info">
                                                    <th>                                                                                        
                                                    <input type="text" name="sections[2][custom_fields][name][]" value="Stroage at Reception" class="form-control @error('sections.2.custom_fields.name.0') is-invalid @enderror">
                                                    <input type="hidden" name="sections[2][custom_fields][type][]" value="2" class="form-control">
                                                    <input type="hidden" name="sections[2][custom_fields][item_list][]" value="" class="form-control">
                                                    </th>
                                                    <th>
                                                    <input type="text" name="sections[2][custom_fields][name][]" value="Capacity" class="form-control @error('sections.2.custom_fields.name.1') is-invalid @enderror">
                                                    <input type="hidden" name="sections[2][custom_fields][type][]" value="2" class="form-control">
                                                    <input type="hidden" name="sections[2][custom_fields][item_list][]" value="" class="form-control">
                                                    </th>
                                                    <th>
                                                    <input type="text" name="sections[2][custom_fields][name][]" value="DistStorage Typeance" class="form-control @error('sections.2.custom_fields.name.1') is-invalid @enderror">
                                                    <input type="hidden" name="sections[2][custom_fields][type][]" value="2" class="form-control">
                                                    <input type="hidden" name="sections[2][custom_fields][item_list][]" value="" class="form-control">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr> 
                                                <td><input type="text" name="sections[2][custom_rows][customdata][0][value][]" value="Storage9T" class="form-control @error('sections.2.custom_fields.name.3') @enderror"></td>
                                                <td><input type="text" name="sections[2][custom_rows][customdata][1][value][]" class="form-control" > </td>
                                                <td> 
                                                    <select class="form-control" name="sections[2][custom_rows][customdata][2][value][]">
                                                        <option value="">-- Select --</option>
                                                        <option value="1">Totes</option>
                                                        <option value="2">Pool</option>
                                                        <option value="3">Dry</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="info">
                                                    <th>Total</th>
                                                    <th><input type="text" name="total_capacity_of_storage_reception" value="4234" class="form-control @error('total_capacity_of_storage_reception') is-invalid @enderror"></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="new_rows_button">
                                            <a href="javascript:void(0)" data-table="storageAtReception" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                        </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="storageAtReception" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                
                            </div> <!--  END Row -->

                            <h4>Ice Supply</h4>
                            <input type="hidden" name="sections[3][name]" value="Ice Supply">
                            <input type="hidden" name="sections[3][name_key]" value="iceSupply">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table  id="iceSupply-table" class="table table-border table-striped">
                                            <thead>
                                            <tr class="info">
                                                <th>
                                                <input type="text" name="sections[3][custom_fields][name][]" value="Source" class="form-control @error('sections.3.custom_fields.name.1') is-invalid @enderror">
                                                <input type="hidden" name="sections[3][custom_fields][type][]" value="4" class="form-control">
                                                <input type="hidden" name="sections[3][custom_fields][item_list][]" value="other,own,third-party" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[3][custom_fields][name][]" value="Capacity" class="form-control @error('sections.3.custom_fields.name.1') is-invalid @enderror">
                                                <input type="hidden" name="sections[3][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[3][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[3][custom_fields][name][]" value="Type Of Ice" class="form-control @error('sections.3.custom_fields.name.2') is-invalid @enderror">
                                                <input type="hidden" name="sections[3][custom_fields][type][]" value="4" class="form-control">
                                                <input type="hidden" name="sections[3][custom_fields][item_list][]" value="other,slurry,crush bar,flake" class="form-control">
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td> 
                                                    <select class="form-control" name="sections[3][custom_rows][customdata][0][value][]">
                                                    <option value="">-- Select --</option> 
                                                    <option value="1">other</option>
                                                    <option value="2">Own</option>
                                                    <option value="3">third-party</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="sections[3][custom_rows][customdata][1][value][]" class="form-control" > </td>
                                                <td> <select class="form-control" name="sections[3][custom_rows][customdata][2][value][]">
                                                    <option value="">-- Select --</option> 
                                                    <option value="1">other</option>
                                                    <option value="2">slurry</option>
                                                    <option value="3">crush bar</option>
                                                    <option value="4">flake</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="new_rows_button">
                                            <a href="javascript:void(0)" data-table="iceSupply" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                        </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="iceSupply" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> <!--  END Row -->
                            <h4>Grading</h4>
                            <input type="hidden" name="sections[4][name]" value="Gradding">
                            <input type="hidden" name="sections[4][name_key]" value="gradding">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table  id="gradding-table" class="table table-border table-striped">
                                            <thead>
                                            <tr class="info">
                                                <th>
                                                <input type="text" name="sections[4][custom_fields][name][]" value="Gradding" class="form-control @error('sections.4.custom_fields.name.0') is-invalid @enderror">
                                                <input type="hidden" name="sections[4][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[4][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[4][custom_fields][name][]" value="Type" class="form-control @error('sections.4.custom_fields.name.1') is-invalid @enderror">
                                                <input type="hidden" name="sections[4][custom_fields][type][]" value="4" class="form-control">
                                                <input type="hidden" name="sections[4][custom_fields][item_list][]" value="other,own,third-party" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[4][custom_fields][name][]" value="Capacity" class="form-control @error('sections.4.custom_fields.name.2') is-invalid @enderror">
                                                <input type="hidden" name="sections[4][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[4][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[4][custom_fields][name][]" value="Of Grades" class="form-control @error('sections.4.custom_fields.name.3') is-invalid @enderror">
                                                <input type="hidden" name="sections[4][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[4][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><input type="text"  name="sections[4][custom_rows][customdata][0][value][]" class="form-control"></td>   
                                                <td> 
                                                   <select class="form-control" name="sections[4][custom_rows][customdata][1][value][]">
                                                    <option value="">-- Select --</option>
                                                    <option value="1">Roller Gradder</option>
                                                    <option value="2">Belt Gradder</option>
                                                    <option value="3">Weight Gradder</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="sections[4][custom_rows][customdata][2][value][]"  class="form-control" > </td>
                                                <td><input type="text" name="sections[4][custom_rows][customdata][3][value][]"  class="form-control" > </td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="info">
                                                    <th>Total</th>
                                                    <th></th>
                                                    <th><input type="text" name="total_grading_capacity" value="4234" class="form-control"></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="new_rows_button">
                                            <a href="javascript:void(0)" data-table="gradding" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                        </div>
                                        
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="gradding" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> <!--  END Row -->

                            <h4>Wr Processing</h4>
                            <input type="hidden" name="sections[5][name]" value="WrProcessing">
                            <input type="hidden" name="sections[5][name_key]" value="WrProcessing">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table  id="wrProcessing-table" class="table table-border table-striped">
                                            <thead>
                                            <tr class="info">
                                                <th>      
                                                <input type="text" name="sections[5][custom_fields][name][]" value=" Of infeed" class="form-control @error('sections.5.custom_fields.name.0') is-invalid @enderror">
                                                <input type="hidden" name="sections[5][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[5][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[5][custom_fields][name][]" value="Name" class="form-control @error('sections.5.custom_fields.name.1') is-invalid @enderror">
                                                <input type="hidden" name="sections[5][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[5][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[5][custom_fields][name][]" value="Capacity/Hour" class="form-control @error('sections.5.custom_fields.name.2') is-invalid @enderror">
                                                <input type="hidden" name="sections[5][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[5][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="sections[5][custom_rows][customdata][0][value][]" value="Line1" class="form-control"></td>    
                                                    <td><input type="text" name="sections[5][custom_rows][customdata][1][value][]"  class="form-control" > </td>   
                                                    <td><input type="text" name="sections[5][custom_rows][customdata][2][value][]"  class="form-control" > </td> 
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="info">
                                                    <th>Total</th>
                                                    <th></th>
                                                    <th><input type="text" name="total_wr_processing_capacity" value="@if(old('total_wr_processing_capacity')) {{old('total_wr_processing_capacity')}} @endif" class="form-control @error('total_wr_processing_capacity') is-invalid @enderror">
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table> 
                                        <div class="new_rows_button">
                                            <a href="javascript:void(0)" data-table="wrProcessing" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                        </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="wrProcessing" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> <!--  END Row -->

                            <h4>Cutting  Info </h4>
                            <input type="hidden" name="sections[6][name]" value="Cutting">
                            <input type="hidden" name="sections[6][name_key]" value="Cutting">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table id="cuttingReverting-table" class="table table-border table-striped">
                                            <thead>
                                           
                                            <tr class="info">
                                                <th>      
                                                <input type="text" name="sections[6][custom_fields][name][]" value="No Of infeed" class="form-control">
                                                <input type="hidden" name="sections[6][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[6][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[6][custom_fields][name][]" value="Name" class="form-control">
                                                <input type="hidden" name="sections[6][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[6][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[6][custom_fields][name][]" value="Capacity/Hour" class="form-control">
                                                <input type="hidden" name="sections[6][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[6][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                                <th>
                                                <input type="text" name="sections[6][custom_fields][name][]" value="No Of Machine" class="form-control">
                                                <input type="hidden" name="sections[6][custom_fields][type][]" value="2" class="form-control">
                                                <input type="hidden" name="sections[6][custom_fields][item_list][]" value="" class="form-control">
                                                </th>
                                            </tr>
                                           
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th><input type="text" name="sections[6][custom_rows][customdata][0][value][]" value="Line1" class="form-control"></th>   
                                                    <td><input type="text" name="sections[6][custom_rows][customdata][1][value][]"  class="form-control"> </td>   
                                                    <td><input type="text" name="sections[6][custom_rows][customdata][2][value][]"  class="form-control" > </td>   
                                                    <td><input type="text" name="sections[6][custom_rows][customdata][3][value][]"  class="form-control" > </td>   
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="info">
                                                    <th>Total</th>
                                                    <th></th>
                                                    <th><input type="text" name="total_cutting_capacity" value="4234" class="form-control @error('total_cutting_capacity') is-invalid @enderror"></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="new_rows_button">
                                            <a href="javascript:void(0)" data-table="cuttingReverting" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                        </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="cuttingReverting" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> <!--  END Row -->

                            <h4>Cutting  Size Info </h4>
                            <input type="hidden" name="sections[7][name]" value="CuttingSize">
                            <input type="hidden" name="sections[7][name_key]" value="CuttingSize">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table  id="cuttingSize-table" class="table table-border table-striped">
                                    <thead>
                                    <tr class="info">
                                        <th>
                                            <input type="text" name="sections[7][custom_fields][name][]" value="Name" class="form-control @error('sections.7.custom_fields.name.0') is-invalid @enderror">
                                            <input type="hidden" name="sections[7][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[7][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[7][custom_fields][name][]" value="From" class="form-control @error('sections.7.custom_fields.name.1') is-invalid @enderror">
                                            <input type="hidden" name="sections[7][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[7][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[7][custom_fields][name][]" value="To" class="form-control @error('sections.7.custom_fields.name.2') is-invalid @enderror">
                                            <input type="hidden" name="sections[7][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[7][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[7][custom_fields][name][]" value="Number of Machine" class="form-control @error('sections.7.custom_fields.name.3') is-invalid @enderror">
                                            <input type="hidden" name="sections[7][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[7][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="sections[7][custom_rows][customdata][0][value][]"  class="form-control" > </td>   
                                            <td><input type="text" name="sections[7][custom_rows][customdata][1][value][]"  class="form-control" > </td>   
                                            <td><input type="text" name="sections[7][custom_rows][customdata][2][value][]"  class="form-control"> </td>   
                                            <td><input type="text" name="sections[7][custom_rows][customdata][3][value][]"  class="form-control" > </td> 
                                        </tr>
                                    </tbody>
                                    </table>
                                    <div class="new_rows_button">
                                        <a href="javascript:void(0)" data-table="cuttingSize" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="cuttingSize" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> <!--  END Row -->

                            <h4>Batch Freezing Info </h4>
                            <input type="hidden" name="sections[8][name]" value="FreezingBatch">
                            <input type="hidden" name="sections[8][name_key]" value="FreezingBatch">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table id="freezingBatch-table" class="table table-border table-striped">
                                    <thead>
                                    <tr class="info">
                                        <th>
                                            <input type="text" name="sections[8][custom_fields][name][]" value="Name" class="form-control @error('sections.8.custom_fields.name.0') is-invalid @enderror">
                                            <input type="hidden" name="sections[8][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[8][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[8][custom_fields][name][]" value="Type" class="form-control @error('sections.8.custom_fields.name.1') is-invalid @enderror">
                                            <input type="hidden" name="sections[8][custom_fields][type][]" value="4" class="form-control">
                                            <input type="hidden" name="sections[8][custom_fields][item_list][]" value="Static IQF,Blast Freezer,Plaste Freezer" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[8][custom_fields][name][]" value="Pack" class="form-control @error('sections.8.custom_fields.name.2') is-invalid @enderror">
                                            <input type="hidden" name="sections[8][custom_fields][type][]" value="4" class="form-control">
                                            <input type="hidden" name="sections[8][custom_fields][item_list][]" value="Loose In Plate,Metal Pan,Plastic crate,carton" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[8][custom_fields][name][]" value="Capacity/Batch" class="form-control @error('sections.8.custom_fields.name.3') is-invalid @enderror">
                                            <input type="hidden" name="sections[8][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[8][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="sections[8][custom_rows][customdata][0][value][]" value="Freezer1" class="form-control"></td>   
                                            <td> 
                                                <select class="form-control" name="sections[8][custom_rows][customdata][1][value][]">
                                                    <option value="">-- Select --</option>
                                                    <option value="1">Static IQF</option>
                                                    <option value="2">Blast Freezer</option>
                                                    <option value="3">Plaste Freezer</option>
                                                </select>
                                            <td>
                                                <select class="form-control" name="sections[8][custom_rows][customdata][2][value][]">
                                                    <option value="">-- Select --</option>
                                                    <option value="1">Loose In Plate</option>
                                                    <option value="2">Metal Pan</option>
                                                    <option value="3">Plastic crate</option>
                                                    <option value="4">carton</option>
                                                </select> 
                                            </td>
                                            <td>
                                                <input type="text" name="sections[8][custom_rows][customdata][3][value][]"  class="form-control">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr class="info">
                                            <td>Total</td>    
                                            <td></td>   
                                            <td></td>   
                                            <td><input type="text" name="total_batch_freezing_capacity"  class="form-control @error('total_batch_freezing_capacity') is-invalid @enderror" > </td>   
                                        </tr>
                                    </tfoot>
                                    </table>
                                    <div class="new_rows_button">
                                        <a href="javascript:void(0)" data-table="freezingBatch" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="freezingBatch" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> <!--  END Row -->

                            <h4>Continuous Freezing Info </h4>
                            <input type="hidden" name="sections[9][name]" value="FreezingCountinous">
                            <input type="hidden" name="sections[9][name_key]" value="FreezingCountinous">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table  id="freezingCountinous-table" class="table table-border table-striped">
                                    <thead>
                                    <tr class="info">
                                        <th>
                                            <input type="text" name="sections[9][custom_fields][name][]" value="Name" class="form-control @error('sections.9.custom_fields.name.0') @enderror">
                                            <input type="hidden" name="sections[9][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[9][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[9][custom_fields][name][]" value="Type" class="form-control @error('sections.9.custom_fields.name.1') @enderror">
                                            <input type="hidden" name="sections[9][custom_fields][type][]" value="4" class="form-control">
                                            <input type="hidden" name="sections[9][custom_fields][item_list][]" value="Static IQF,Blast Freezer,Plaste Freezer" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[9][custom_fields][name][]" value="Pack" class="form-control @error('sections.9.custom_fields.name.2') @enderror">
                                            <input type="hidden" name="sections[9][custom_fields][type][]" value="4" class="form-control">
                                            <input type="hidden" name="sections[9][custom_fields][item_list][]" value="Loose In Plate,Metal Pan,Plastic crate,carton" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[9][custom_fields][name][]" value="Capacity/Batch" class="form-control @error('sections.9.custom_fields.name.3') @enderror">
                                            <input type="hidden" name="sections[9][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[9][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="sections[9][custom_rows][customdata][0][value][]" value="Freezer1" class="form-control"></td>   
                                            <td> 
                                                <select class="form-control" name="sections[9][custom_rows][customdata][1][value][]">
                                                    <option value="">-- Select --</option>
                                                    <option value="1">Static IQF</option>
                                                    <option value="2">Blast Freezer</option>
                                                    <option value="3">Plaste Freezer</option>
                                                </select>  
                                            </td> 
                                            <td>
                                                <select class="form-control" name="sections[9][custom_rows][customdata][2][value][]">
                                                    <option value="">-- Select --</option>
                                                    <option value="1">Loose In Plate</option>
                                                    <option value="2">Metal Pan</option>
                                                    <option value="3">Plastic crate</option>
                                                    <option value="4">carton</option>
                                                </select> 
                                            </td>
                                            <td>
                                                <input type="text" name="sections[9][custom_rows][customdata][3][value][]" class="form-control">
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr class="info">
                                            <td>Total</td>    
                                            <td></td>   
                                            <td></td>   
                                            <td><input type="text" name="total_continuouse_freezing_capacity"  class="form-control @error('total_continuouse_freezing_capacity') is-invalid @enderror" > </td>   
                                        </tr>
                                    </tfoot>
                                    </table>
                                    <div class="new_rows_button">
                                        <a href="javascript:void(0)" data-table="freezingCountinous" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="freezingCountinous" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> <!--  END Row -->
                            <h4>Storage </h4>
                            <input type="hidden" name="sections[10][name]" value="Storage">
                            <input type="hidden" name="sections[10][name_key]" value="Storage">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table id="storage-table" class="table table-border table-striped">
                                    <thead>
                                    <tr class="info">
                                        <th>
                                            <input type="text" name="sections[10][custom_fields][name][]" value="CS" class="form-control @error('sections.10.custom_fields.name.0') is-invalid @enderror">
                                            <input type="hidden" name="sections[10][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[10][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[10][custom_fields][name][]" value="Name" class="form-control @error('sections.10.custom_fields.name.1') is-invalid @enderror">
                                            <input type="hidden" name="sections[10][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[10][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[10][custom_fields][name][]" value="Type" class="form-control @error('sections.10.custom_fields.name.2') is-invalid @enderror">
                                            <input type="hidden" name="sections[10][custom_fields][type][]" value="4" class="form-control">
                                            <input type="hidden" name="sections[10][custom_fields][item_list][]" value="cold Store,container plug" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[10][custom_fields][name][]" value="Capacity" class="form-control @error('sections.10.custom_fields.name.3') is-invalid @enderror">
                                            <input type="hidden" name="sections[10][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[10][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[10][custom_fields][name][]" value="Set Temp" class="form-control @error('sections.10.custom_fields.name.4') is-invalid @enderror">
                                            <input type="hidden" name="sections[10][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[10][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="sections[10][custom_rows][customdata][0][value][]"  class="form-control"> </td>   
                                            <td><input type="text" name="sections[10][custom_rows][customdata][1][value][]"  class="form-control" > </td>   
                                            <td> 
                                                <select class="form-control" name="sections[10][custom_rows][customdata][2][value][]">
                                                    <option value="">-- Select --</option>
                                                    <option value="1">Cold Store</option>
                                                    <option value="2">Container plug</option>
                                                </select> 
                                            </td>  
                                            <td><input type="text" name="sections[10][custom_rows][customdata][3][value][]"  class="form-control" > </td> 
                                            <td><input type="text" name="sections[10][custom_rows][customdata][4][value][]"  class="form-control" > </td> 
                                        </tr>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr class="info">   
                                            <td colspan="3">Total</td> 
                                            <td><input type="text" name="total_storage_capacity"  class="form-control @error('total_storage_capacity') is-invalid @enderror" > </td> 
                                            <td></td> 
                                        </tr>
                                    </tfoot>
                                    </table>
                                    <div class="new_rows_button">
                                        <a href="javascript:void(0)" data-table="storage" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>  
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="storage" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div> <!--  END Row -->

                            <h4>Expedition</h4>
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                    <table id="expedition-table" class="table table-border table-striped table-hover">
                                       <thead>
                                       <tr class="info">
                                           <th>Key</th>
                                           <th>Value</th>
                                       </tr>
                                       </thead>
                                        <tbody>
                                           <tr>
                                               <th class="info"><input type="text" name="expedition[key][]" value="Loading bays" class="form-control @error('expedition.key.0') is-invalid @enderror"></th>
                                               <td><input type="text"   name="expedition[value][]" class="form-control @error('expedition.value.0') is-invalid @enderror" ></td>
                                           </tr>
                                        </tbody>
                                    </table>
                                    <div class="new_rows_button">
                                        <a href="javascript:void(0)" data-table="expedition" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <!-- <div class="form-group">
                                        <a href="javascript:void(0)" data-table="expedition" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div> -->
                                </div>
                            </div> <!--  END Row -->

                            <h4>Transportation </h4>
                            <input type="hidden" name="sections[11][name]" value="Transportation">
                            <input type="hidden" name="sections[11][name_key]" value="Transportation">
                            <div class="row">
                                <div class="col-md-11 table-responsive">
                                <table  id="transportation-table" class="table table-border table-striped">
                                    <thead>
                                    <tr class="info">
                                        <th>
                                            <input type="text" name="sections[11][custom_fields][name][]" value="Shipping Port" class="form-control @error('sections.11.custom_fields.name.0') is-invalid @enderror">
                                            <input type="hidden" name="sections[11][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[11][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[11][custom_fields][name][]" value="Distance" class="form-control @error('sections.11.custom_fields.name.1') is-invalid @enderror">
                                            <input type="hidden" name="sections[11][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[11][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                        <th>
                                            <input type="text" name="sections[11][custom_fields][name][]" value="Trunking Time" class="form-control @error('sections.11.custom_fields.name.2') is-invalid @enderror">
                                            <input type="hidden" name="sections[11][custom_fields][type][]" value="2" class="form-control">
                                            <input type="hidden" name="sections[11][custom_fields][item_list][]" value="" class="form-control">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="sections[11][custom_rows][customdata][0][value][]" value="Loading bays" class="form-control"></td> 
                                            <td><input type="text" name="sections[11][custom_rows][customdata][1][value][]"  class="form-control"> </td> 
                                            <td><input type="text" name="sections[11][custom_rows][customdata][2][value][]"  class="form-control" > </td>  
                                        </tr>
                                    </tbody>
                                    </table>
                                    <div class="new_rows_button">
                                        <a href="javascript:void(0)" data-table="transportation" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div> 
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" data-table="transportation" class="add-new-column btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div> 
                            </div> <!--  END Row -->

                            <h4>Audit Info </h4> 
                            <input type="hidden" name="sections[11][name]" value="Transportation">
                            <input type="hidden" name="sections[11][name_key]" value="Transportation">
                            <div class="row">
                                <div class="col-md-12">
                                <table class="table table-border table-striped">
                                <thead>
                                <tr class="info">
                                 <th>Title</th>
                                 <th>Action</th> 
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Factory approved by Denis Group appointed auditor?</th>
                                        <td>
                                            <label>
                                            <input type="radio" class="flat-red @error('auditInfo.is_factory_approved') is-invalid @enderror" name="auditInfo[is_factory_approved]" value="1" > Yes
                                            </label>
                                            <label>
                                            <input type="radio" class="flat-red @error('auditInfo.is_factory_approved') is-invalid @enderror" name="auditInfo[is_factory_approved]" value="0" > No
                                            </label>
                                        </td>
                                       
                                    </tr>
                                    <tr>
                                        <th><label for="code">Date of the audit</label></th> 
                                        <td><input type="text" name="auditInfo[audit_date]" id="audit_date" class="form-control @error('auditInfo.audit_date') is-invalid @enderror" > </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code">Global Scoring </label></th> 
                                        <td><input type="text" name="auditInfo[scoring]" id="scoring" class="form-control @error('auditInfo.scoring') is-invalid @enderror" > </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code">Row Material </label></th> 
                                        <td><input type="text" name="auditInfo[row_material]" id="row_material" class="form-control @error('auditInfo.row_material') is-invalid @enderror"> </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code">Processing facilities </label></th> 
                                        <td><input type="text" name="auditInfo[processing_facilities]" id="processing_facilities" class="form-control @error('auditInfo.processing_facilities') is-invalid @enderror"> </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code"> Respect of the cold chain </label></th>
                                        <td><input type="text" name="auditInfo[respect_cold_chain]" id="respect_cold_chain" class="form-control @error('auditInfo.respect_cold_chain') is-invalid @enderror"> </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code"> Storage </label></th>
                                        <td><input type="text" name="auditInfo[storage]" class="form-control @error('auditInfo.storage') is-invalid @enderror" > </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code"> Traceability </label></th>
                                        <td><input type="text" name="auditInfo[traceability]"  class="form-control @error('auditInfo.traceability') is-invalid @enderror" > </td>
                                    </tr>
                                </tbody>
                                </table>
                                </div>  
                            </div> <!--  END Row -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane @if(Session::has('tab') && Session::get('tab')=='tab_2') active @endif" id="tab_2">
                        <form action="{{url('accountmanagement/updateCustomization')}}" onsubmit="return updateCustomization()" method="post" enctype="multipart/form-data" >
                        @csrf
                        
                        <div class="row">
                            
                            @if(Session::has('producerDetails')) 
                            <input type="hidden" name="row_id" value="{{Session::get('producerDetails')->id}}">
                            
                            @elseif(old('row_id')) 
                            <input type="hidden" name="row_id" value="{{old('row_id')}}">
                            @else
                            <input type="hidden" name="row_id" value="1">
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Producer Name</label>
                                    @if(Session::has('producerDetails')) 
                                    <p>{{ucfirst(Session::get('producerDetails')->name)}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="image">Producer Image</label>
                                @if(Session::has('producerDetails')) 
                                <img src="{{url('userImages/'.Session::get('producerDetails')->profileImage->file)}}" alt="image path not found " srcset="" style="height:100px;">
                                @endif
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <h4>Select  the discripancies in the list ( for Online QC ) & specify the rejection value and the border  value</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" name="wr_fish_online_qc" class="minimal" checked/>
                                    <label for="company">WR fish Online Qc</label>
                                    @error('company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror  
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" name="cut_fish_online_qc" class="minimal form_control" checked>
                                    <label for="email">Cut fish Online Qc</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12 table-responsive WrFishDescripancies">
                                
                            </div><!-- End  of the Wr Fish Online QC -->
                            <div class="col-md-12 table-responsive CutFishDescripancies"> <!-- Start of the Cut  Fish Online QC -->
                                
                            </div><!-- End d of the Cut  Fish Online QC -->
                        </div> <!--  END Row -->

                        <h4>Requested Item & Fish Number for each item </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-border table-striped">
                                   <thead>
                                        <tr class="info">
                                          <th><label for="company">Raw Material (Ocean Run)</label></th>  
                                          <th></th>  
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="combined_wr" class="minimal form_control allRawMaterial">
                                                <label for="">Combined WR Fish</label>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="combined_cut" class="minimal form_control">
                                                <label for="email">Combined Cut Fish</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="raw_wr_weight_is_checked" class="minimal form_control wrfish">
                                                <label for="raw_wr_weight">Weight:min</label>
                                                <input type="text" name="raw_wr_weight" class="input130">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="raw_cut_fish_weight_is_checked" class="minimal form_control">
                                                <label for="raw_cut_fish_weight">Weight:min</label>
                                                <input type="text" name="raw_cut_fish_weight" class="input130">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="raw_wr_length_is_checked" class="minimal form_control">
                                                <label for="raw_wr_length">Length:min</label>
                                                <input type="text" name="raw_wr_length" class="input130">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="raw_cut_fish_length_is_checked" class="minimal form_control">
                                                <label for="raw_cut_fish_length">Length:min</label>
                                                <input type="text" name="raw_cut_fish_length" class="input130">
                                            </td>
                                        </tr>
                                   </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-border table-striped">
                                   <thead>
                                        <tr class="info">
                                          <th><label for="company">Finished Product</label></th>  
                                          <th></th>  
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="combined_fish_wr" class="minimal form_control">
                                                <label for="company">Combined WR Fish</label>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="combined_cut_fish" class="minimal form_control">
                                                <label for="email">Combined Cut Fish</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="finished_product_wr_weight_is_checked" class="minimal form_control">
                                                <label for="finished_product_wr_weight">Weight:min</label>
                                                <input type="text" name="finished_product_wr_weight" class="input130">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="finished_product_cut_fish_weight_is_checked" class="minimal form_control">
                                                <label for="finished_product_cut_fish_weight">Weight:min</label>
                                                <input type="text" name="finished_product_cut_fish_weight" class="input130">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="finished_product_wr_length_is_checked" class="minimal form_control">
                                                <label for="finished_product_wr_length">Length:min</label>
                                                <input type="text" name="finished_product_wr_length" class="input130">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="finished_product_cut_fish_length_is_checked" class="minimal form_control">
                                                <label for="finished_product_cut_fish_length">Length:min</label>
                                                <input type="text" name="finished_product_cut_fish_length" class="input130">
                                            </td>
                                        </tr>
                                   </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->

                        <h4>Specify  the  time scale for the reminders of the tempratures checks ( fish and cold rooms ) </h4>
                        <div class="row">
                           <div class="col-md-12">
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="radio" name="temperature_ckeck_reminder_timescale" class="flat-red" checked value="1"> 
                                                <label for="vessel"> Every Day </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="radio" name="temperature_ckeck_reminder_timescale" class="flat-red" value="2">
                                                <label for="sequence"> Every Week </label>
                                            </div>
                                        </div>
                                    </div> <!--  END Row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="radio" name="temperature_ckeck_reminder_timescale" class="flat-red" value="3"> 
                                                <label for="vessel"> Every 2 Days </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="radio" name="temperature_ckeck_reminder_timescale" class="flat-red" value="4">
                                                <label for="sequence"> Every 2 Weeks </label>
                                            </div>
                                        </div>
                                    </div> <!--  END Row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="radio" name="temperature_ckeck_reminder_timescale" class="flat-red" value="5"> 
                                                <label for="vessel"> Every 4 Days </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="radio" name="temperature_ckeck_reminder_timescale" class="flat-red" value="6">
                                                <label for="sequence"> Every 3 Weeks </label>
                                            </div>
                                        </div>
                                    </div> <!--  END Row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="radio" name="temperature_ckeck_reminder_timescale" class="flat-red" value="7"> 
                                                <label for="vessel"> Custom Time Scale </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sequence"> Days </label>
                                                <input type="text" name="custom_reminder_timescale_day" onkeypress="return restrictAlphabets(event)" class="input130" >
                                            </div>
                                        </div>
                                    </div> <!--  END Row -->
                              </div>
                        </div>

                        <h4>Minimum required container set teprature</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="radio" name="minimum_temperature"  class="flat-red" value="1"> 
                                    <label> -23 &#8451; </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="radio" name="minimum_temperature"  class="flat-red" checked value="2">
                                    <label> -24 &#8451; </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="radio" name="minimum_temperature"  class="flat-red" value="3"> 
                                    <label> -25 &#8451; </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="radio" name="minimum_temperature" class="flat-red" value="4"> 
                                    <label for="vessel"> Other value </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>&#8451;</label>
                                <input type="text" name="other_minimum_temperature" onkeypress="return restrictAlphabets(event)" class="input130" >
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <h4>Continuous freezing teprature frequency control</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> 15 min </label>
                                    <input type="radio" name="continuous_freezing"  class="flat-red" value="1"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> 30 min </label>
                                    <input type="radio" name="continuous_freezing"  class="flat-red" value="2"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> 45 min </label>
                                    <input type="radio" name="continuous_freezing"  class="flat-red" checked value="3"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> 1 hour </label>
                                    <input type="radio" name="continuous_freezing"  class="flat-red" value="4"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Other Value </label>
                                    <input type="radio" name="continuous_freezing"  class="flat-red" value="5"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> hour </label>
                                    <input type="text" name="other_continuous_freezing" onkeypress="return restrictAlphabets(event)"  class="input130">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <h4> Weight Calibration - control of the frequency </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="radio" checked name="weight_calibration" id="yes" class="flat-red" value="1">
                                    <label for="yes">Yes</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <input type="radio" name="weight_calibration" id="no" class="flat-red" value="0">
                                    <label for="no"> No</label>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <h4>Control frequency </h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="radio" name="control_frequency"  class="flat-red" value="0"> 
                                    <label> Eat Lot </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="radio" name="control_frequency"  class="flat-red" value="1"> 
                                    <label> Once a day </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="radio" name="control_frequency"  class="flat-red" value="2"> 
                                    <label> Only The First Production </label>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row"> 
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <h4>Standard Drip Loss Value</h4>
                                    <div class="input-group">
                                        <div class="input-group-btn"> <!-- btn-group-vertical-->
                                            <button type="button" class="btn btn-default standard-btn-minus"><span class="glyphicon glyphicon-minus"></span></button>
                                            <input type="hidden"  name="standard_drip_loss_value" value="5.0"/>
                                            <button type="button" class="btn btn-default standard-value-lable">5 %</button>
                                            <button type="button" class="btn btn-default standard-btn-plus"><span class="glyphicon glyphicon-plus"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <h4>Standard guts weight</h4>
                                    <div class="input-group">
                                        <div class="input-group-btn"> <!-- btn-group-vertical-->
                                            <button type="button" class="btn btn-default standard-btn-minus"><span class="glyphicon glyphicon-minus"></span></button>
                                            <input type="hidden"  name="standard_guts_weight" value="8.0"/>
                                            <button type="button" class="btn btn-default standard-value-lable" >8 %</button>
                                            <button type="button" class="btn btn-default standard-btn-plus"><span class="glyphicon glyphicon-plus"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--  END Row -->
                        <h4>Cold Chain Standards</h4>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-border table-striped">
                                <thead>
                                    <tr class="info">
                                        <th></th>
                                        <th>Target Value</th>
                                        <th>Border Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><label for="code">Fishing</label></th> 
                                        <input type="hidden" name="cold_chain_standard[title][]" value="Fishing">
                                        <td><input type="text" name="cold_chain_standard[target_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                        <td><input type="text" name="cold_chain_standard[border_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code">Unloading </label></th> 
                                        <input type="hidden" name="cold_chain_standard[title][]" value="Unloading">
                                        <td><input type="text" name="cold_chain_standard[target_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                        <td><input type="text" name="cold_chain_standard[border_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code">Transport</label></th> 
                                        <input type="hidden" name="cold_chain_standard[title][]" value="Transport">
                                        <td><input type="text" name="cold_chain_standard[target_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                        <td><input type="text" name="cold_chain_standard[border_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code">Reception </label></th> 
                                        <input type="hidden" name="cold_chain_standard[title][]" value="Reception">
                                        <td><input type="text" name="cold_chain_standard[target_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                        <td><input type="text" name="cold_chain_standard[border_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code"> Production </label></th>
                                        <input type="hidden" name="cold_chain_standard[title][]" value="Production">
                                        <td><input type="text" name="cold_chain_standard[target_value][]" onkeypress="return restrictAlphabets(event)" class="form-control"> </td>
                                        <td><input type="text" name="cold_chain_standard[border_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code"> Freezing </label></th>
                                        <input type="hidden" name="cold_chain_standard[title][]" value="Freezing">
                                        <td><input type="text" name="cold_chain_standard[target_value][]"  onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                        <td><input type="text" name="cold_chain_standard[border_value][]"  onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code"> Storage </label></th>
                                        <input type="hidden" name="cold_chain_standard[title][]" value="Storage">
                                        <td><input type="text" name="cold_chain_standard[target_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                        <td><input type="text" name="cold_chain_standard[border_value][]" onkeypress="return restrictAlphabets(event)" class="form-control" > </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>  
                        </div> <!--  END Row -->
                        <button type="submit" class="btn btn-primary updateCustomizationButton">Add Customization</button>
                       </form>
                    </div><!-- /.tab-pane -->


                    <div class="tab-pane @if(Session::has('tab') && Session::get('tab')=='tab_3') active @endif" id="tab_3">
                       <form action="{{ url('accountmanagement/createSopSpecification') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            @if(Session::has('customizationSettingdata')) 
                            <input type="hidden" name="row_id" value="{{Session::get('customizationSettingdata')->id}}">
                            
                            @elseif(old('row_id')) 
                            <input type="hidden" name="row_id" value="{{old('row_id')}}">
                            @else 
                            <input type="hidden" name="row_id" value="1">
                            @endif
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Producer Name</label>
                                    @if(Session::has('customizationSettingdata')) 
                                    <p>{{ucfirst(Session::get('customizationSettingdata')->name)}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="image">Producer Image</label>
                                @if(Session::has('customizationSettingdata')) 
                                @endif
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="production_and_storage_facilities">Production & Storage Facilities</label>
                                    <textarea style="resize:none;" rows="4" name="production_and_storage_facilities" id="production_and_storage_facilities" class="form-control" ></textarea>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <h4> Acceptables Species </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table  id="scientific-table" class="table table-border table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th> </th>
                                            <th> Scientific Name</th>
                                            <th> Common Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @if(isset($getAllMasterAcceptSpecies) && count($getAllMasterAcceptSpecies))
                                @foreach($getAllMasterAcceptSpecies as $row)
                                    <tr>
                                        <td><input type="checkbox" name="acceptable_species[is_checked][]" class="minimal" ></td>
                                        <td>
                                            <input type="hidden" name="acceptable_species[acceptable_species_id][]" value="{{$row->id}}">
                                            <input type="text" name="acceptable_species[scientific_name][]" value="{{$row->scientific_name}}" class="form-control" /> 
                                        </td>
                                        <td>
                                            <input type="text" name="acceptable_species[common_name][]" value="{{$row->common_name}}" class="form-control" /> 
                                        </td>
                                    </tr>
                                @endforeach
                                @endif  
                                    </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <div class="col-md-12">
                            <div class="new_rows_button">
                                <a href="javascript:void(0)" data-table="scientific" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <h4> Fresh Fish Organoleptic Test </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="organoleptic-table" class="table table-border table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th> Focus </th>
                                            <th> Quality Parameter </th>
                                            <th> Target </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" name="fresh_fish_test[focus][]" value="Skin" class="form-control"></td>
                                        <td><input type="text" name="fresh_fish_test[quality_parameter][]" value="Visual Aspect" class="form-control" ></td>
                                        <td><input type="text" name="fresh_fish_test[target][]" value="Bright,Shining" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="fresh_fish_test[focus][]" value="Gill Cover" class="form-control"></td>
                                        <td><input type="text" name="fresh_fish_test[quality_parameter][]" value="Bloodspot" class="form-control" ></td>
                                        <td><input type="text" name="fresh_fish_test[target][]" value="None" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="fresh_fish_test[focus][]" value="Belly" class="form-control"></td>
                                        <td><input type="text" name="fresh_fish_test[quality_parameter][]" value="Resistence" class="form-control" ></td>
                                        <td><input type="text" name="fresh_fish_test[target][]" value="Strong" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="fresh_fish_test[focus][]" value="Flesh" class="form-control"></td>
                                        <td><input type="text" name="fresh_fish_test[quality_parameter][]" value="Texture Smell" class="form-control"></td>
                                        <td><input type="text" name="fresh_fish_test[target][]" value="firm,fresh,seaweed/metallic" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="fresh_fish_test[focus][]" value="Eyes" class="form-control"></td>
                                        <td><input type="text" name="fresh_fish_test[quality_parameter][]" value="Clearity Shape" class="form-control" ></td>
                                        <td><input type="text" name="fresh_fish_test[target][]" value="Clear Convex" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="fresh_fish_test[focus][]" value="Grills" class="form-control"></td>
                                        <td><input type="text" name="fresh_fish_test[quality_parameter][]" value="Color Smell" class="form-control"></td>
                                        <td><input type="text" name="fresh_fish_test[target][]" value="Charatestics bright red, fresh seaweed/metallic" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="fresh_fish_test[focus][]" value="Parasites" class="form-control"></td>
                                        <td><input type="text" name="fresh_fish_test[quality_parameter][]" value="Presence of parasites" class="form-control"></td>
                                        <td><input type="text" name="fresh_fish_test[target][]" value="0% Prevalence" class="form-control"  ></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <div class="col-md-12">
                            <div class="new_rows_button">
                                <a href="javascript:void(0)" data-table="organoleptic" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <h4> Fish Cut </h4>
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-border table-striped">
                                    <thead>
                                        <tr class="info">
                                         <td></td>
                                         <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                           <input type="checkbox" name="hgt_fish_cut_checkbox" class="minimal">
                                           <label>H&G-T Cut </label> 
                                        </td>
                                        <td>
                                            <label>Update Files</label>
                                            <input type="file" name="hgt_fish_cut" class="form-control"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <input type="checkbox" name="hg_fish_cut_checkbox"  class="minimal">  
                                           <label>H&G Cut </label> 
                                        </td>
                                        <td>
                                            <label>Update Files</label>
                                            <input type="file" name="hg_fish_cut" class="form-control"/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div> <!--  END Row -->
                        <h4>Weight & Length Specification</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table spec-table table-border table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($getAllSpecTypes) && count($getAllSpecTypes))
                                        @foreach($getAllSpecTypes as $key=>$row)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" data-specCount="{{$key}}" name="length_width_specification[{{$key}}][is_checked][]"  @if($row->is_checked) checked @endif  class="minimal spectype_checkbox" value="1">  
                                                    <input type="hidden" name="length_width_specification[{{$key}}][id][]"  class="specTypeId" value="{{$row->id}}">
                                                    <input type="hidden" name="length_width_specification[{{$key}}][name][]" value="{{$row->name}}">
                                                    <input type="hidden" name="length_width_specification[{{$key}}][type][]"  value="{{$row->type}}">
                                                    <label id="sardine_specs">{{$row->name}}</label>
                                                    <div class="listing">
                                                    </div>
                                                </td>
                                                

                                            </tr>
                                        @endforeach
                                    @endif 
                                    
                                    </tbody>
                                    <tfoot>
                                     <tr>
                                       <th><label for="makeral_species"><a href="javascript:void(0)"  class="add-new-row btn btn-xs btn-info add-spec-btn"><i class="fa fa-plus"></i> </a> Add A Species </label></th>
                                     </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div> <!--  END Row -->

                        <h4>Chemical Criteria</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="chemical_creteria-table" class="table table-border table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th>Chemical Criateria</th> 
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="chemical_criterias[id][]"  value="NULL">
                                           <input type="text" name="chemical_criterias[title][]"  value="Fat Level" class="form-control">
                                        </td>
                                        <td>
                                           <input type="text" name="chemical_criterias[description][]" class="form-control"   />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="chemical_criterias[id][]"  value="NULL">
                                           <input type="text" name="chemical_criterias[title][]"  value="Histamine" class="form-control">
                                        </td>
                                        <td> 
                                           <input type="text" name="chemical_criterias[description][]" class="form-control" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> 
                                            <input type="hidden" name="chemical_criterias[id][]"  value="NULL">
                                            <input type="text" name="chemical_criterias[title][]"  value="Domoic Acid" class="form-control">
                                        </td>
                                        <td>
                                           <input type="text" name="chemical_criterias[description][]" class="form-control"  />
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <div class="col-md-12">
                            <div class="new_rows_button">
                                <a href="javascript:void(0)" data-table="chemical_creteria" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <h4>Heavy Metals</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="heavy_metal-table" class="table table-border table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th>Heavy Metals</th> 
                                            <th>Mark</th>
                                            <th>Max limit ppm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="heavy_metals[id][]" value="NULL"/>
                                           <input type="text" name="heavy_metals[name][]" class="form-control" value="Mercury" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[mark][]" class="form-control" value="Hg"/>
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[max_limit_ppm][]" class="form-control" value="0.4"/>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                           <input type="hidden" name="heavy_metals[id][]" value="NULL"/>
                                           <input type="text" name="heavy_metals[name][]" class="form-control" value="Lead" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[mark][]" class="form-control" value="Pb" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[max_limit_ppm][]" class="form-control" value="0.3" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="heavy_metals[id][]" value="NULL"/>
                                           <input type="text" name="heavy_metals[name][]" class="form-control" value="Arsenic" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[mark][]" class="form-control" value="As"/>
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[max_limit_ppm][]" class="form-control" value="0.1" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="heavy_metals[id][]" value="NULL"/>
                                           <input type="text" name="heavy_metals[name][]" class="form-control" value="Cadmium" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[mark][]" class="form-control" value="Cd" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[max_limit_ppm][]" class="form-control" value="0.1" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="heavy_metals[id][]" value="NULL"/>
                                           <input type="text" name="heavy_metals[name][]" class="form-control" value="Copper" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[mark][]" class="form-control" value="Cu"/>
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[max_limit_ppm][]" class="form-control" value="20"  />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="heavy_metals[id][]" value="NULL"/>
                                           <input type="text" name="heavy_metals[name][]" class="form-control" value="Tin" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[mark][]" class="form-control" value="Sn"/>
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[max_limit_ppm][]" class="form-control" value="40" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="heavy_metals[id][]" value="NULL"/>
                                           <input type="text" name="heavy_metals[name][]" class="form-control" value="Zink" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[mark][]" class="form-control" value="Zn"/>
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[max_limit_ppm][]" class="form-control" value="50"  />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="heavy_metals[id][]" value="NULL"/>
                                           <input type="text" name="heavy_metals[name][]" class="form-control" value="Antimony" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[mark][]" class="form-control" value="Sb"/>
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[max_limit_ppm][]" class="form-control" value="1" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="heavy_metals[id][]" value="NULL"/>
                                           <input type="text" name="heavy_metals[name][]" class="form-control" value="Selenium" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[mark][]" class="form-control" value="Se" />
                                        </td>
                                        <td>
                                           <input type="text" name="heavy_metals[max_limit_ppm][]" class="form-control" value="1"  />
                                        </td>
                                    </tr>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <div class="col-md-12">
                            <div class="new_rows_button">
                                <a href="javascript:void(0)" data-table="heavy_metal" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <h4>Microbiological Criteria</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="microbiological-table" class="table table-border table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th>Germs</th> 
                                            <th>n</th>
                                            <th>c</th>
                                            <th>m</th>
                                            <th>M</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="microbiological_criterias[id][]" class="form-control"   />
                                           <input type="text" name="microbiological_criterias[germs][]" value="Escherichia" class="form-control"  />
                                        </td>
                                        <td>
                                           <input type="text" name="microbiological_criterias[c][]" value="5" class="form-control" />
                                        </td>
                                        <td>
                                           <input type="text" name="microbiological_criterias[n][]" value="1"  class="form-control" />
                                        </td>
                                        <td>
                                           <input type="text" name="microbiological_criterias[nm][]" value="10 UFC/g"  class="form-control" />
                                        </td>
                                        <td>
                                           <input type="text" name="microbiological_criterias[cm][]" value="100 UFC/g"  class="form-control"  />
                                        </td>
                                    </tr>
                                   
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="new_rows_button">
                                    <a href="javascript:void(0)" data-table="microbiological" class="add-new-row btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <h4>Specification & Sop's Files</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Add A Document <small>( select multiple file )</small> </label>
                                    <input type="file" name="sop_file" id="sop_file" multiple>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div><!--  END Row -->
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add Sop's</button>
                                </div>
                            </div>
                        </div>
                          
                </div><!-- nav-tabs-custom -->
                </form>
                </div><!-- /.col -->
            </div>
    </section>
</div> 

<!-- Modal -->
<div class="modal fade" id="AddSpecType_Modal" role="dialog">
        <div class="modal-dialog modal-xs">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"> New Spec Type </h4>
            </div>
            <form action="javascript:void(0)" id="AddSpecTypeForm" method="post">
            {{ csrf_field() }}
              <div class="modal-body">
              <div class="row">
                <div class="col-md-12 ajaxError">
                </div>
              </div>
              <div class="row">
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                   </div>
                   <div class="col-md-6">
                       <div class="form-group" style="margin-top:30px;">
                            <button type="submit" class="btn btn-sm btn-block btn-primary">Create New Spec Type</button>
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
                            <input type="text" name="name" id="name" class="form-control">
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
    <div class="modal fade" id="AddNewCity_Modal" role="dialog">
        <div class="modal-dialog modal-xs">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add New City </h4>
            </div>
            <form action="javascript:void(0)" id="AddNewCityForm" method="post">
            {{ csrf_field() }}
              <div class="modal-body">
              <div class="row">
                <div class="col-md-12 ajaxError">
                </div>
              </div>
              <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                            <label for="country_id"> Select Country</label>
                            <select name="country_id" id="country_id" value="{{old('country_id')}}" class="form-control @error('country_id') is-invalid @enderror getCitiesByAjax">
                                <option value="">-- Select Country --</option>
                                @if(isset($getAllCountries) && count($getAllCountries))
                                    @foreach($getAllCountries as $country)
                                        <option value="{{$country->id}}" @if(old('country')==$country->id) selected  @endif >{{$country->name}}</option>
                                    @endforeach
                                @endif 
                            </select>
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="city_name">City Name</label>
                            <input type="text" name="city_name" id="city_name"  class="form-control @error('city_name') is-invalid @enderror getCitiesByAjax">
                        </div>
                   </div>
              </div>
              <div class="row">
                   <div class="col-md-6">
                        <div class="form-group" style="margin-top:30px;">
                            <button type="submit" class="btn btn-sm btn-block btn-primary">Create New City</button>
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

$( document ).ready(function() {
//  $(function(){
        $('.getCitiesByAjax').change(function(){
            var Id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{url('accountmanagement/getCitiesByCountryId')}}",
                data: {"countryId":Id,"_token":"{{ csrf_token() }}"},
                beforeSend: function() {
                    //$('.getCitiesByAjax').html('<option><i class="fa fa-spinner fa-spin"></i></option>');
                },
                success: function(result){
                    if(result!=""){
                        $('#city').html(result);
                    }
                }
            });
        }); 

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
       
          
        
        $('#tutorial').find('tr').each(function(){
                $(this).find('td').eq(n).after('<td>new cell added</td>');
        });

        
        $('.standard-btn-minus').click(function(e){ 
            var $parent = $(this).parent(); 
            var offsetlabel = $.trim($parent.find('.standard-value-lable').text().split(' ')[0]);
            offsetlabel = (parseFloat(offsetlabel)-0.1).toFixed(1); 
            $parent.find('input[type=hidden]').val(offsetlabel);
            $parent.find('.standard-value-lable').html(offsetlabel+' %');
        });
        $('.standard-btn-plus').click(function(e){ 
            var $parent = $(this).parent(); 
            var offsetlabel = $.trim($parent.find('.standard-value-lable').text().split(' ')[0]);
            offsetlabel = (parseFloat(offsetlabel)+0.1).toFixed(1); 
            $parent.find('input[type=hidden]').val(offsetlabel);
            $parent.find('.standard-value-lable').html(offsetlabel+' %');
        });

        $(document).on('click','.length-width-btn-minus',function(e){
            var $parent = $(this).parent();
            var offsetlabel  = $parent.find('.length-width-offset-label').text();
            offsetlabel = (parseFloat(offsetlabel)-0.1).toFixed(1);
            if(offsetlabel >= 0){
                $parent.find('.length-width-offset-label').text(offsetlabel);
                $parent.find('.length-width-offset-value').val(offsetlabel);
            }
        });
        $(document).on('click','.length-width-btn-plus',function(e){
            var $parent = $(this).parent();
            var offsetlabel  = $parent.find('.length-width-offset-label').text();
            offsetlabel = (parseFloat(offsetlabel)+0.1).toFixed(1);
            $parent.find('.length-width-offset-label').text(offsetlabel);
            $parent.find('.length-width-offset-value').val(offsetlabel);
        });

        $('#audit_date').datepicker({
            format: "yyyy-mm-dd",
            // endDate: new Date(), 
            autoclose: true
        });

        
       
        

        var selectdata = document.getElementsByName('row_id');
        if(selectdata.length){
            var producerId = selectdata[0].value;
            if(producerId){
                if($('input[type=checkbox][name=wr_fish_online_qc]').prop('checked')){
                    getWrFishDescripancies(producerId);
                }
                if($('input[type=checkbox][name=cut_fish_online_qc]').prop('checked')){
                    getCutFishDescripancies(producerId);
                }
                
                $('.spectype_checkbox').each(function(e){
                    // console.log($(this).prop('checked'))
                    var parent = $(this).parent();
                    if(selectdata.length){
                        var producerId = selectdata[0].value;
                        var SpecTypeId = parent.parent().find('.specTypeId').val();
                        if($(this).prop('checked') && SpecTypeId){
                            $.ajax({
                                type: "GET",
                                url: "{{url('accountmanagement/getLengthWidthSpecies')}}",
                                data: {"row_id":producerId,"SpecTypeId":SpecTypeId,"_token":"{{ csrf_token() }}"},
                                success: function(result){
                                    parent.parent().find('.listing').html(result);
                                }
                            });
                        }
                        else{
                            parent.parent().find('.listing').html("");
                        }
                    }
                });
            }
        }
        $(document).on('ifChanged', '.spectype_checkbox', function() {
            //console.log("hi Pradeep")
            var parent = $(this).parent();
            if(selectdata.length){
                var producerId = selectdata[0].value;
                var SpecTypeId = parent.parent().find('.specTypeId').val();
                var SpecCount= parent.parent().find('input[type=checkbox]').attr('data-specCount')?parent.parent().find('input[type=checkbox]').attr('data-specCount'):parent.parent().find('input[type=checkbox]').data("specCount");
                

                console.log("SpecCount")
                console.log(SpecCount)

                if($(this).prop('checked') && SpecTypeId){
                    $.ajax({
                        type: "GET",
                        url: "{{url('accountmanagement/getLengthWidthSpecies')}}",
                        data: {"row_id":producerId,"SpecTypeId":SpecTypeId,"specCount":SpecCount,"_token":"{{ csrf_token() }}"},
                        success: function(result){
                            parent.parent().find('.listing').html(result);
                        }
                    });
                }
                else{
                    parent.parent().find('.listing').html("");
                }
            }
            // console.log($(this).parent().parent().find('.listing').html('<div class="text-danger">Hello  Pradeep how  are are You  ? </div>'))
        });
        
 });
 
 function  updateCustomization(){
    $('.updateCustomizationButton').prop('disabled',true);
    return true; 
 }

 
 function getWrFishDescripancies(producerId){
    // alert("getWrFishDescripancies "+producerId);
    $.ajax({
            type: "GET",
            url: "{{url('accountmanagement/getWrFishDescripancies')}}",
            data: {"row_id":producerId,"_token":"{{ csrf_token() }}"},
            success: function(result){
                // console.log(result)
                $('.WrFishDescripancies').html(result);
            }
        });
 }
 function getCutFishDescripancies(producerId){
    //  alert("getCutFishDescripancies "+producerId); 
        $.ajax({
            type: "GET",
            url: "{{url('accountmanagement/getCutFishDescripancies')}}",
            data: {"row_id":producerId,"_token":"{{ csrf_token() }}"},
            success: function(result){
                // console.log(result)
                $('.CutFishDescripancies').html(result);
            }
        });
 }

/** Add new city */
        $('.add-new-city').click(function(){
            $('#AddNewCityForm .ajaxError').html("");
            $("#city_name").removeClass('is-invalid'); 
            $('#AddNewCity_Modal').modal('toggle');
        });

        
    $('#AddNewCityForm').submit(function(e) { 
        e.preventDefault();
        var country_id = $('#country_id').val();
		var city_name = $('#city_name').val();
		
        $.ajax({
            type: "POST",
            url: '{{ url("accountmanagement/createCity") }}', 
            data: {'country_id': country_id, 'name': city_name, '_token':'{{csrf_token()}}'},
            success: function(response) {
                $('#country_id').val('');
                $('#country').val('');
                $('#city_name').val('');
                $('#AddNewCity_Modal').modal('toggle');
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
        
 /**

  * 
  * Add New Spec Type 
 */
        $('.add-spec-btn').click(function(){
            $('#AddSpecTypeForm .ajaxError').html("");
            $("#name").removeClass('is-invalid'); 
            $('#AddSpecType_Modal').modal('toggle');
        }); 
        $('#AddSpecTypeForm').submit(function(e){
            e.preventDefault();
            
            if($("#name").val()){
                $('#AddSpecTypeForm .ajaxError').html("");
                $("#name").removeClass('is-invalid');
                var producerId = $('input[name=row_id]').val();
                var Spec = $('#AddSpecTypeForm #name').val();
                $result = createSpectype(producerId,Spec);
                console.log('last');
            }  
            else{
                $('#AddSpecTypeForm .ajaxError').html('<span style="color: red;">Spec Name fields is required </span>'); 
                $("#name").addClass('is-invalid'); 
            }
        }); 
        function createSpectype(producerId,Spec){
            $.ajax({
                type : "POST",
                url  : "{{url('accountmanagement/saveSpecType')}}",
                data : {'producer_id':producerId,'name':Spec,'_token':'{{csrf_token()}}'},
                success : function(response){
                    console.log(response) 
                    console.log(response.message)
                    console.log('count')
                    console.log(response.count)
                    console.log('createdData')
                    console.log(response.createdData)
                    

                    $('table.spec-table tbody').append(`<tr>
                                                <td>
                                                    <input type="checkbox" name="length_width_specification[`+response.count+`][is_checked][]"   class="minimal spectype_checkbox" value="1">  
                                                    <input type="hidden" name="length_width_specification[`+response.count+`][id][]"  class="specTypeId" value="`+response.createdData.id+`">
                                                    <input type="hidden" name="length_width_specification[`+response.count+`][name][]" value="`+Spec+`">
                                                    <input type="hidden" name="length_width_specification[`+response.count+`][type][]"  value="`+response.createdData.type+`">
                                                    <label id="sardine_specs">`+Spec+`</label>
                                                    <div class="listing">
                                                    </div>
                                                </td>
                                            </tr>`);
                    // $('table.spec-table tbody').append('<tr><td><input type="checkbox" class="minimal"/> <label for="makeral">'+Spec+'</label> </td></tr>');
                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue',
                        radioClass: 'iradio_minimal-blue'
                    });
                    $('#AddSpecTypeForm')[0].reset();
                    $('#AddSpecType_Modal').modal('toggle');
                },
                error : function(response){
                    console.log(response)
                    if (response.status == 422) { // when status code is 422, it's a validation issue
                        console.log(response.responseJSON);
                        // console.log(response.responseJSON.message)
                        // you can loop through the errors object and show it to the user
                        console.warn(response.responseJSON.errors);
                        // display errors on each form field
                        $.each(response.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="'+i+'"]');
                            //el.after($('<span style="color: red;">'+error[0]+'</span>'));
                            $('#AddSpecTypeForm .ajaxError').html('<span style="color: red;">'+error[0]+'</span>'); 
                            //$("#name").addClass('is-invalid');
                            el.addClass('is-invalid'); 
                        });
                    }
                }
            })
        }
/**
  * 
  * End New Spec Type 
 */

    $('.allRawMaterial').on('ifChanged', function(event){
        $(this).on('ifChecked', function (event){    
            $('.producersCheckboxes').iCheck('check');   
        });
        $(this).on('ifUnchecked', function (event) {
            $('.producersCheckboxes').iCheck('uncheck');   
        });
    });

</script>


@endsection