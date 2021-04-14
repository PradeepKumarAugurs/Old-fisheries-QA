@extends('layouts.app')
@section('title') <title>AccountManagement </title> 
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">Account Management  </h2>
            <div class="row">
                <div class="messageDiv">
                </div>
                <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Basic Information</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Genral Information</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Access</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Customization</a></li>
                    <li><a href="#tab_5" data-toggle="tab">Specification & Sop</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <form action="javascript:void(0)" id="basicInfoForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                                <label for="type" > Type </label>
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-6">
                                        <div class="form-group">
                                            <p><input @if($user->role=='2') checked @endif  type="radio" name="role" value="2" class="flat-red" /> Supplier</p>
                                            <p><input @if($user->role=='3') checked @endif type="radio" name="role" value="3" class="flat-red" /> Producer</p>
                                            <p><input @if($user->role=='4') checked @endif type="radio" name="role" value="4" class="flat-red" /> Supplier & Producer</p>
                                            <p><input @if($user->role=='1') checked @endif type="radio" name="role" value="1" class="flat-red" /> Admin</p>
                                            <p><input @if($user->role=='5') checked @endif type="radio" name="role" value="5" class="flat-red" /> Inspector</p>
                                            <p><input @if($user->role=='6') checked @endif type="radio" name="role" value="6" class="flat-red" /> New User</p>
                                            <p><input @if($user->role=='7') checked @endif type="radio" name="role" value="7" class="flat-red" /> Other</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                            <p><input @if($user->type=='1') checked @endif  type="radio" name="type" value="1" class="flat-red" /> Internal</p>
                                            <p><input @if($user->type=='2') checked @endif type="radio" name="type" value="2" class="flat-red" /> External</p>
                                       </div>
                                     </div>
                                 </div>
                                 <div class="capacityDiv">
                                     @if($user->role=='3' ||  $user->role=='4' )
                                        <div class="form-group">
                                            <label for="production_capacity">Production Capacity</label>
                                            <input type="text" name="production_capacity" value="{{$user->production_capacity}}" id="production_capacity" class="form-control" placeholder="Enter Company">
                                        </div>
                                        <div class="form-group">
                                            <label for="storage_capacity">Storage Capacity</label>
                                            <input type="text" name="storage_capacity" value="{{$user->storage_capacity}}" id="storage_capacity" class="form-control" placeholder="Enter Company">
                                        </div>
                                     @endif 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" value="{{$user->company}}" id="company" class="form-control" placeholder="Enter Company">
                                </div>
                                

                                <div class="form-group fishingDiv">
                                    @if($user->boat_contract && $user->boat_owner)
                                     <label for="company">Fishing</label>
                                     <p><input type="checkbox" id="boat_contract" value="1" name="boat_contract" @if($user->boat_contract=='1') checked @endif  class="minimal" /> Contract with boat(s) &nbsp;&nbsp;&nbsp;<input type="text" name="boat_contract_capacity" id="boat_contract_capacity" value="{{$user->boat_contract_capacity}}" class="custom-form-control" placehoder="specify the capacity" ></p>
                                     <p><input type="checkbox" id="boat_owner" value="1"  name="boat_owner" @if($user->boat_owner=='1') checked @endif class="minimal" /> Boat(s) owner  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<input type="text" name="boat_owner_capacity" id="boat_owner_capacity" value="{{$user->boat_owner_capacity}}" class="custom-form-control" placehoder="specify the capacity"> </p>
                                    @endif 
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company">Logo</label>
                                            <input type="file" name="logo"  id="logo" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @if($user->logo!=NULL)
                                             <img src="{{ asset('storage/app/logos/'.$user->logo) }}" alt="" style="width:100px; height:100px;">
                                            @endif  
                                        </div>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        
                      </form>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_2">
                        <form action="" class="form-group">
                          <div class="row">
                             <div class="col-md-6">
                                    <label for="is_leader" > Leader Status </label>
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-offset-1 col-md-10 ">
                                            <label><input @if($user->role=='2') checked @endif  type="radio" name="is_leader" value="1" class="flat-red" /> Yes
                                            <input @if($user->role=='3') checked @endif type="radio" name="is_leader" value="0" class="flat-red" /> No </label>
                                        </div>
                                    </div> <!--End of the row -->
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <select name="username" id="username" class="form-control">
                                        @if(isset($getAllLeader))
                                           @foreach($getAllLeader as $row)
                                            <option value="{{$row->id}}" data-email="{{$row->email}}" data-phone="{{$row->mobile_no}}">{{$row->username}}</option>
                                           @endforeach
                                        @endif
                                        </select>
                                    </div>
                                    
                             </div>
                             <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone">
                                    </div>
                              
                             </div>
                          </div>
                          <div class="row">
                          
                            <div class="col-md-12 ">
                              <label for="heading">Organisation and Categorization : </label>
                              @if(isset($getGenralInfo->categorization) && !empty($getGenralInfo->categorization))
                                 @foreach($getGenralInfo->categorization as $key=>$referenceCountry)
                                 <ul class="listUnstyled categorizationList">
                                        <li>  
                                                <label for="reference_countries">Reference Country #{{$key+1}}</label>
                                                <select name="username" id="username" class="custom-form-control" >
                                                @if(isset($allCountries) && count($allCountries))
                                                <option value="">--Select Country--</option>
                                                @foreach($allCountries as $country) 
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                                @endif
                                                </select>
                                            @if(isset($referenceCountry->zones)  && !empty($referenceCountry->zones))
                                            <ul class="listUnstyled zoneList">
                                               
                                                  @foreach($referenceCountry->zones as $zoneKey=>$zones)
                                                  <li> <label for="">Zone #{{$zoneKey+1}}</label> <input type="text" name="" id=""> </li>
                                                  @endforeach
                                               
                                                  <a  href="javascript:void(0)" class="btn btn-xs btn-primary">+ Zone</a> 
                                            </ul>
                                            @else 
                                            No Zones {{$referenceCountry->zones}}
                                            @endif 
                                            @if(isset($referenceCountry->suppliers)  && !empty($referenceCountry->suppliers))
                                            <ul class="listUnstyled supplierList">
                                               @foreach($referenceCountry->suppliers as $supplierKey=>$supplier)
                                                <li><label for="">Supplier #{{$supplierKey+1}} </label> <input type="text" name="" id="">
                                                    @if(isset($supplier->producers) && !empty($supplier->producers))
                                                        <ul class="listUnstyled producerList">
                                                            @foreach($supplier->producers as $producerKey=>$producer)
                                                             <li><label for="">Producer #{{$producerKey+1}} </label> <input type="text" name="" id=""></li>
                                                            @endforeach
                                                            
                                                        </ul>
                                                        <a href="javascript:void(0)"  class="btn btn-xs btn-primary">+ Producer</a> 
                                                    @endif 
                                                </li>
                                                @endforeach
                                                <a href="javascript:void(0)"  class="btn btn-xs btn-primary">+ Supplier</a> 
                                            </ul>
                                            @endif



                                        </li> <!-- End of first  country -->
                                        
                                        
                                        
                                    </ul>
                                 @endforeach
                                 <a href="javascript:void(0)"  class="btn btn-xs btn-primary">+ Reference Country</a> 
                                    
                               
                              @else 
                                  Nothing 
                              @endif 
                                
                            </div>
                          </div> <!--  END of the  row -->

                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        <form action="" class="form-group">
                            Tab 3 for Access 
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_4">
                        <form action="#" class="form-group" method="post">
                           <label>Select descripancies in the list (for online QC) and specify the  rejection value and the border value </label>
                           <div class="form-group">
                                <label><input type="checkbox" class="minimal" checked> Wr Fish </label>
                                <label><input type="checkbox" class="minimal"> Cut Fish </label>
                            </div>
                           <div class="row">
                             <div class="col-md-12">
                             <table class="table table-border table-hover">
                              <thead>
                               <tr class="bg-primary">
                                <th class="text-center" >Descripancies</th>
                                <th class="text-center" >Rejection Value / Master value <span class="text-danger">offset</span></th>
                                <th class="text-center" >Border Value / Master value <span class="text-danger">offset</span></th>
                               </tr>
                              </thead>
                              <tbody>
                               <tr class="text-center" >
                                <td><input type="checkbox" class="minimal" checked> <span>Mechanical Damage</span></td>
                                <td>
                                      <input type="text" class="input_border_none input25" name="" id="" value="100"/>% &nbsp;
                                    <input type="button" class="decrease-btn increse_decrese_button" value="-">
                                      <input type="text" class="input_border_none input25" name="" id="" value="0">
                                    <input type="button" class="increase-btn increse_decrese_button" value="+">
                                </td>
                                <td>
                                      <input type="text" class="input_border_none input25" name="" id="" value="100"/>% &nbsp;
                                    <input type="button" class="decrease-btn increse_decrese_button" value="-">
                                      <input type="text" class="input_border_none input25" name="" id="" value="0">
                                    <input type="button" class="increase-btn increse_decrese_button" value="+">
                                </td>
                               </tr>
                               <tr class="text-center" >
                                <td><input type="checkbox" class="minimal" checked> <span>Mechanical Damage</span></td>
                                <td>
                                      <input type="text" class="input_border_none input25" name="" id="" value="100"/>% &nbsp;
                                    <input type="button" class="decrease-btn increse_decrese_button" value="-">
                                      <input type="text" class="input_border_none input25" name="" id="" value="0">
                                    <input type="button" class="increase-btn increse_decrese_button" value="+">
                                </td>
                                <td>
                                    <input type="text" class="input_border_none input25" name="" id="" value="100"/>% &nbsp;
                                    <input type="button" class="decrease-btn increse_decrese_button" value="-">
                                    <input type="text" class="input_border_none input25" name="" id="" value="0">
                                    <input type="button" class="increase-btn increse_decrese_button" value="+">
                                </td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                            </div>
                            <label>Requested itmes and fish number for each items</label>
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <span>Raw Material ( Ocean Run )</span>
                                    <table class="table table-border  table-striped table-hover table-condensed ">
                                    <thead>
                                    <tr class="bg-secondary">
                                        <th class="text-center" ><input type="checkbox" class="minimal" name="" id=""> <sup>combined</sup> Wr Fish</th>
                                        <th class="text-center" ><input type="checkbox" class="minimal" name="" id=""> <sup>combined</sup> Cut Fish</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="minimal" name="" id=""> Weight:Min <input type="text" class="input25" name="" id="" value="0"></td>
                                            <td><input type="checkbox" class="minimal" name="" id=""> Weight:Min <input type="text" class="input25" name="" id="" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="minimal" name="" id=""> Length:Min <input type="text" class="input25" name="" id="" value="0"></td>
                                            <td><input type="checkbox" class="minimal" name="" id=""> Length:Min <input type="text" class="input25" name="" id="" value="0"></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6 text-center">
                                    <span>Finished Product</span>
                                    <table class="table table-border  table-striped table-hover table-condensed ">
                                    <thead>
                                    <tr class="bg-secondary">
                                        <th class="text-center" ><input type="checkbox" class="minimal" name="" id=""> <sup>combined</sup> Wr Fish</th>
                                        <th class="text-center" ><input type="checkbox" class="minimal" name="" id=""> <sup>combined</sup> Cut Fish</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="minimal" name="" id=""> Weight:Min <input type="text" class="input25" name="" id="" value="0"></td>
                                            <td><input type="checkbox" class="minimal" name="" id=""> Weight:Min <input type="text" class="input25" name="" id="" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="minimal" name="" id=""> Length:Min <input type="text" class="input25" name="" id="" value="0"></td>
                                            <td><input type="checkbox" class="minimal" name="" id=""> Length:Min <input type="text" class="input25" name="" id="" value="0"></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div> <!-- End of the row -->
                            <label>Specify the timescale for the reminders of the tempratures checkes ( fish and cold rooms )</label>
                            <div class="row">
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="timescale" id=""> Every Day</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="timescale" id=""> Every Week</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="timescale" id=""> Every 2 Days</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="timescale" id=""> Every 2 Weeks</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="timescale" id=""> Every 4 Days</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="timescale" id=""> Every 3 Weeks</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" checked name="timescale" id=""> Custom Time Scale</div>
                                <div class="col-md-4"> <input type="text"  name="" id="" class="form-control" placeholder="Enter a value"></div>
                            </div><!-- End  of  the row -->
                            <label>Minimum required container set  temprature</label>
                            <div class="row">
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="" id=""> -23&#8451;</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="" id=""> -24&#8451;</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="" id=""> -25&#8451;</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" checked name="" id=""> Other Value</div>
                                <div class="col-md-4"> <input type="text"  name="" id="" class="form-control" placeholder="Enter a value"></div>
                            </div><!-- End of  the row -->
                            <label>Continuous freezing teprature frequency control</label>
                            <div class="row">
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="" id=""> 15 Min</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="" id=""> 30 Min</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="" id=""> 45 Min</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" name="" id=""> 1 Hour</div>
                                <div class="col-md-4"> <input type="radio" class="flat-red" checked name="" id=""> Other Value</div>
                                <div class="col-md-4"> <input type="text"  name="" id="" class="form-control" placeholder="Enter a value"></div>
                            </div><!-- End of  the row -->
                            <div class="row">
                                <div class="col-md-offset-6 col-md-6">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_5">
                        <form action="" class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Production and Storage Capacities</label>
                                        <textarea  style="resize:none" name="" id="" rows="3" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Acceptable Species</label>
                                        <table class="table table-border table-hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Scientific Name</th>
                                                    <th>Common Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="checkbox" name="" id="" class="minimal" checked/></td>
                                                    <td><input type="text" name="" class="form-control input170" id="" value="Sardinops Melanosticus"></td>
                                                    <td><input type="text" name="" class="form-control input170" id="" value="Japanese Pilchard"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox" name="" id="" class="minimal" checked/></td>
                                                    <td><input type="text" name="" class="form-control input170" id="" value="Sardinops Melanosticus"></td>
                                                    <td><input type="text" name="" class="form-control input170" id="" value="Japanese Pilchard"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="checkbox" name="" id="" class="minimal" checked/></td>
                                                    <td><input type="text" name="" class="form-control input170" id="" value="Sardinops Melanosticus"></td>
                                                    <td><input type="text" name="" class="form-control input170" id="" value="Japanese Pilchard"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fresh Fish Organoleptic Test</label>
                                            <table class="table table-border table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Focus</th>
                                                        <th>Quality Parameter</th>
                                                        <th>Target</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" name="" class="form-control input130" id="" value="Skin"></td>
                                                        <td><input type="text" name="" class="form-control input130" id="" value="Visual Aspects"></td>
                                                        <td><input type="text" name="" class="form-control input130" id="" value="bright,shining"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="" class="form-control input130" id="" value="Skin"></td>
                                                        <td><input type="text" name="" class="form-control input130" id="" value="Visual Aspects"></td>
                                                        <td><input type="text" name="" class="form-control input130" id="" value="bright,shining"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="" class="form-control input130" id="" value="Skin"></td>
                                                        <td><input type="text" name="" class="form-control input130" id="" value="Visual Aspects"></td>
                                                        <td><input type="text" name="" class="form-control input130" id="" value="bright,shining"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">h&G-T Cut </label>
                                                    <input type="file" name="" id="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">h&G Cut </label>
                                                    <input type="file" name="" id="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
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


        $('input[name=role]').on('ifChecked', function(event){
             var fishingHtml='<label for="company">Fishing</label><p><input type="checkbox" value="1" id="boat_contract" name="boat_contract"   class="minimal" />\
              Contract with boat(s) &nbsp;&nbsp;&nbsp;\
              <input type="text" name="boat_contract_capacity" id="boat_contract_capacity"  class="custom-form-control" placehoder="specify the capacity" ></p>\
                                  <p><input type="checkbox" value="1" id="boat_owner"  name="boat_owner"  class="minimal" /> Boat(s) owner  \
                                  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;\
                                  <input type="text" name="boat_owner_capacity" id="boat_owner_capacity"  class="custom-form-control" placehoder="specify the capacity"> </p>';
            var capacityHtml='<div class="form-group">\
                                            <label for="production_capacity">Production Capacity</label>\
                                            <input type="text" name="production_capacity" id="production_capacity" class="form-control" placeholder="Enter Production Capacity">\
                                        </div><div class="form-group"><label for="storage_capacity">Storage Capacity</label>\
                                            <input type="text" name="storage_capacity" value="{{$user->storage_capacity}}" id="storage_capacity" class="form-control" placeholder="Enter Storage Capacity">\
                                        </div>';
            //  capacityDiv fishingDiv      
            switch($(this).val()){
                case '1':
                    console.log('admin')
                    $('.capacityDiv').html(""); 
                    $('.fishingDiv').html(""); 
                break;
                case '2':
                    console.log('supplier')
                    $('.capacityDiv').html(""); 
                    $('.fishingDiv').html(fishingHtml);
                break;
                case '3':
                    console.log('producer')
                    $('.capacityDiv').html(capacityHtml); 
                    $('.fishingDiv').html(fishingHtml);
                break;
                case '4':
                    console.log('producer and supplier')
                    $('.capacityDiv').html(capacityHtml); 
                    $('.fishingDiv').html(fishingHtml);
                break;
                case '5':
                    console.log('inspector ')
                    $('.capacityDiv').html(""); 
                    $('.fishingDiv').html(""); 
                break;
                case '6':
                    console.log('new user  ')
                    $('.capacityDiv').html(""); 
                    $('.fishingDiv').html(""); 
                break;
                case '7':
                    console.log('other  ')
                    $('.capacityDiv').html(""); 
                    $('.fishingDiv').html(""); 
                break; 

            }

            //  reload iCheck  for changng if rol type 
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            
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
          url: '{{url("accountmanagement/updateBasicInfo/".$user->id)}}',
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

</script>

@endsection
