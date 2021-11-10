<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <a class="navbar-brand d-block d-md-none" href="index.html">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{asset('assets/images/logos/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="{{asset('assets/images/logos/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                     <!-- dark Logo text -->
                     <img src="{{asset('assets/images/logos/logo-text.png')}}" alt="homepage" class="dark-logo" />
                     <!-- Light Logo text -->
                     <img src="{{asset('assets/images/logos/logo-light-text.png')}}" class="light-logo" alt="homepage" />
                </span>
            </a>
            <div class="d-none d-md-block text-center">
                <a class="sidebartoggler waves-effect waves-light d-flex align-items-center side-start" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                    <i class="mdi mdi-menu"></i>
                    <span class="navigation-text ml-3"> Navigation</span>
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <li class="nav-item border-right">
                    <a class="nav-link navbar-brand d-none d-md-block" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{asset('assets/images/logos/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="{{asset('assets/images/logos/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="{{asset('assets/images/logos/logo-text.png')}}" alt="homepage" class="dark-logo" />
                             <!-- Light Logo text -->
                             <img src="{{asset('assets/images/logos/logo-light-text.png')}}" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                </li>

            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31">
                        <span class="ml-2 user-text font-medium">{{auth()->user()->username}}</span><span class="fas fa-angle-down ml-2 user-text"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                            <div class=""><img src="{{asset('assets/images/users/1.jpg')}}" alt="user" class="rounded" width="80"></div>
                            <div class="ml-2">
                                <h4 class="mb-0">{{auth()->user()->username}}</h4>
                            </div>
                        </div>

                        <a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
