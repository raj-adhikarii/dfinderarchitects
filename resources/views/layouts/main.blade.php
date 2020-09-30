<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        @yield('title')
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->
        <link type="text/css" rel="stylesheet" href="{{ asset('public/css/reset.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('public/css/plugins.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('public/css/style.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('public/css/color.css') }}">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">
        <style>
            .ql-size-small {
                font-size: 0.75em;
            }
            .ql-size-large {
                font-size: 1.5em;
            }
            .ql-size-huge {
                font-size: 2.5em;
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <!--Loader -->
        <div class="loader2">
            <div class="loader loader_each"><span></span></div>
        </div>
        <!-- loader end  -->
        <!-- main start  -->
        <div id="main">
            <!-- header start  -->
            <header class="main-header">
               @php( $footer = \App\Footer::first() )
                <a href="{{ route('index') }}" class="header-logo ajax">@if($footer && $footer->logo)<img src="{{ $footer->logo }}" alt=""> @else <span style="font-size: 18px; color: white;">LOGO HERE</span> @endif</a>
                <!-- sidebar-button -->
                <!-- nav-button-wrap-->
                <div class="nav-button-wrap">
                    <div class="nav-button">
                        <span  class="nos"></span>
                        <span class="ncs"></span>
                        <span class="nbs"></span>
                        <div class="menu-button-text">menu</div>
                    </div>
                </div>
                <!-- nav-button-wrap end-->
                <!-- sidebar-button end-->
                <!--  navigation -->
                <div class="header-contacts">
                    <ul>
                        <li><span> Call </span> <a href="tel:@if($footer) {{ $footer->phone }} @endif">@if($footer) {{ $footer->phone }}@else +000 000 0000 000 @endif</a></li>
                        <li><span> Write </span> <a href="mailto:@if($footer) {{ $footer->email }} @endif">@if($footer) {{ $footer->email }}@else email@example.com @endif</a></li>
                    </ul>
                </div>
                <!-- navigation  end -->
            </header>
            <!-- header end -->
            <!-- left-panel -->
            <div class="left-panel">
                {{-- <div class="horizonral-subtitle"><span><b>Making Your Dream House</b></span></div> --}}
                <div class="left-panel_social">
                    <ul >
                        <li><a href="@if($footer) {{ $footer->social_facebook }} @endif" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="@if($footer) {{ $footer->social_instagram }} @endif" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="@if($footer) {{ $footer->social_twitter }} @endif" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="@if($footer) {{ $footer->social_linkedin }} @endif" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- left-panel end -->
            <!-- share-button -->
            <div class="share-button showshare">
                <span>Share</span>
            </div>
            <!-- share-button end -->
            <!-- wrapper  -->
            <div id="wrapper">
                <div class="content-holder" data-pagetitle="Home Half Slider">
                    <!-- nav-holder-->
                    <div class="nav-holder but-hol">
                        <div class="nav-scroll-bar-wrap fl-wrap">

                            <nav class="nav-inner" id="menu">
                                <ul>
                                    <li>
                                        <a href="{{ route('index') }}" class="@yield('home-nav')">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}" class="@yield('about-nav')">About</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('home-projects') }}" class="@yield('projects-nav')">Projects</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('home-events') }}" class="@yield('events-nav')">Events</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('home-contacts') }}" class="@yield('contacts-nav')">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- nav end-->

                        </div>
                        <!--nav-social-->
                        <div class="nav-social">
                            <span class="nav-social_title">Follow us : </span>
                            <ul >
                                <li><a href="@if($footer) {{ $footer->social_facebook }} @endif" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="@if($footer) {{ $footer->social_instagram }} @endif" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="@if($footer) {{ $footer->social_twitter }} @endif" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="@if($footer) {{ $footer->social_linkedin }} @endif" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                {{-- <li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li> --}}
                            </ul>
                        </div>
                        <!--nav-social end -->
                    </div>
                    <div class="nav-overlay">
                        <div class="element"></div>
                    </div>
                    <!-- nav-holder end -->
                    <!--Content -->
                        @yield('content')
                    <!--content end -->
                    <!-- footer -->
                    @if (!isset($removeFooter))
                        <div class="height-emulator fl-wrap"></div>
                        <footer class="main-footer fixed-footer">
                            <div class="pr-bg"></div>
                            <div class="container">
                                <div class="fl-wrap footer-inner">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="footer-logo">
                                                @if($footer && $footer->logo)<img src="{{ $footer->logo }}" alt="logo"> @else <span style="font-size: 18px; color: white;">LOGO HERE</span> @endif
                                            </div>
                                            <div class="footer_text  footer-box fl-wrap">
                                                <p style="text-align: left;">@if($footer) {!! $footer->footer_description !!} @endif</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="footer-header fl-wrap">Contact Us </div>
                                            <!-- footer-contacts-->
                                            <div class="footer-contacts footer-box fl-wrap">
                                                <ul>
                                                    <li><span>Call:</span><a href="@if($footer) {{ $footer->phone }} @endif"></a>@if($footer) {{ $footer->phone }} @else +000 000 0000 000 @endif</li>
                                                    <li><span>Write  :</span><a href="@if($footer) {{ $footer->email }} @endif"></a>@if($footer) {{ $footer->email }} @else Email@example.com @endif</li>
                                                    <li><span>Find us : </span><a href="@if($footer) {{ $footer->location }} @endif"></a>@if($footer) {{ $footer->location }} @else Location, Address @endif</li>
                                                </ul>
                                            </div>
                                            <!-- footer contacts end -->
                                            <a href="{{ route('home-contacts') }}" class="fc_button">Get In Touch <i class="fal fa-envelope"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="subfooter fl-wrap">
                                    <!-- policy-box-->
                                    <div class="policy-box">
                                        <span>&#169; DFinder Architects {{date('yy')}}. All rights reserved. Crafted with <span style="color: #ff2828;"><i class="fal fa-heart"></i></span> by <a href="https://asterdio.com" target="_blank" style="color: rgba(255, 255, 255, 0.41);">Asterdio Inc.</a></span>
                                    </div>
                                    <!-- policy-box end-->
                                    <a href="#" class="to-top-btn to-top">Back to top <i class="fal fa-long-arrow-up"></i></a>
                                </div>
                            </div>
                            <div class="footer-canvas">
                                <div class="dots gallery__dots" data-dots=""></div>
                            </div>
                        </footer>
                    @endif

                    <!-- footer  end -->
                    <!-- share-wrapper-->
                    <div class="share-wrapper">
                        <div class="close-share-btn"><i class="fal fa-long-arrow-left"></i> Close</div>
                        <div class="share-container fl-wrap  isShare"></div>
                    </div>
                    <!-- share-wrapper  end -->
                </div>
            </div>
            <!-- wrapper end -->
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/core.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/scripts.js') }}"></script>
    </body>
</html>
