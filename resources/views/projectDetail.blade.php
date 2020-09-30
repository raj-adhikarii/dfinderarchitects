@extends('layouts.main')
@section('title')
    <title>{{ config('app.name') }} | Project - {{ $project->name}}</title>
@endsection
@section('styles')
    <style>
        .four-column .gallery-item:nth-child(2){
            width: 66.667% !important;
        }
    </style>
@endsection
@section('projects-nav')
    {{ 'act-link' }}
@endsection

@section('content')

    <div class="content">
        <!--fixed-column-wrap-->
        <div class="fixed-column-wrap">
            <div class="pr-bg"></div>
            <!--fixed-column-wrap-content-->
            {{-- <div class="fixed-column-wrap-content">
                <div class="scroll-nav-wrap color-bg">
                    <div class="carnival">Scroll down</div>
                    <div class="snw-dec">
                        <div class="mousey">
                            <div class="scroller"></div>
                        </div>
                    </div>
                </div>
                <div class="bg" data-bg="{{ asset('public/images/bg/16.jpg') }}"></div>
                <div class="overlay"></div>
                <div class="progress-bar-wrap bot-element">
                    <div class="progress-bar"></div>
                </div>
                <!--fixed-column-wrap_title-->
                <div class="fixed-column-wrap_title first-tile_load">
                    <h2>{{ $project->name }}</h2>
                    <p>{!! substr(strip_tags($project->desc),0,100) !!}..</p>
                </div>
                <!--fixed-column-wrap_title end-->
                <div class="fixed-column-dec"></div>
            </div> --}}

            {{-- gallery slider --}}
             <div class="fixed-column-wrap-content small-padding">
                 <div id="tabs-container" class="fl-wrap">
                    {{-- <div class="tabs-counter">
                        <span>0</span>
                        <div class="tc_item" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">1</div>
                    </div> --}}
                    <ul class="tabs-menu fl-wrap">
                        <li class="selectedLava" style="padding-left: 10px;"><a href="#tab-1" data-tabnum="1">Gallery</a></li>
                    </ul>
                    <!-- tab-content-->

                    <div id="tab-1" class="tab-content" style="padding-left: 2px;padding-right:2px;">
                        <div class="column-wrap-media fl-wrap">

                            <div class="single-slider-wrap">

                                <div class="single-slider fl-wrap">

                                    <div class="swiper-container swiper-container-horizontal swiper-container-autoheight" style="cursor: grab;">
                                        <div class="swiper-wrapper lightgallery" style="transition-duration: 0ms; transform: translate3d(-1478px, 0px, 0px); height: 338px;">
                                            @foreach ($project->galleries as $image)
                                            <div class="swiper-slide hov_zoom swiper-slide-prev" data-swiper-slide-index="0" style="width: 739px;"><img src="{{ $image->source }}" alt=""><a href="{{ $image->source }}" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a></div>
                                            @endforeach
                                        </div>
                                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                    </div>

                                </div>

                                <div class="ss-slider-controls">
                                    <div class="ss-slider-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span></div>
                                    <div class="ss-slider-cont ss-slider-cont-prev color-bg" tabindex="0" role="button" aria-label="Previous slide"><i class="fal fa-long-arrow-left"></i></div>
                                    <div class="ss-slider-cont ss-slider-cont-next color-bg" tabindex="0" role="button" aria-label="Next slide"><i class="fal fa-long-arrow-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab-content end-->
                </div>
             </div>
            {{-- gallery slider end --}}

            <!--fixed-column-wrap-content end-->
        </div>
        <!--fixed-column-wrap end-->
        <!--column-wrap-->
        <div class="column-wrap">
            <!--column-wrap-container -->
            <div class="column-wrap-container fl-wrap">
                <div class="col-wc_dec">
                    <div class="pr-bg pr-bg-white"></div>
                </div>
                <!--section-->
                <section class="small-padding">
                    <div class="container">
                        <div class="split-sceen-content_title fl-wrap">
                            <div class="pr-bg pr-bg-white"></div>
                            <h3> {{ $project->name }}</h3>
                            <div class="parallax-header"> <a>{{ date('d M Y', strtotime($project->created_at)) }}</a><span>Category : </span><a>{{ $project->category->name }}</a></div>
                        </div>
                        <!--column-wrap-content-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="column-wrap-content fl-wrap skew">
                                    <!-- portfolio start -->
                                    <div class="gallery-items min-pad  lightgallery two-column fl-wrap">
                                        <!-- gallery-item-->
                                        <div class="gallery-item">
                                            <div class="grid-item-holder">
                                                <a href="{{ $project->thumbnail }}" class="fet_pr-carousel-box-media-zoom popup-image"><i
                                                    class="fal fa-search"></i></a>
                                                <img src="{{ $project->thumbnail }}" alt="{{ $project->name }}">

                                                {{-- <img src="{{ $project->thumbnail }}" alt="{{ $project->name }}"> --}}
                                            </div>
                                            <div class="pr-bg pr-bg-white"></div>
                                        </div>
                                        <!-- gallery-item end-->
                                    </div>
                                    <!-- portfolio end -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="tabs-container" class="fl-wrap skew" style="padding-left:10px;">
                                    <ul class="tabs-menu fl-wrap">
                                        <li class="selectedLava"><a href="#tab-1" data-tabnum="1">Project Information</a></li>
                                    </ul>
                                    <!-- tab-content-->
                                    <div id="tab-1" class="tab-content">
                                        @if($project->info){!! $project->info !!} @else <i>No information available.</i> @endif
                                        <div class="clearfix"></div>
                                        <span class="dec-border fl-wrap"></span>
                                    </div>
                                    <!-- tab-content end-->
                                </div>
                            </div>
                        </div>
                        <!--column-wrap-text-->
                        <div class="column-wrap-text">
                            <div class="pr-bg pr-bg-white"></div>
                        </div>
                        <!--column-wrap-text end-->
                        <div class="section-number right_sn">
                            <div class="pr-bg pr-bg-white"></div>
                            {{-- <span>0</span>1. --}}
                        </div>
                    </div>
                </section>

                <!--tabs-container-->
                {{-- <div id="tabs-container" class="fl-wrap" style="padding-left:30px;">
                    <ul class="tabs-menu fl-wrap">
                        <li class="selectedLava"><a href="#tab-1" data-tabnum="1">Projects Information</a></li>
                    </ul>
                    <!-- tab-content-->
                    <div id="tab-1" class="tab-content">
                        {!! $project->info !!}
                        <div class="clearfix"></div>
                        <span class="dec-border fl-wrap"></span>
                    </div>
                    <!-- tab-content end-->
                </div> --}}
                <!-- tabs-container end-->

                <!--tabs-container-->
                <div id="tabs-container" class="fl-wrap" style="padding-left:30px;">
                    <ul class="tabs-menu fl-wrap">
                        <li class="selectedLava"><a href="#tab-1" data-tabnum="1">Project Description</a></li>
                    </ul>
                    <!-- tab-content-->
                    <div id="tab-1" class="tab-content">
                        @if($project->desc){!! $project->desc !!} @else <i>No description available.</i> @endif
                        <div class="clearfix"></div>
                        <span class="dec-border fl-wrap"></span>
                    </div>
                    <!-- tab-content end-->
                </div>
                <!-- tabs-container end-->
            </div>
            <!--column-wrap-container end-->
        </div>

        <!--column-wrap end-->
        <div class="limit-box fl-wrap"></div>
    </div>

@endsection
