<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Black Dashboard') }}</title>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black') }}/img/apple-icon.png">
        <link rel="icon" type="image/png" href="{{ asset('black') }}/img/favicon.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('black') }}/css/nucleo-icons.css" rel="stylesheet" />
        <!-- CSS -->
        <link href="{{ asset('black') }}/css/black-dashboard.css?v=3" rel="stylesheet" />
        <link href="{{ asset('black') }}/css/theme.css" rel="stylesheet" />
        <link href="{{ asset('black') }}/css/btnanimation.css" rel="stylesheet" />
        <link href="{{ asset('black') }}/css/logoanimation.css" rel="stylesheet" />
        <link href="{{ asset('black') }}/css/radioanimation.css" rel="stylesheet" />
        <link href="{{ asset('black') }}/css/bubble.css" rel="stylesheet" />
        <link href="{{ asset('black') }}/css/battery.css" rel="stylesheet" />
        <link href="{{ asset('black') }}/css/bat-icon.css" rel="stylesheet" />
    <style>
        .selector{
            background: #3f536c;
            color: white;
            border-radius: 10px;
        }
        body{
            background: #1d4c76;
        }
        .card-color{
            background: #172e4d;
        }
        .blue-text{
            color: #6dc8e4;
            font-weight: bold;
        }
        .btns {
        border: 2px solid black;
        background-color: transparent;
        color: black;
        padding: 3px 10px;
        font-size: 12px;
        font-weight: bolder;
        cursor: pointer;
        }

        /* Green */
        .successs {
        border-color: #04AA6D;
        color: green;
        }

        .successs:hover {
        background-color: #04AA6D;
        color: white;
        }
        .dangers {
        border-color: #f44336;
        color: red
        }

        .infos:hover {
        background: rgb(97, 210, 255);
        color: white;
        }
        .infos {
        border-color:rgb(97, 210, 255);
        color: rgb(97, 210, 255);;
        }

        .dangers:hover {
        background: #f44336;
        color: white;
        }
        html {
        scroll-behavior: smooth;
        }
        .img-centered-5 {
            position: absolute;
            top: 50%;
            left: 45%;
            transform: translate(-50%, -50%);
        }
        .img-centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .img-container {
            position: relative;
            text-align: center;
            color: white;
        }
        .text-red{
            color: #bf180f;
        }
        .text-white{
            color: #ffffff;
        }
        .no-bg{
            background: transparent;
        }
        .clear-bg{
            background:none;
            border:none;
        }
        .spacing{
            padding-left: 20px;
        }
        .primary-div{
            background: #27293d;
            width: 400px;
            padding-right:20px;
            padding-left:20px;
            padding-bottom: 10px;
        }
        .secondary-div{
            padding-left:20px;
        }
        .tertiary-div{
            padding-left:40px;
        }
        .no-event{
            pointer-events:none;
        }
        .sidepanel  {
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            transition: 0.5s;
        }

        .sidepanel .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
        }
        /* building bg pic */
        .building{ 
            background: url('/black/img/building.jpg') no-repeat;
        }
        /* board bg pic */
        .board{ 
            background: url('/black/img/board.jpg') no-repeat;
        }
        .gradient-black{
            background: linear-gradient(#270436, #130536);
        }
        .no-hover:hover{
            background-color: green;
        }
        .nav-custom{
            margin-top:16px;
            width:200px;
            cursor: pointer;
        }
        .form-control{
            color-scheme: dark;
            font-weight: bold;
        }
        /*  */
        ::-webkit-scrollbar {
            width: 2px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            border-radius: 100vh;
            background: #1f2937;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(rgb(134, 239, 172), rgb(59, 130, 246), rgb(147, 51, 234));
        }



    </style>
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            {{-- <div class="wrapper">
                    @include('layouts.navbars.sidebar')
                <div class="main-panel">
                    @include('layouts.navbars.navbar')

                    <div class="content" style="max-width: 100vw">
                        @yield('content')
                    </div>

                    @include('layouts.footer')
                </div>
            </div> --}}
            @include('layouts.navbars.navbar')
            @include('layouts.navbars.sidebar')
            <div class="wrapper wrapper-full-page" onclick="closeNav()">
                <div class="full-page {{ $contentClass ?? '' }}" >
                    <div class="content" style="padding-top: 20px;">
                        <div class="container" style="max-width: 100vw">
                            @yield('content')
                        </div>
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            @include('layouts.navbars.navbar')
            @include('layouts.navbars.sidebar')
            <div class="wrapper wrapper-full-page" onclick="closeNav()">
                <div class="full-page {{ $contentClass ?? '' }}" style='background-image: url("/black/img/loginbg.jpg");background-color: #cccccc;background-repeat: no-repeat;background-size: cover;background-position: center center;'>
                    <div class="content" style="padding-top: 20px;">
                        <div class="container" style="max-width: 100vw">
                            @yield('content')
                        </div>
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        @endauth
        {{-- <div class="fixed-plugin">
            <div class="dropdown show-dropdown">
                <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
                </a>
                <ul class="dropdown-menu">
                <li class="header-title"> Sidebar Background</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors text-center">
                        <span class="badge filter badge-primary active" data-color="primary"></span>
                        <span class="badge filter badge-info" data-color="blue"></span>
                        <span class="badge filter badge-success" data-color="green"></span>
                    </div>
                    <div class="clearfix"></div>
                    </a>
                </li>
                </ul>
            </div>
        </div> --}}
        <script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('black') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('black') }}/js/core/bootstrap.min.js"></script>
        <script src="{{ asset('black') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!--  Google Maps Plugin    -->
        <!-- Place this tag in your head or just before your close body tag. -->
        {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
        <!-- Chart JS -->
        {{-- <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script> --}}
        <!--  Notifications Plugin    -->
        <script src="{{ asset('black') }}/js/plugins/bootstrap-notify.js"></script>

        <script src="{{ asset('black') }}/js/black-dashboard.min.js?v=1.0.0"></script>
        <script src="{{ asset('black') }}/js/theme.js"></script>
        <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://kit.fontawesome.com/b75595df6d.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
        <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        @stack('js')

        <script>
            $(document).ready(function() {
                $().ready(function() {
                    
                    $sidebar = $('.sidebar');
                    $navbar = $('.navbar');
                    $main_panel = $('.main-panel');

                    $full_page = $('.full-page');

                    $sidebar_responsive = $('body > .navbar-collapse');
                    sidebar_mini_active = true;
                    white_color = false;

                    window_width = $(window).width();

                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                    $('.fixed-plugin a').click(function(event) {
                        if ($(this).hasClass('switch-trigger')) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (window.event) {
                                window.event.cancelBubble = true;
                            }
                        }
                    });

                    $('.fixed-plugin .background-color span').click(function() {
                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');

                        var new_color = $(this).data('color');

                        if ($sidebar.length != 0) {
                            $sidebar.attr('data', new_color);
                        }

                        if ($main_panel.length != 0) {
                            $main_panel.attr('data', new_color);
                        }

                        if ($full_page.length != 0) {
                            $full_page.attr('filter-color', new_color);
                        }

                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.attr('data', new_color);
                        }
                    });

                    $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                        var $btn = $(this);

                        if (sidebar_mini_active == true) {
                            $('body').removeClass('sidebar-mini');
                            sidebar_mini_active = false;
                            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                        } else {
                            $('body').addClass('sidebar-mini');
                            sidebar_mini_active = true;
                            blackDashboard.showSidebarMessage('Sidebar mini activated...');
                        }

                        // we simulate the window Resize so the charts will get updated in realtime.
                        var simulateWindowResize = setInterval(function() {
                            window.dispatchEvent(new Event('resize'));
                        }, 180);

                        // we stop the simulation of Window Resize after the animations are completed
                        setTimeout(function() {
                            clearInterval(simulateWindowResize);
                        }, 1000);
                    });

                    $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                            var $btn = $(this);

                            if (white_color == true) {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').removeClass('white-content');
                                }, 900);
                                white_color = false;
                            } else {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').addClass('white-content');
                                }, 900);

                                white_color = true;
                            }
                    });
                // My custom script
                $('.icon-toggle').click(function(){
                    $(this).children('i').toggleClass("fa-caret-up");
                });
                
                });
            });
            function openNav(x) {
            document.getElementById("mySidepanel").style.width = "21vw";
            if(x == 1){
                $('#nav1').show();
                $('#nav2').hide();
            }
            else{
                $('#nav2').show();
                $('#nav1').hide();
            }
            }

            function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
            }
        </script>
    </body>
</html>
