<header class="main-header"> 
  <!-- Logo --> 
  <a href="{{route("cms::dashboard")}}" class="logo blue-bg"> 
  <!-- mini logo for sidebar mini 50x50 pixels --> 
  <span class="logo-mini"><img src="{!! asset('cms/img/logo-n.png') !!}" alt=""></span> 
  <!-- logo for regular state and mobile devices --> 
  <span class="logo-lg"><img src="{!! asset('cms/img/logo.png') !!}" alt=""></span> </a> 
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar blue-bg navbar-static-top"> 
    <!-- Sidebar toggle button-->
    
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
       {{-- <li class="dropdown messages-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i>
          <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
          </a>
          <ul class="dropdown-menu">
            <li class="header">Notifications</li>
            <li>
              <ul class="menu">
                <li><a href="#">
                  <div class="pull-left icon-circle red"><i class="icon-lightbulb"></i></div>
                  <h4>Alex C. Patton</h4>
                  <p>I've finished it! See you so...</p>
                  <p><span class="time">9:30 AM</span></p>
                  </a></li>
                <li><a href="#">
                  <div class="pull-left icon-circle blue"><i class="fa fa-coffee"></i></div>
                  <h4>Nikolaj S. Henriksen</h4>
                  <p>I've finished it! See you so...</p>
                  <p><span class="time">1:30 AM</span></p>
                  </a></li>
                <li><a href="#">
                  <div class="pull-left icon-circle green"><i class="fa fa-paperclip"></i></div>
                  <h4>Kasper S. Jessen</h4>
                  <p>I've finished it! See you so...</p>
                  <p><span class="time">9:30 AM</span></p>
                  </a></li>
                <li><a href="#">
                  <div class="pull-left icon-circle yellow"><i class="fa  fa-plane"></i></div>
                  <h4>Florence S. Kasper</h4>
                  <p>I've finished it! See you so...</p>
                  <p><span class="time">11:10 AM</span></p>
                  </a></li>
              </ul>
            </li>
            <li class="footer"><a href="#">Check all Notifications</a></li>
          </ul>
        </li> --}}
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> You are logged in as <span class="hidden-xs">{{auth()->user()->name}}</span> </a>
          
        </li>
      </ul>
    </div>
  </nav>
</header>