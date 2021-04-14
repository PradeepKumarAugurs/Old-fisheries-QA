
@extends('layouts.app')
@section('title') <title>AccountManagement </title> 
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">Update Producer Profile</h2>
            <div class="row">
                <div class="messageDiv">
                </div>
                <div class="col-md-12">
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
                <!-- Custom Tabs -->
               @if($producer as $producerlist)
               
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Profile</a></li>
                    <li><a href="#tab_2" data-toggle="tab"></a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <form action="javascript:void(0)" id="basicInfoForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_name">User Name</label>
                                <input type="text" name="user_name" id="user_name" value="{{ $producerlist->name }}" class="form-control" placeholder="Enter User Name">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="user_name"></label>
                                    <input type="file" name="image_name" id="image_name" class="form-control">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" class="form-control" placeholder="Enter Code">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="alpha_code">Alpha Code</label>
                                    <input type="text" name="alpha_code" id="alpha_code" class="form-control"  placeholder="Enter Alpha Code">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="code">Country</label>
                                <input type="text" name="code" id="code" class="form-control" placeholder="Enter Code">
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="alpha_code">City</label>
                                    <input type="text" name="alpha_code" id="alpha_code" class="form-control"  placeholder="Enter Alpha Code">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea  style="resize:none" name="address" id="address" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Leader</label>
                                    <select class="form-control">
                                        <option>Leader 1</option>
                                        <option>Leader 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="alpha_code">Producer Type</label>
                                    <select class="form-control">
                                        <option>Producer 1</option>
                                        <option>Producer 2</option>
                                    </select>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Fishing Visel All list</th>
                                                <th>Self Owned</th>
                                                <th>Exclusivity</th>
                                                <th>Priority</th>
                                                <th>Capacity</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><label for="alpha_code">Internal Onboard</label></td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" readonly=""> 
                                                <td><input type="text" name="granding" id="granding" class="form-control" readonly=""> </td>
                                                </td> <td><input type="text" name="granding" id="granding" class="form-control" readonly=""> </td>
                                                <td><input type="text" name="granding" id="granding" class="form-control"  readonly=""> </td>
                                            </tr>
                                            <tr>
                                                <td><label for="alpha_code">Fishing Visel 1 </label></td>
                                                <td><input type="checkbox" name="" class="minimal" id=""></td>
                                                <td><input type="checkbox" name="" class="minimal" id=""></td>
                                                <td><input type="checkbox" name="" class="minimal" id=""></td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter 32.0 mt"> </td>
                                            </tr>
                                            <tr>
                                                <td><label for="alpha_code">Fishing Visel 2 </label></td>
                                                <td><input type="checkbox" name="" class="minimal" id=""></td>
                                                <td><input type="checkbox" name="" class="minimal" id=""></td>
                                                <td><input type="checkbox" name="" class="minimal" id=""></td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter 40.0 mt"> </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>FAO Fising Zone</label>
                                    <select class="form-control">
                                        <option>FAO 34</option>
                                        <option>FAO 34</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="alpha_code"></label>
                                    <select class="form-control">
                                        <option>Producer 1</option>
                                        <option>Producer 2</option>
                                    </select>
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        
                        <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Unloading Site</th>
                                                <th>Unloading Type</th>
                                                <th>Distance</th>
                                                <th>Typical Trucking Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter site"> </td>
                                                <td> <select class="form-control">
                                                    <option>FAO 34</option>
                                                    <option>FAO 34</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter Distance"> </td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter Typical Trucking Time"> </td>
                                                
                                            </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Stroage at Reception</th>
                                                <th>Capacity</th>
                                                <th>Storage Type</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td> <label for="catch">Storage9T</label></td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter 1000 mt"> </td>
                                                <td> <select class="form-control">
                                                    <option>Totes</option>
                                                    <option>Totes</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> <label for="catch">Total</label></td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter 1000 mt"> </td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter 1000 mt/h"> </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Source</th>
                                                <th>Capacity</th>
                                                <th>Type Of Ice</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            <td> <select class="form-control">
                                                    <option>Own</option>
                                                    <option>Own</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter 1000 mt/h"> </td>
                                                <td> <select class="form-control">
                                                    <option>Flake</option>
                                                    <option>Flake</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Type</th>
                                                <th>Capacity</th>
                                                <th># Of Grades</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><label for="catch">Gradding</label></td>   
                                                <td> <select class="form-control">
                                                    <option>Roller Gradder1</option>
                                                    <option>Roller Gradder2</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter granding"> </td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter granding"> </td>
                                            </tr>
                                            <tr>
                                                <td><label for="catch">Gradding</label></td>   
                                                <td> <select class="form-control">
                                                    <option>Roller Gradder1</option>
                                                    <option>Roller Gradder2</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter granding"> </td>
                                                <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter granding"> </td>
                                            </tr>
                                            <tr>
                                                <td><label for="catch">Total</label></td>   
                                                <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter total"> </td>
                                                <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter total"> </td>
                                                <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter total"> </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th># Of infeed</th>
                                                <th>Name</th>
                                                <th>Capacity/Hour</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><label for="catch">Line1</label></td>    
                                                    <td><input type="text" name="line2" id="line" class="form-control" placeholder="Enter Line1"> </td>   
                                                    <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter 8 mt/h"> </td> 
                                                </tr>
                                                <tr>
                                                    <td><label for="catch">Line2</label></td>    
                                                    <td><input type="text" name="line2" id="line" class="form-control" placeholder="Enter Line2"> </td>   
                                                    <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter 5 mt/h"> </td>  
                                                </tr>
                                                <tr>
                                                    <td><label for="catch">Total</label></td>    
                                                    <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                                    <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td> 
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th># Of infeed</th>
                                                <th>Name</th>
                                                <th>Capacity/Hour</th>
                                                <th># of Machine</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><label for="catch">Line1</label></td>   
                                                    <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>   
                                                    <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter 3 mt/h"> </td>   
                                                    <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter 8 mt/h"> </td>   
                                                </tr>
                                                <tr>
                                                    <td><label for="catch">Total</label></td>    
                                                    <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                                    <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                                    <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Number of Machine</th>
                                        <th>Additional Field</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>   
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>   
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter 3 mt/h"> </td>   
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter 8 mt/h"> </td> 
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>      
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                        </tr>
                                        
                                    </tbody>
                                        </table>
                                </div>
                            </div> <!--  END Row -->

                            <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Pack</th>
                                        <th>Capacity/Batch</th>
                                        <th>Additional Field</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><label for="catch">Freezer1</label></td>   
                                            <td> <select class="form-control">
                                                    <option>Roller Gradder1</option>
                                                    <option>Roller Gradder2</option>
                                                    </select>
                                                    <td> <select class="form-control">
                                                    <option>Roller Gradder1</option>
                                                    <option>Roller Gradder2</option>
                                                    </select>
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter 8 mt/h"> </td> 
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>      
                                        </tr>
                                        <tr>
                                            <td><label for="catch">Freezer2</label></td>    
                                            <td> <select class="form-control">
                                                    <option>Type1</option>
                                                    <option>Type2</option>
                                                    </select>  
                                                    <td> <select class="form-control">
                                                    <option>Pack1</option>
                                                    <option>Pack12</option>
                                                    </select>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                        </tr>
                                        <tr>
                                            <td><label for="catch">Total</label></td>    
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                        </tr>
                                    </tbody>
                                        </table>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Pack</th>
                                        <th>Capacity/Batch</th>
                                        <th>Additional Field</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><label for="catch">Freezer1</label></td>   
                                            <td> <select class="form-control">
                                                    <option>Roller Gradder1</option>
                                                    <option>Roller Gradder2</option>
                                                    </select></td>
                                                    <td> <select class="form-control">
                                                    <option>Roller Gradder1</option>
                                                    <option>Roller Gradder2</option>
                                                    </select></td>
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter 8 mt/h"> </td> 
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>      
                                        </tr>
                                        <tr>
                                            <td><label for="catch">Freezer2</label></td>    
                                            <td> <select class="form-control">
                                                    <option>Type1</option>
                                                    <option>Type2</option>
                                                    </select>  
                                            <td> <select class="form-control">
                                                    <option>Pack1</option>
                                                    <option>Pack12</option>
                                                    </select> 
                                            </td>
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                        </tr>
                                        <tr>
                                            <td><label for="catch">Total</label></td>    
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                        </tr>
                                    </tbody>
                                        </table>
                                </div>
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>CS</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Capacity</th>
                                        <th>Set Temp</th>
                                        <th>Additional Field</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>   
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>   
                                            <td> <select class="form-control">
                                                    <option>Type</option>
                                                    <option>Type</option>
                                                    </select> 
                                            </td>  
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter 8 mt/h"> </td> 
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>      
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td> <select class="form-control">
                                                    <option>type</option>
                                                    <option>Type</option>
                                                    </select> 
                                            </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>   
                                        </tr>
                                        <tr>
                                            <td><label for="catch">Total</label></td>    
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td> 
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td> 
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td> 
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td> 
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter Cut1"> </td> 
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>  
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code"># Loading bays</label>
                                        <input type="text" name="code" id="code" class="form-control" placeholder="Enter Code">
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="alpha_code"></label>
                                
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Shipping Port</th>
                                        <th>Distance</th>
                                        <th>Trunking Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><label for="code"># Loading bays</label> </td> 
                                            <td><input type="text" name="line" id="line" class="form-control" placeholder="Enter 8 mt/h"> </td> 
                                            <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>  
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>  
                            </div> <!--  END Row -->
                            <div class="row">
                                <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Factory approved by Denis Group appointed auditor?</th>
                                        <td>Yes <input type="checkbox" name="" class="minimal" id="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        No <input type="checkbox" name="" class="minimal" id=""></td>
                                    </tr>
                                    <tr>
                                        <th><label for="code">Date of the audit</label></th> 
                                        <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code">Global Scoring </label></th> 
                                        <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code">Row Material </label></th> 
                                        <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code">Processing facilities </label></th> 
                                        <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code"> Respect of the cold chain </label></th>
                                        <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code"> Storage </label></th>
                                        <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>
                                    </tr>
                                    <tr>
                                        <th><label for="code"> Traceability </label></th>
                                        <td><input type="text" name="total" id="total" class="form-control" placeholder="Enter Total"> </td>
                                    </tr>
                                </tbody>
                                </table>
                                </div>  
                            </div> <!--  END Row -->

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div><!-- /.tab-pane -->
                    
                </div><!-- nav-tabs-custom -->
                @endif
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
 });

</script>
@endsection
