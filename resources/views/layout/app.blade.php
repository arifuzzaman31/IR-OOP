<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title', "EBOOK" )</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('admin-assets/assets/img/favicon.ico')}}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.header-assets')
    <style>
        .active_url a .menu_heading {
            color: #ffffff !important;
        }

        .v-lazy-image {
            filter: blur(10px);
            transition: filter 0.7s;
        }

        .v-lazy-image-loaded {
            filter: blur(0);
        }
    </style>
    @stack('style')
    <script type="text/javascript">
        var APP_URL = "{!! url('/').'/' !!}";
    </script>
</head>

<body class="sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('partials.admin_topbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('partials.admin_sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <!-- <router-view ></router-view> -->
            <div class="layout-px-spacing" id="app">
                @yield('content')
            </div>
            <div class="footer-wrapper bg-white justify-content-end">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © {{ date('Y') }} <a target="_blank" href="https://www.ethertech.ltd/">Ether Technolgies</a>, All rights reserved.</p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->


    </div>


    @include('partials.footer-assets')

    <script>
        $(document).ready(function() {
            $(".active").parents(".menu-categories").children("a").removeClass('collapse');
            $(".active").parents(".menu-categories").children("a").removeAttr('aria-expanded');
            $(".active").parents(".menu-categories").children("a").attr('aria-expanded', true);
            $(".active").parents(".menu-categories").children("a").attr('data-active', true);
            $(".active").parents().addClass('show');
        });
    </script>

    @stack('script')

</body>

</html>