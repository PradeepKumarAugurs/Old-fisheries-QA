

@extends('layouts.app')
@section('title') <title> Quality Control </title> 
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
            <h2 class="page-header">Histamine</h2>
            <div class="row">
                <div class="messageDiv">
                </div>
                <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Histamine</a></li>
                   
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <form action="#" id="basicInfoForm" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="username">Histamine At Reception</label>
                                  <input type="text" name="username" id="username" class="form-control" placeholder="Enter Histamine Reception">
                                </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                      <label for="user_image">Histamine After Freezing</label>
                                      <input type="text" name="username" id="username" class="form-control" placeholder="Enter Histamine Freezing">
                                </div>
                            </div>
                        </div> <!--  END Row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="username">Histamine At Reception</label>
                                  <textarea name="" type="" class="form-control"></textarea>
                                </div>
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
