 <div class="wrapper">
  <header class="main-header"><!-- Start of the header with ul -->
    <a href="{{ url('Admin/Dashboard') }}" class="logo"><!-- Navbar brand -->
      <span class="logo-mini">RO</span>
      <span class="logo-lg">Research Office</span>
    </a><!-- End of navbar logo-->
    <nav class="navbar navbar-static-top"><!-- Navigation on the TOP -->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu"><!-- Custom menu on the TOP-->
        <ul class="nav navbar-nav"> <!-- ul for the Nav -->
          <li class="dropdown notifications-menu {{ (Auth::user()->role == 'Super Admin') ? '' : 'hide' }}"><!-- First item on the UL -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-user"></i>
              <span class="label label-warning" id="userCount2">{{ (count($pendingUsers) == 0) ? ''  : $pendingUsers->count() }}</span> <!-- Naa dire ang notification number -->
            </a>
            <ul class="dropdown-menu">
              <li class="header text-center">{{ (count($pendingUsers) == 0) ? 'No pending users' : count($pendingUsers) . ' users are awaiting for confirmation' }}</li><!-- header title  -->
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="pendingUsers">
                  @foreach($pendingUsers as $pendingUser)
                  <li>
                    <a href="{{ url('Admin/PendingUsers') }}">
                      <i class="fa fa-user text-aqua"></i><span>{{ $pendingUser->name }} is awaiting for activation.</span><br>
                      <span class="pull-right">{{ $pendingUser->created_at->diffForHumans() }}</span>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="footer"><a href="{{ url('Admin/PendingUsers') }}">View all</a></li>
            </ul>
          </li><!-- End of the first item  -->
          <li class="dropdown notifications-menu {{ (Auth::user()->role == 'Super Admin') ? '' : 'hide' }}" onclick="markAllAsRead()"><!-- Second item on the UL -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-globe"></i>
              <span class="label label-info" id="userCount">{{ (count($unreadNotificationsCount) == 0) ? ''  : $unreadNotificationsCount->count() }}</span><!-- Naa dire ang notification number -->
            </a>
            <ul class="dropdown-menu">
              <li class="header text-center">Notifications </li><!-- header title  -->
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="menuNotifications">
                  @foreach($notificationsBody as $notification)
                  <li>
                    <a href="{{ $notification->URL }}">
                      <i class="fa {{ (strpos($notification->action, 'journal') !== false) ? 'fa fa-book text-green' : 'fa fa-user text-aqua'}}"></i><span>{{ $notification->action }} </span><br>
                      <span class="pull-right">{{ $notification->created_at->diffForHumans() }}</span>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="footer"><a href="{{ url('Admin/Notifications') }}">View all</a></li>
            </ul>
          </li>
          <li class="dropdown user user-menu"><!-- Second item on the UL-->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
              <img src="{{ Auth::user()->image }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu"><!-- Dropdown of the first list item -->
              <li class="user-header"><!-- List item header-->
                <img src="{{ Auth::user()->image }}" class="img-circle" alt="User Image">
                <p>{{Auth::user()->name}} <small>Member since {{ date('F d, Y', strtotime(Auth::user()->created_at))}}</small></p>
              </li><!-- End of item header -->
              <li class="user-body">
                <div class="row">
                  <div class="col-lg-6">
                     <a href = "{{ url('/Admin/Profile/' . Auth::id()) }}" class="btn btn-default btn-flat btn-block">Profile</a>
                  </div>
                  <div class="col-lg-6">
                      <a href = "{{ url('/') }}" class="btn btn-default btn-flat btn-block">Basic mode</a>
                  </div>
                </div>
              </li>
              <li class="user-footer"><!-- List item footer-->
                <a href="{{ url('logout') }}" class="btn btn-default btn-block">Sign out</a>
              </li><!-- END of list item footer-->
            </ul><!-- END of dropdown menu-->
          </li><!-- END of the second item -->
        </ul> <!-- END of ul -->
      </div> <!-- END custom menu on the TOP-->
    </nav><!-- END of the navigation on the TOP-->
  </header><!-- End of HEADER -->

  <!-- START OF THE LEFT COLUMN! -->
  <aside class="main-sidebar"><!-- THE LEFT COLUMN -->
    <section class="sidebar" style="height: auto;"><!-- START OF THE LEFT COLUMN SECTION-->
      <div class="user-panel" style="padding-bottom: 20px;"><!-- User panel -->
        <div class="pull-left image"><!-- User image -->
          <img src="{{ Auth::user()->image }}" class="img-circle" alt="User Image" >
        </div><!-- End of user image -->
        <div class="pull-left info" style="white-space:normal"><!-- User name -->
          <p>{{ Auth::user()->name }}</p>
          <p style="margin-bottom: 20px;"><i class="fa fa-circle text-success"></i> Online</p>
        </div><!-- End of User name -->
      </div><!-- End of User panel-->

      <ul class="sidebar-menu"><!-- CONTENTS OF THE COLLAPSIBLE SIDEBAR -->
        <li class="header"><p class="text-center">MAIN NAVIGATION</p></li>
        <li><a href="/Admin/Dashboard"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="treeview">
            <a href="#">
              <i class="fa fa-book"></i>
              <span>Research Journals</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('Admin/Research-Journal/Faculty') }}"><i class="fa fa-users"></i> Faculty</a></li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-graduation-cap"></i>
                  <span>Students</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('Admin/Research-Journal/Student/CECS') }}"><i class="fa fa-circle-o"></i> CECS</a></li>
                    <li><a href="{{ url('Admin/Research-Journal/Student/CAS') }}"><i class="fa fa-circle-o"></i> CAS</a></li>
                    <li><a href="{{ url('Admin/Research-Journal/Student/CON') }}"><i class="fa fa-circle-o"></i> CON</a></li>
                    <li><a href="{{ url('Admin/Research-Journal/Student/COC') }}"><i class="fa fa-circle-o"></i> COC</a></li>
                    <li><a href="{{ url('Admin/Research-Journal/Student/CED') }}"><i class="fa fa-circle-o"></i> CED</a></li>
                    <li><a href="{{ url('Admin/Research-Journal/Student/CHRM') }}"><i class="fa fa-circle-o"></i> CHRM</a></li>
                    <li><a href="{{ url('Admin/Research-Journal/Student/COA') }}"><i class="fa fa-circle-o"></i> COA</a></li>
                    <li><a href="{{ url('Admin/Research-Journal/Student/CBA') }}"><i class="fa fa-circle-o"></i> CBA</a></li>
                </ul>
              </li>
            </ul>
        </li>
        <li class="treeview">
          <a href="#">
              <i class="fa fa-book"></i>
              <span>Institutional Researches</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('Admin/Institutional-Research/Faculty') }}"><i class="fa fa-users"></i> Faculty</a></li>
              <li><a href="{{ url('Admin/Institutional-Research/Staff') }}"><i class="fa fa-pencil"></i> Staff</a></li>
            </ul>
        </li>
        <li>
          <a href="{{ url('Admin/Posts') }}">
            <i class="fa fa-pencil"></i>
            <span>Posts</span>
          </a>
        </li>
        <li class="{{ (Auth::user()->role !== 'Super Admin') ? 'hide' : ''}}">
          <a href="{{ url('Admin/Users') }}">
            <i class="fa fa-users"></i>
            <span>Users</span>
          </a>
        </li>
      </ul><!-- END OF SIDEBAR CONTENT! -->

    </section><!-- END OF THE SECTION! -->
  </aside><!-- END OF THE LEFT TAG -->
  <!-- END OF THE SIDE CONTENT! -->