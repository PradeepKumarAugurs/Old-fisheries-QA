 <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left">
              <img src="@if(!empty(Auth::user()->logo)) {{url('storage/app/logo'.'/'.Auth::user()->logo)}} @else {{asset('images/logo/logo.png')}} @endif" class="sidebarimage" alt="User Image"/>
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name }} </p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <!-- <li class="header">MAIN NAVIGATION</li> -->
            <li>
              <a href="{{url('dashboard')}}">
                <i class="fa fa-dashboard"></i><span>Dashboard</span> <i class="fa pull-right"></i>
              </a>
            </li>
           
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Account Management </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('accountmanagement/users') }}"><i class="fa fa-user"></i>User Profile</a></li>
                <li><a href="{{ url('accountmanagement/producers') }}"><i class="fa fa-user"></i>Producer Profile</a></li>
                <li><a href="{{ url('accountmanagement/getAllVessel') }}"><i class="fa fa-user"></i>Vessels</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-fighter-jet"></i> <span>Production & Quality</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                
                <li class="treeview">
                  <a href="#"><i class="fa fa-user"></i>Raw Material
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('lot/createRawMaterial')}}"><i class="fa fa-circle-o"></i>New Fish Arrival</a></li>
                        <li><a href="{{ url('lot/rawMaterialArrival') }}"><i class="fa fa-user"></i>List Of Arrivals</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-user"></i>New Lot
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('lot/lotInformation')}}"><i class="fa fa-user"></i>Lot Information</a></li>
                        <!--li><a href="{{ url('accountmanagement/createSpotInspection') }}"><i class="fa fa-user"></i>Lot Info List</a></li-->
                        <li><a href="{{ url('lot/coldChainList') }}"><i class="fa fa-user"></i>Lot Info List</a></li>
                    </ul>
                </li>
               

                <li><a href="#"><i class="fa fa-user"></i>Lot Consultation</a></li>
                <li><a href="#"><i class="fa fa-user"></i>Scars</a></li>
                <li><a href="{{ url('accountmanagement/createSop') }}"><i class="fa fa-circle-o"></i>Sop`s & Specification</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-fighter-jet"></i> <span>Inventory & Shipment</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <!--<ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-user"></i> Level One</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-user"></i> Level One
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-user"></i> Level Two</a></li>
                    <li class="treeview">
                      <a href="#"><i class="fa fa-user"></i> Level Two
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-user"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-user"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-user"></i> Level One</a></li>
              </ul>-->
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>