   

<!-- Page Content  -->
<div id="content" class="">
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>

            <button class="btn btn-link d-inline-block d-lg-none ml-auto menu_top_header_toggle_button collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-ellipsis-v"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('dashboard')}}"><i class="fa fa-fw fa-home"></i> Home</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-fw fa-key"></i> Change Password</a>
                    </li>
                    @if(Session::has('UserID'))
                    <li class="nav-item">
                        <a style="color:#d01010" class="nav-link" href="{{ route('logout') }}"><i class="fa fa-fw fa-power-off"></i> Logout</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</div>
<!-- </div> -->
