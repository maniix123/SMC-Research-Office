<div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Research Office</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}"><i class="fa fa-home fa-1x" aria-hidden="true"></i> Home</a></li>
                <li ><a href="{{ url('about') }}"><i class="fa fa-info-circle" aria-hidden="true"></i> About</a></li>
                <li><a href="{{ url('contact') }}"><i class="fa fa-phone" aria-hidden="true"></i> Contact</a></li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book" aria-hidden="true"></i> Research Journals <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li><a href="{{ url('ResearchJournal/Faculty') }}"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Faculty</a></li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" ><i class="fa fa-graduation-cap fa-fw" aria-hidden="true"></i> Student</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('ResearchJournal/Student/CECS') }}">CECS</a></li>
                                <li><a href="{{ url('ResearchJournal/Student/CAS') }}">CAS</a></li>
                                <li><a href="{{ url('ResearchJournal/Student/CON') }}">CON</a></li>
                                <li><a href="{{ url('ResearchJournal/Student/COC') }}">COC</a></li>
                                <li><a href="{{ url('ResearchJournal/Student/CED') }}">CED</a></li>
                                <li><a href="{{ url('ResearchJournal/Student/CHRM') }}">CHRM</a></li>
                                <li><a href="{{ url('ResearchJournal/Student/COA') }}">COA</a></li>
                                <li><a href="{{ url('ResearchJournal/Student/CBA') }}">CBA</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book" aria-hidden="true"></i> Institutional Research <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('InstitutionalResearch/Faculty') }}"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Faculty</a></li>
                        <li><a href="{{ url('InstitutionalResearch/Staff') }}"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Staff</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="{{ Auth::user()->image }}" style="width: 20px; height: 20px;"> {{ Auth::user()->email }}
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-cogs" aria-hidden="true"></i> Dashboard mode</a></li>
                      <li class="divider"></li>
                      <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                  </li>
                @else
                    <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>