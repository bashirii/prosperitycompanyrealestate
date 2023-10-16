<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title') - {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="SpringTech" name="author" />
    <meta content="Good Wanderers website" name="description">
    <!-- App favicon -->
    {{--    <link rel="shortcut icon" href="{{asset('assets/images/spring_logo.png')}}">--}}

    <!-- App css -->
    <link href="{{asset('asset_admin/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('asset_admin/css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{asset('asset_admin/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style">
    <style>
        .error{
            color: red
        }
        .required {
            color: red;
            font-size: 14px;
        }

    </style>
    @stack('css')
    @livewireStyles

    <!-- Scripts -->
    {{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
</head>

<body class="loading"
      data-layout-config='{"leftSideBarTheme":"light","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
<!-- Begin page -->
<div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">

        <!-- LOGO -->
        <a href="{{route('admin.dashboard')}}" class="logo text-center logo-light">
                    <span class="logo-lg">
                        {{-- {{config('app.name')}} --}}
                        Good Wanderers
{{--                        <img src="{{asset('assets/images/logo.jpeg')}}" alt="">--}}
                    </span>
            <span class="logo-sm">
                        Good Wanderers
                    </span>
        </a>

        <!-- LOGO -->
        <a href="{{route('admin.dashboard')}}" class="logo text-center logo-dark">
                    <span class="logo-lg">
                       <img src="{{ asset('/asset/img/logo.png') }}" alt="Good Wanderers Logo" class="image mr-4 rounded-3" width="25">
                        Good Wanderers
                    </span>
            <span class="logo-sm">
                        Good Wanderers
                    </span>
        </a>

        <div class="h-100" id="leftside-menu-container" data-simplebar="">

            <!--- Sidemenu -->
            <ul class="side-nav">

                <li class="side-nav-title side-nav-item">Navigation</li>

                <li class="side-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                        <i class="uil-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                {{-- <li class="side-nav-item">
                    <a href="{{route('admin.users')}}" class="side-nav-link">
                        <i class="uil-user"></i>
                        <span> Staff </span>
                    </a> --}}
                </li>
                <li class="side-nav-item">
                    <a href="{{route('admin.booking')}}" class="side-nav-link">
                        <i class="uil-image"></i>
                        <span> Bookings </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{route('admin.carousel')}}" class="side-nav-link">
                        <i class="uil-image"></i>
                        <span> Carosel </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{route('admin.property')}}" class="side-nav-link">
                        <i class="uil-newspaper"></i>
                        <span> Packages </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{route('admin.team')}}" class="side-nav-link">
                        <i class="uil-book"></i>
                        <span> Guides </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{route('admin.testimonial')}}" class="side-nav-link">
                        <i class="uil-coins"></i>
                        <span> Testimonials </span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a href="{{route('admin.blog')}}" class="side-nav-link">
                        <i class="uil-coins"></i>
                        <span> Blog </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                       class="side-nav-link">
                        <i class="mdi mdi-logout me-1"></i>
                        <span class="text-danger">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topbar-menu float-end mb-0">
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                           role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="account-user-avatar">
                                        <img
                                            src="{{ Auth::user()->profile_photo_url ? Auth::user()->profile_photo_url : asset('asset_admin/img/user_logo.jpg')}}"
                                            alt="user-image" class="rounded-circle">
                                    </span>
                            <span>
                                        <span class="account-user-name">{{Auth::user()->name}}</span>
                                        <span class="account-position">Staff</span>
                                    </span>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span>My Account</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item notify-item" data-bs-toggle="modal" data-bs-target="#resetPassowrdModal">
                                <i class="mdi mdi-key me-1"></i>
                                <span>Change Password</span>
                            </a>

                            <!-- item-->
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                               class="dropdown-item notify-item">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>

                <button class="button-menu-mobile open-left">
                    <i class="mdi mdi-menu"></i>
                </button>

            </div>
            <!-- end Topbar -->

            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">@yield('title')</h4>
                        </div>
                    </div>
                </div>
                @include('partial.alert')

                @yield('content')

            </div>
            <!-- container -->


        </div>
        <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <script>document.write(new Date().getFullYear())</script>
                        © Good Wanderers
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

</div>
<div class="rightbar-overlay"></div>


<div class="modal" tabindex="-1" id="resetPassowrdModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('reset_password')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmed" name="password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jquery -->
{{-- <script src="{{ asset('asset_admin/js/app.js') }}" defer></script> --}}
<script src="{{asset('asset_admin/js/jquery.min.js')}}"></script>
<!-- bundle -->
<script src="{{asset('asset_admin/js/vendor.min.js')}}"></script>
<script src="{{asset('asset_admin/js/app.min.js')}}"></script>

<!-- third party js -->
<script src="{{asset('asset_admin/js/vendor/Chart.bundle.min.js')}}"></script>
<script src="{{asset('asset_admin/js/vendor/apexcharts.min.js')}}"></script>
<script src="{{asset('asset_admin/js/vendor/smooth-scrollbar.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    window.addEventListener('message_alert', message => {
        Swal.fire(
            'Success',
            message.detail,
            'success'
        )
    })
    window.addEventListener('success_alert', message => {
        Swal.fire({
            position: 'center',
            icon: 'success',
            text: message.detail,
            showConfirmButton: false,
            timer: 2500
        })
    })

    window.addEventListener('failure_alert', message => {
        Swal.fire({
            position: 'center',
            icon: 'error',
            text: message.detail,
            showConfirmButton: true,
        })
    })

    function view_image(){
        const gallery = new Viewer(document.getElementById('images'));
    }

</script>

@stack('js')
@livewireScripts

</body>

</html>
