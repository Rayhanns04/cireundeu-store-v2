<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/jpg" href="https://i.imgur.com/mM4GHMk.png" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('assets/css/bootstrap.css') }}>

    <link rel="stylesheet" href={{ asset('assets/vendors/iconly/bold.css') }}>

    <link rel="stylesheet" href={{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}>
    <link rel="stylesheet" href={{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/app.css') }}>
    <link rel="shortcut icon" href={{ asset('assets/images/logo/logo-sm.svg') }} type="image/x-icon">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://kit.fontawesome.com/dbe540109d.js" crossorigin="anonymous"></script>

</head>

<body>

    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="#"><img src="{{ asset('assets/images/logo/logo-large.svg') }}" class="img-fluid"
                                    alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="/home" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>


                        <li class="sidebar-title">All Tables</li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fas fa-user-secret"></i>
                                <span>Manajement Produk</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="/categories">Kategori</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/subcategories">Sub Kategori</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/products">Produk</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fas fa-tools"></i>
                                <span>Lainnya</span>
                            </a>

                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="/carousels">Slider</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/phones">Nomer telephone</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/fee">Pajak Pengiriman</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item active ">
                            <a href="{{ route('logout') }}" class='sidebar-link'
                                onclick="event.preventDefault();
                                                                             document.getElementById('logout-form').submit();">
                                <i class="bi bi-grid-fill"></i>
                                <span> {{ __('Logout') }}</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        {{-- Main Content -------------------------- --}}

        @yield('modal')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            {{-- Yield Content --}}

            @yield('content')
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"
        integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src={{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}></script>
    <script src={{ asset('assets/js/bootstrap.bundle.min.js') }}></script>

    <script src={{ asset('assets/vendors/apexcharts/apexcharts.js') }}></script>
    <script src={{ asset('assets/js/pages/dashboard.js') }}></script>
    <script src={{ asset('assets/js/main.js') }}></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

    @yield('scripts')
</body>

</html>
