

@extends('layouts.app')
@section('title') <title> Quality Control </title> 
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">Sop Specification</h2>
            <div class="row">
                <div class="messageDiv">
                </div>
                <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Sop</a></li>
                   
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <form action="#" id="basicInfoForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1 tutorial" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Scientific Name </th>
                                            <th>Common Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1 tutorial" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Focus</th>
                                            <th>Quality Parameter </th>
                                            <th>Target</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                    <table id="example1 tutorial" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Cut Type</th>
                                            <th>Cut Length</th>
                                            <th>Cut Width</th>
                                            <th>Cut Lenth</th>
                                            <th>Cut Lenth</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><label for="alpha_code">Tall</label></td> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> </td>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> </td>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td><label for="alpha_code">Jitney </label></td>
                                            <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                            <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                            <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                            <td><input type="text" name="visel" id="visel" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td><label for="alpha_code">Buffet </label></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" id="visel2" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td><label for="alpha_code">Tower </label></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" id="visel2" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td><label for="alpha_code">S/O</label></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" id="visel2" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td><label for="alpha_code">B/O </label></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" id="visel2" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td><label for="alpha_code">1/4 club</label></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" class="form-control" id="visel2"></td>
                                            <td><input type="text" name="visel2" id="visel2" class="form-control"> </td>
                                        </tr>
                                        </tbody>
                                      
                                    </table>
                            </div>
                        </div> <!--  END Row -->

                        <div class="row">
                            <div class="col-md-12">
                            <table id="example1 tutorial" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Discrepancies</th>
                                    <th>Rejection Value</th>
                                    <th>RFW</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><label for="alpha_code">Mechanical Damage</label></td> 
                                    <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                    <td><input type="text" name="Onboard" id="Onboard" class="form-control"> </td>
                                </tr>
                                <tr>
                                    <td><label for="alpha_code"> Broken Belly </label></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                </tr>
                                <tr>
                                    <td><label for="alpha_code">Slightly Broken Belly </label></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                </tr>
                                <tr>
                                    <td><label for="alpha_code"> Soft </label></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                </tr>
                                <tr>
                                    <td><label for="alpha_code"> Light Damage </label></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                </tr>
                                <tr>
                                    <td><label for="alpha_code"> Guts </label></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                </tr>
                                <tr>
                                    <td><label for="alpha_code"> Tail Cut Diameter </label></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                </tr>
                                <tr>
                                    <td><label for="alpha_code"> Gills </label></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                </tr>
                                <tr>
                                    <td><label for="alpha_code"> Other Species </label></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                    <td><input type="text" name="visel" class="form-control" id="visel"></td>
                                </tr>
                                </tbody>
                            </table>
                         </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1 tutorial" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Chemical Criteria </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><label for="alpha_code">Fat Level</label></td> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><label for="alpha_code">Histamine</label></td> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><label for="alpha_code">Domoic Acid</label></td> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1 tutorial" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Havy Metal</th>
                                            <th></th>
                                            <th>Max Limit ppm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1 tutorial" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Germs</th>
                                            <th>n</th>
                                            <th>c</th>
                                            <th>m</th>
                                            <th>M</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                            <td><input type="text" name="Onboard" id="Onboard" class="form-control"> 
                                        </tr>
                                    </tbody>
                                </table>
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
