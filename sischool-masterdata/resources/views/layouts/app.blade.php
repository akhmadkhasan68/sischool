<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name', 'Laravel') }} | {{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <script src="{{asset('js/jquary.min.js')}}"></script>
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet">
    <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet">
</head>
<style>
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{asset("loading.gif")}}') 50% 50% no-repeat rgb(249, 249, 249);
        opacity: .8;
    }
</style>

<body>
    <div class="loader"></div>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar ">
        <div class="app-header header-shadow bg-primary header-text-light">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu" style="display:none">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left" style="display: none">
                    <ul class="header-menu nav">
                        <li class="dropdown nav-item" style="color:white">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">

                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">User Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="" style="color: white">
                                        
                                    </div>
                                    <div class="widget-subheading">
                                        
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm logout">
                                        <i class="fa fa-arrow-right text-white pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow bg-dark sidebar-text-light">
                <div class="app-header__logo">
                    <div class="logo-src">
                        <h5>{{config('app.name')}}</h5>
                    </div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Menu</li>
                            <li>
                                <a href="{{ url('home')}}" class="@if($nav_active == 'home') mm-active @endif">
                                    <i class="metismenu-icon pe-7s-home"></i>
                                    Dashboard
                                </a>
                            </li> 
                            <li>
                                <a href="{{ url('jurusan')}}" class="@if($nav_active == 'jurusan') mm-active @endif">
                                    <i class="metismenu-icon pe-7s-link"></i>
                                    Data Jurusan
                                </a>
                            </li> 
                            <li>
                                <a href="{{ url('kelas')}}" class="@if($nav_active == 'kelas') mm-active @endif">
                                    <i class="metismenu-icon pe-7s-id"></i>
                                    Data Kelas
                                </a>
                            </li> 
                            <li>
                                <a href="{{ url('mapel')}}" class="@if($nav_active == 'mapel') mm-active @endif">
                                    <i class="metismenu-icon pe-7s-bookmarks"></i>
                                    Data Mata Pelajaran
                                </a>
                            </li> 
                            <li>
                                <a href="" @if($nav_active == 'siswa' || $nav_active == 'ortu') aria-expanded="true" @endif>
                                    <i class="metismenu-icon pe-7s-users"></i>
                                    Siswa
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul class="@if($nav_active == 'siswa' || $nav_active == 'ortu') mm-show mm-collapse @endif">
                                    <li>
                                        <a href="{{ url('siswa') }}" class="@if($nav_active == 'siswa') mm-active @endif">
                                            <i class="metismenu-icon"></i>
                                            Data Siswa
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('ortu') }}" class="@if($nav_active == 'ortu') mm-active @endif">
                                            <i class="metismenu-icon"></i>
                                            Data Orang Tua/Wali
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" @if($nav_active == 'guru' || $nav_active == 'mapel_guru') aria-expanded="true" @endif>
                                    <i class="metismenu-icon pe-7s-users"></i>
                                    Guru
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul class="@if($nav_active == 'guru' || $nav_active == 'mapel_guru') mm-show mm-collapse @endif">
                                    <li>
                                        <a href="{{ url('guru') }}" class="@if($nav_active == 'guru') mm-active @endif">
                                            <i class="metismenu-icon"></i>
                                            Data Guru
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('mapel_guru') }}" class="@if($nav_active == 'mapel_guru') mm-active @endif">
                                            <i class="metismenu-icon"></i>
                                            Mata Pelajaran Guru
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="" @if($nav_active == 'pengaturan_sekolah' || $nav_active == '') aria-expanded="true" @endif>
                                    <i class="metismenu-icon pe-7s-settings"></i>
                                    Pengaturan
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul class="@if($nav_active == 'pengaturan_sekolah' || $nav_active == '') mm-show mm-collapse @endif">
                                    <li>
                                        <a href="{{ url('pengaturan_akun') }}" class="@if($nav_active == '') mm-active @endif">
                                            <i class="metismenu-icon"></i>
                                            Pengaturan Akun
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('pengaturan_sekolah') }}" class="@if($nav_active == 'pengaturan_sekolah') mm-active @endif">
                                            <i class="metismenu-icon"></i>
                                            Pengaturan Sekolah
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('pengaturan_akses') }}" class="@if($nav_active == '') mm-active @endif">
                                            <i class="metismenu-icon"></i>
                                            Pengaturan Hak Akses
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="logout">
                                    <i class="metismenu-icon fa fa-arrow-right"></i>                            
                                    {{ __('Logout') }}
                                </a>
                            </li>                           
                        </ul>
                    </div>
                </div>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            @yield('content')

        </div>
        
        @yield('modal')

        <div class="app-wrapper-footer" style="display: none">
            <div class="app-footer">
                <div class="app-footer__inner">
                    <div class="app-footer-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    Footer Link 1
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    Footer Link 2
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="app-footer-right">
                        <ul class="nav">
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    Footer Link 3
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <div class="badge badge-success mr-1 ml-0">
                                        <small>NEW</small>
                                    </div>
                                    Footer Link 4
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    @yield('js')
    <script type="text/javascript">
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            // 'timeOut': 0,
            // 'extendedTimeOut': 0,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        
        $(document).ready(function() {
            $(".loader").fadeOut();
        });

        $(".logout").click(function() {
            Swal.fire({
                title: 'Apakah anda ingin keluar ?',
                text: "Anda akan keluar website ini",
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#f5365c',
                confirmButtonText: 'Ya, Keluar'
            }).then((result) => {
                if (result.value) {
                    event.preventDefault(); document.getElementById('logout-form').submit();
                }
            })
        });    
    </script>
</body>
</html>


    