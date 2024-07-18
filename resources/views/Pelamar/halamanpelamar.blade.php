<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from shreyu.coderthemes.com/layouts-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Oct 2023 02:22:43 GMT -->

<head>
    <meta charset="utf-8" />
    <title>BKK SMK 1 Kandeman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
  // Initialize Swiper
  var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });
</script>
    <link rel="shortcut icon" href="{{asset('images')}}/bkk.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;900&display=swap" rel="stylesheet">

    <!-- plugins -->
    <link href="{{ asset('assets') }}/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('assets') }}/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('assets') }}/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" disabled />
    <link href="{{ asset('assets') }}/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"
        disabled />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- icons -->
    <link href="{{ asset('assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="{{ asset('./css/landingpage.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
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

<body class="loading" data-layout-mode="horizontal"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-end mb-0">
                    <li class="dropdown d-inline-block d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i data-feather="search"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                            <form class="p-3">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="search here">
                            </form>
                        </div>
                    </li>

                    @guest
                    <!-- Jika pengguna belum login -->
                    <li class="nav-item ">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li>
                    
                    @else
                    
                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle position-relative" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false" id="notif">
                            <i data-feather="bell"></i>
                            <span class="badge bg-danger rounded-circle noti-icon-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-end">
                                        <a href="{{ route('markAsRead') }}" class="text-dark"><small>Clear All</small></a>
                                    </span>Notification
                                </h5>
                            </div>
                            <div class="noti-scroll" data-simplebar>
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ route('markAsRead') }}" class="dropdown-item notify-item border-bottom">
                                        <div class="notify-icon bg-{{ $notification->data['type'] }}"><i class="uil uil-bell"></i></div>
                                        <p class="notify-details">{{ $notification->data['message'] }}<small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small></p>
                                    </a>
                                @endforeach
                            </div>
                            <a href="{{ route('markAsRead') }}" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all <i class="fe-arrow-right"></i>
                            </a>
                        </div>
                    </li>
                    
                    
                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ Auth::user()->gambar ? asset('/storage/'. Auth::user()->gambar) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7oMra0QkSp_Z-gShMOcCIiDF5gc_0VKDKDg&s' }}" alt="user-image" class="rounded-circle">

                            <span class="pro-user-name ms-1">
                             
                              {{ Auth::user()->name }}<i class="uil uil-angle-down"></i>
                             

                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <a href="{{ route('complete-profile-form') }}" class="dropdown-item notify-item">
                                <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Profile</span>
                            </a>

                            <a href="{{ route('edit-password') }}" class="dropdown-item notify-item">
                                <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                            </a>

                
                            <div class="dropdown-divider"></div>

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
                    @endauth
                    
                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('images')}}/bkk.png" alt="" height="24">
                            <!-- <span class="logo-lg-text-light">Shreyu</span> -->
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('images')}}/bkk.png" alt="" height="100">
                            <!-- <span class="logo-lg-text-light">S</span> -->
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('images')}}/bkk.png" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('images')}}/bkk.png" alt="" height="24">
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
                        <a class="navbar-toggle nav-link" data-bs-toggle="collapse"
                            data-bs-target="#topnav-menu-content">
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

        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                    <div class="collapse navbar-collapse justify-content-center" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link arrow-none" href="/" id="topnav-components" role="button"
                                    aria-haspopup="true" aria-expanded="false">
                                    
                                    <i data-feather="home"></i> 
                                   Home<div></div>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i data-feather="briefcase"></i>Lowongan <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                    <a href="/semualowongan" class="dropdown-item">Semua Lowongan</a>
                                    @auth
                                    <a href="{{route('lowongan.rekomendasi')}}" class="dropdown-item">Rekomendasi</a>
                                    @endauth
                                </div>
                            </li>
                          
                           @auth
                           <li class="nav-item">
                            <a class="nav-link" href="{{ route('lamaran.status') }}" id="topnav-apps"
                                role="button" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="layers"></i> Status Pendaftaran
                            </a>
                        </li>
                           @endauth
                           
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        
        @yield('content')
        @yield('footer')

    </div>
    <!-- Vendor js -->
    <script src="{{ asset('assets') }}/js/vendor.min.js"></script>

    <!-- optional plugins -->
    <script src="{{ asset('assets') }}/libs/moment/min/moment.min.js"></script>
    <script src="{{ asset('assets') }}/libs/flatpickr/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('#notif').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                fetch('{{ route('markAsRead') }}')
                    .then(response => {
                        console.log(response)
                        if (response.ok) {
                            document.querySelector('.noti-icon-badge').innerText = '0';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
    @if ($errors->any())
    <script>
        let errorMessages = '';
        @foreach ($errors->all() as $error)
            errorMessages += "{{ $error }}\n";
        @endforeach

        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: errorMessages,
        });
    </script>
@endif
@if (session('success') || session('error'))
    <script>
        $(document).ready(function() {
            var successMessage = "{{ session('success') }}";
            var errorMessage = "{{ session('error') }}";

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: successMessage,
                });
            }

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    text: errorMessage,
                });
            }
        });
    </script>
@endif

    <!-- Inisialisasi Select2 -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <!-- App js -->
    <script src="{{ asset('assets') }}/js/app.min.js"></script>

    

    @yield('scripts')

</body>

<!-- Mirrored from shreyu.coderthemes.com/layouts-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Oct 2023 02:22:43 GMT -->

</html>
