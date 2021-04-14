    @extends('layouts.app')
    @section('title') <title>dashboard </title> 
    @endsection
    @section('content')
    <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                Dashboard
                <small>Control panel</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content" style="min-height: 0px; ">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>100</h3>
                      <p>Quality Control</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{url('#')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>99</h3>
                      <p>Inventory And Shipment</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{url('#')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>67</h3>
                      <p>Account Management </p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{url('#')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                    <div class="inner">
                      <h3> 56</h3>
                      <p >Account Management</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-car"></i>
                    </div>
                    
                    <a href="#" class="small-box-footer">Click here <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div><!-- ./col -->
              </div><!-- /.row -->

            </section><!-- /.content -->


            <!-- Main content -->
            <section class="content">
            <div class="row">
              <div class="col-md-12 alert_message">
              
              
                  
                  @if(Session::has('msg'))
                    {!!  Session::get("msg") !!}
                    @endif
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  
                </div>
              </div>
              <div class="row">
            
              </div><!-- /.row -->
            </section><!-- /.content -->


          </div><!-- /.content-wrapper -->


   



    


      @endsection

    @section('customjs')

   
    <script src="{{ URL::asset('admin/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>    

    

    @endsection

