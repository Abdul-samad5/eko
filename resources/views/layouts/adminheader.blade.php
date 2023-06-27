<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href=" {{ asset('plugins/fontawesome-free/css/all.min.css') }} ">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bladelogin') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    <li>

                        <a class="nav-item text-decoration-none text-black" href="{{ route('profile') }}"
                            style="margin-left:800px;">
                            My Profile
                        </a>
                    </li>

                </ul>

                <!-- Right navbar links -->

            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ url('admindash') }}" class="brand-link text-decoration-none">
                    {{-- <img src="{{ asset('img/shop.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3"> --}}
                    <span class="brand-text font-weight-light">Eko-Market</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    {{-- <!-- Sidebar user panel (optional) --> --}}
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        {{-- @foreach ($studen as $studens)
                    
                    <div class="image">
                        <img src="{{ asset('uploads/student/' . $studens->profile_image) }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                     @endforeach --}}
                        <div class="info">
                            <strong><a href="#" class="d-block text-decoration-none">Welcome
                                    {{ Auth::user()->firstname }}</a></strong>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="{{ url('admindash') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Dashboard
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('viewprod') }}" class="nav-link">
                                    {{-- <i class="nav-icon fas fa-home"></i> --}}
                                    <p>
                                        My Products
                                        {{-- <i class="right fas fa-angle-left"></i> --}}
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('getprod') }}" class="nav-link">
                                    {{-- <i class="nav-icon fas fa-home"></i> --}}
                                    <p>
                                        Upload Products
                                        {{-- <i class="right fas fa-angle-left"></i> --}}
                                    </p>
                                </a>
                            </li>

                            @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ route('category') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            Add Category
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ route('viewcate') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            View Categories
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                             
                             @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ route('vendorprod') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                           My Orders
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ route('reports') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            Reports
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif


                            @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ route('alladmin') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            View Admins
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ route('adminadd') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            Add Admins
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ route('viewvendors') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            Vendors
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ route('vendor') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            Invite Vendors
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif


                            @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ route('allprod') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            All Products
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ url('orders') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            Orders
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ route('allbuyer') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            Buyers
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                             @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ url('viewdeliveryreq') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            New Delivery Request
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                             @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ url('allsentdeliveryemail') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            Delivery Sent Emails
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif


                             @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ url('viewsurveyreq') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            New Survey Request
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                             @if (Auth::user()->role_as == 1 || Auth::user()->role_as == 2 || Auth::user()->role_as == 3)
                                <li class="nav-item">
                                    <a href="{{ url('allsentsurveyemail') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            Survey Sent Emails
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->role_as == 4)
                                <li class="nav-item">
                                    <a href="{{ route('vendorprod') }}" class="nav-link">
                                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                                        <p>
                                            Orders
                                            {{-- <i class="right fas fa-angle-left"></i> --}}
                                        </p>
                                    </a>
                                </li>
                            @endif


                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
        @endguest
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="#">Eko-Market</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
