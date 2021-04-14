


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
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Fishing</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Unloading</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Transport</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Parasitism</a></li>
                    <li><a href="#tab_5" data-toggle="tab">Organoleptic/feed/Resistance</a></li>
                    <li><a href="#tab_11" data-toggle="tab">Raw Material Weight</a></li>
                    <li><a href="#tab_12" data-toggle="tab">Raw Material Length</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
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
                                    <input type="text" name="feed_comment" id="feed_comment" class="form-control" placeholder="Enter Fish Reception">
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
                         <a href="{{ url('lot/updateMaterial') }}" class="fa fa-plus">Update Orgonal</a>
                       </form>
                    </div><!-- /.tab-content -->
                    

                   
                    
                </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div>
    </section>
</div> 

@endsection

@section('customjs')

@endsection

