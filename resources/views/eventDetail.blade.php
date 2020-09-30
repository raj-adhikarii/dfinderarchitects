@extends('layouts.main')
@section('title')
    <title>{{ config('app.name') }} | Event - {{ $event->name}}</title>
@endsection
@section('events-nav')
    {{ 'act-link' }}
@endsection

@section('content')

    <div class="content">
        <!--fixed-column-wrap-->
        <div class="fixed-column-wrap">
            <div class="pr-bg"></div>
            <!--fixed-column-wrap-content-->
            <div class="fixed-column-wrap-content">
                <div class="scroll-nav-wrap color-bg">
                    <div class="carnival">Scroll down</div>
                    <div class="snw-dec">
                        <div class="mousey">
                            <div class="scroller"></div>
                        </div>
                    </div>
                </div>
                <div class="bg" data-bg="{{ asset('public/images/bg/12.jpg') }}"></div>
                <div class="overlay"></div>
                <div class="progress-bar-wrap bot-element">
                    <div class="progress-bar"></div>
                </div>
                <!--fixed-column-wrap_title-->
                <div class="fixed-column-wrap_title first-tile_load">
                    <h2>{{ $event->name }}</h2>
                </div>
                <!--fixed-column-wrap_title end-->
                <div class="fixed-column-dec"></div>
            </div>
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
                <div class="col-wc_dec col-wc_dec2">
                    <div class="pr-bg pr-bg-white"></div>
                </div>
                <!--section-->
                <section id="sec1" class="small-padding">
                    <div class="container">
                        <div class="split-sceen-content_title fl-wrap">
                            <div class="pr-bg pr-bg-white"></div>
                            <h3>{{ $event->name }}</h3>
                            <p style="padding:0;"><small>{{ date('Y-M-d, D', strtotime($event->date)) }}</p>
                            <p></p>
                        </div>
                        <div class="column-wrap-content fl-wrap">
                            <div class="column-wrap-media fl-wrap">
                                <div class="pr-bg pr-bg-white"></div>
                                <img src="{{ $event->thumbnail }}"  class="Event Thumbnail" alt="">
                            </div>
                            <div class="column-wrap-text">
                                {!! $event->desc !!}
                            </div>
                        </div>
                    </div>
                </section>


            </div>
            <!--column-wrap-container end-->
        </div>
        <!--column-wrap end-->
        <div class="limit-box fl-wrap"></div>
    </div>

@endsection
