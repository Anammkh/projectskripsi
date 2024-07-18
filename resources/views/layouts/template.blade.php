
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Kandemanbkk 1 Kandeman</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('images')}}/bkk.png">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

		<!-- App css -->
		<link href="{{asset('assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{asset('assets')}}/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="{{asset('assets')}}/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="{{asset('assets')}}/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

		<!-- icons -->
		<link href="{{asset('assets')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets')}}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets')}}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets')}}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets')}}/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

    </head>
    <style>
        .select2-selection__choice {
            background-color: #007bff !important; /* Warna latar belakang biru */
            border-color: #007bff !important; /* Warna border biru */
            color: white !important; /* Warna teks putih */
        }
        .select2-selection__choice__remove {
            color: white !important; /* Warna ikon "x" putih */
        }
    </style>

    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-end mb-0">
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="  {{ Auth::user()->gambar ? asset('/storage/'. Auth::user()->gambar) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7oMra0QkSp_Z-gShMOcCIiDF5gc_0VKDKDg&s' }}" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ms-1">
                                    {{ Auth::user()->name }}  <i class="uil uil-angle-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
    
                                <a href="{{ route ('profile-admin') }}" class="dropdown-item notify-item">
                                    <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                                </a>

                                <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                    <i data-feather="lock" class="icon-dual icon-xs me-1"></i><span>Lock Screen</span>
                                </a>


                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i data-feather="log-out" class="icon-dual icon-xs me-1"></i>{{ __('Logout') }}
                            </a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            
    
                            </div>
                        </li>
    
                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                                <i data-feather="settings"></i>
                            </a>
                        </li>
    
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box d-flex align-items-center justify-content-between my-2">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('images/bkk.png') }}" alt="Logo Dark" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('images/bkk.png') }}" alt="Logo Dark" height="100">
                            </span>
                        </a>
                        
                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('images/bkk.png') }}" alt="Logo Light" height="30">
                             </span>
                            <span class="logo-lg">
                                <img src="{{ asset('images/bkk.png') }}" alt="Logo Light" height="100">
                            </span>
                        </a>
                    </div>
                    
                    
                    
    
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile">
                                <i data-feather="menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>   
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu shadow">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                    <div class="user-box text-center">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">Nik Patel</a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <a href="pages-profile.html" class="dropdown-item notify-item">
                                    <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="settings" class="icon-dual icon-xs me-1"></i><span>Settings</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="help-circle" class="icon-dual icon-xs me-1"></i><span>Support</span>
                                </a>
                                <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                    <i data-feather="lock" class="icon-dual icon-xs me-1"></i><span>Lock Screen</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                                </a>

                            </div>
                        </div>
                        <p class="text-muted">Admin Head</p>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            

      <li class="{{ Request::is('home') ? 'active bg-dark bg-gradient text-white' : '' }}">
        <a href="/home" class="{{ Request::is('home') ? 'text-white' : 'text-dark' }}">
            <i class="fas fa-home"></i> <!-- Menggunakan ikon 'home' untuk home -->
            <span> Dashboards </span>
        </a>
    </li>

    <li class="menu-title mb-2">Apps</li>

    <li class="{{ Request::is('pelamar') ? 'active bg-dark bg-gradient text-white' : '' }}">
        <a href="/pelamar" class="{{ Request::is('pelamar') ? 'text-white' : 'text-dark' }}">
            <i class="fas fa-users"></i> <!-- Menggunakan ikon 'users' untuk pelamar -->
            <span> Pelamar </span>
        </a>
    </li>

    <li class="{{ Request::is('lamaran') ? 'active bg-dark bg-gradient text-white' : '' }}">
        <a href="/lamaran" class="{{ Request::is('lamaran') ? 'text-white' : 'text-dark' }}">
            <i class="fas fa-file-alt"></i> <!-- Menggunakan ikon 'file-alt' untuk lamaran -->
            <span> Lamaran </span>
        </a>
    </li>

    <li class="{{ Request::is('mitra') ? 'active bg-dark bg-gradient text-white' : '' }}">
        <a href="/mitra" class="{{ Request::is('mitra') ? 'text-white' : 'text-dark' }}">
            <i class="fas fa-handshake"></i> <!-- Menggunakan ikon 'handshake' untuk mitra -->
            <span> Mitra </span>
        </a>
    </li>

    <li class="{{ Request::is('jurusan') ? 'active bg-dark bg-gradient text-white' : '' }}">
        <a href="/jurusan" class="{{ Request::is('jurusan') ? 'text-white' : 'text-dark' }}">
            <i class="fas fa-book-open"></i> <!-- Menggunakan ikon 'book-open' untuk jurusan -->
            <span> Jurusan </span>
        </a>
    </li>

    <li class="{{ Request::is('skil') ? 'active bg-dark bg-gradient text-white' : '' }}">
        <a href="/skil" class="{{ Request::is('skil') ? 'text-white' : 'text-dark' }}">
            <i class="fas fa-star"></i> <!-- Menggunakan ikon 'star' untuk skill -->
            <span> Skills </span>
        </a>
    </li>

    <li class="{{ Request::is('lowongan') ? 'active bg-dark bg-gradient text-white' : '' }}">
        <a href="/lowongan" class="{{ Request::is('lowongan') ? 'text-white' : 'text-dark' }}">
            <i class="fas fa-briefcase"></i> <!-- Menggunakan ikon 'briefcase' untuk lowongan -->
            <span> Lowongan </span>
        </a>
    </li>

    <li class="menu-title mb-2">Custom</li>

    <li class="{{ Request::is('usermanajemen') ? 'active bg-dark bg-gradient text-white' : '' }}">
        <a href="/usermanajemen" class="{{ Request::is('usermanajemen') ? 'text-white' : 'text-dark' }}">
            <i class="fas fa-cog"></i> <!-- Menggunakan ikon 'cog' untuk user manajemen -->
            <span> User Manajemen </span>
        </a>
    </li>

   
                            
                            
                        </ul>

                    </div>
                    <!-- End Sidebar -->

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

                    <!-- Start Content-->
                    <div class="container-fluid"> 
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">@yield('title')</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  
                        @yield('content')
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; Khoirul Anam <a href="#">Coderthemes</a> 
                            </div>>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
    
                <h6 class="fw-medium px-3 m-0 py-2 text-uppercase bg-light">
                    <span class="d-block py-1">Theme Settings</span>
                </h6>

                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                    </div>

                    <h6 class="fw-medium mt-4 mb-2 pb-1">Color Scheme</h6>
                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="color-scheme-mode" value="light" id="light-mode-check" checked />
                        <label class="form-check-label" for="light-mode-check">Light Mode</label>
                    </div>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="color-scheme-mode" value="dark" id="dark-mode-check" />
                        <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                    </div>

                    <!-- Width -->
                    <h6 class="fw-medium mt-4 mb-2 pb-1">Width</h6>
                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="width" value="fluid" id="fluid-check" checked />
                        <label class="form-check-label" for="fluid-check">Fluid</label>
                    </div>
                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="width" value="boxed" id="boxed-check" />
                        <label class="form-check-label" for="boxed-check">Boxed</label>
                    </div>

                    <!-- Menu positions -->
                    <h6 class="fw-medium mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="menus-position" value="fixed" id="fixed-check" checked />
                        <label class="form-check-label" for="fixed-check">Fixed</label>
                    </div>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="menus-position" value="scrollable" id="scrollable-check" />
                        <label class="form-check-label" for="scrollable-check">Scrollable</label>
                    </div>

                    <!-- Left Sidebar-->
                    <h6 class="fw-medium mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftsidebar-color" value="light" id="light-check" checked />
                        <label class="form-check-label" for="light-check">Light</label>
                    </div>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftsidebar-color" value="dark" id="dark-check" />
                        <label class="form-check-label" for="dark-check">Dark</label>
                    </div>

                    <!-- size -->
                    <h6 class="fw-medium mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="default" id="default-size-check" checked />
                        <label class="form-check-label" for="default-size-check">Default</label>
                    </div>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="condensed" id="condensed-check" />
                        <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
                    </div>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="compact" id="compact-check" />
                        <label class="form-check-label" for="compact-check">Compact <small>(Small size)</small></label>
                    </div>

                    <!-- User info -->
                    <h6 class="fw-medium mt-4 mb-2 pb-1">Sidebar User Info</h6>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="leftsidebar-user" value="fixed" id="sidebaruser-check" />
                        <label class="form-check-label" for="sidebaruser-check">Enable</label>
                    </div>


                    <!-- Topbar -->
                    <h6 class="fw-medium mt-4 mb-2 pb-1">Topbar</h6>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="topbar-color" value="dark" id="darktopbar-check" checked />
                        <label class="form-check-label" for="darktopbar-check">Dark</label>
                    </div>

                    <div class="form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="topbar-color" value="light" id="lighttopbar-check" />
                        <label class="form-check-label" for="lighttopbar-check">Light</label>
                    </div>


                    <button class="btn btn-primary w-100 mt-4" id="resetBtn">Reset to Default</button>

                    <a href="https://1.envato.market/shreyu_admin" class="btn btn-danger d-block mt-3" target="_blank">
                        <i class="mdi mdi-basket me-1"></i> Purchase Now
                    </a>

                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="{{asset('assets')}}/js/vendor.min.js"></script>

        <!-- App js -->
        
        <script src="{{asset('assets')}}/js/app.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Add these inside the <head> or before the closing </body> tag -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{asset('assets')}}/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="assets/js/pages/datatables.init.js"></script>
    <script>
        $('.datatables').DataTable()
    </script>
    <!-- Inisialisasi Select2 -->
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                maximumSelectionLength: 3,
                templateSelection: function(selected, container) {
                    $(container).css("background-color", "#007bff"); // Set background color biru
                    $(container).css("color", "white"); 
                    return selected.text;
            }
        });
        });
    </script>
     @yield('scripts')
        
    </body>

<!-- Mirrored from shreyu.coderthemes.com/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Oct 2023 02:22:42 GMT -->
</html>