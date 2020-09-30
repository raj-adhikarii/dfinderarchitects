@extends('layouts.main')
@section('title')
    <title>{{ config('app.name') }} | Events</title>
@endsection
@section('styles')
    <style>
        .column-wrap-media{
            height:525px;
            overflow:hidden
        }
        .column-wrap-media img{
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    </style>
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
                <div class="bg" data-bg="{{ asset('public/images/bg/8.jpg') }}"></div>
                <div class="overlay"></div>
                <div class="progress-bar-wrap bot-element">
                    <div class="progress-bar"></div>
                </div>
                <!--fixed-column-wrap_title-->
                <div class="fixed-column-wrap_title first-tile_load">
                    <h2>Events</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
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
                @forelse ($events as $event)
                    <!--section-->
                    <section   class="small-padding">
                        <div class="container">
                            <div class="split-sceen-content_title fl-wrap">
                                <div class="pr-bg pr-bg-white"></div>
                                <h3><a href="{{ route('event-detail', $event->id) }}">{{ $event->name }}</a></h3>
                            </div>
                            <div class="column-wrap-content fl-wrap">
                                <div class="column-wrap-media fl-wrap">
                                    <div class="pr-bg pr-bg-white"></div>
                                    <a href="{{ route('event-detail', $event->id) }}"><img src="{{ $event->thumbnail }}"  class="Event thumbnail" alt=""></a>
                                </div>
                                <div class="serv-text fl-wrap">
                                    <div class="pr-bg pr-bg-white"></div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p>{!! substr(strip_tags($event->desc),0,100) !!}..</p>
                                            <p><a href="{{ route('event-detail', $event->id) }}" class="view-detail">View Detail</a></p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="serv-price-wrap dark-bg"><span>Date</span>{{ date('Y-m-d', strtotime($event->date)) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section-number right_sn">
                                <div class="pr-bg pr-bg-white"></div>
                                <span>0</span>1.
                            </div>
                        </div>
                    </section>
                    <!--section end-->
                    <div class="section-separator"></div>
                @empty
                    <section class="small-padding">
                        <div class="container">
                            <h4>No events available</h4>
                        </div>
                    </section>
                @endforelse
            </div>
            <!--column-wrap-container end-->
        </div>
        <!--column-wrap end-->
        <div class="limit-box fl-wrap"></div>
    </div>

@endsection
