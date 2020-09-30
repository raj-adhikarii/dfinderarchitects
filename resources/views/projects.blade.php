@extends('layouts.main')
@section('title')
    <title>{{ config('app.name') }} | Projects</title>
@endsection
@section('projects-nav')
    {{ 'act-link' }}
@endsection

@section('content')
    <div class="content">
        <section class="no-padding-bottom" id="sec1">
            <div class="col-wc_dec col-wc_dec2">
                <div class="pr-bg pr-bg-white"></div>
            </div>
            <div class="container">
                <div class="pr-bg pr-bg-white"></div>
                <div class="inline-filter-panel fl-wrap">
                    <div class="inline-filter_title color-bg">
                        Filter <i class="fal fa-long-arrow-right"></i>
                    </div>
                    <div class="gallery-filters">
                        <a href="#" class="gallery-filter gallery-filter-active" data-filter="*">All Works</a>
                        @foreach ($categories as $category)
                        <a href="#" class="gallery-filter " data-filter=".{{ strtolower(str_replace(' ', '-', $category->name)) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    <div class="folio-counter">
                        <div class="num-album"></div>
                        <div class="all-album"></div>
                    </div>
                </div>
                <!-- portfolio start -->
                <div class="gallery-items min-pad three-column fl-wrap ff_panel-conainer">
                    @forelse ($projects as $project)
                        <!-- gallery-item-->
                        <div class="gallery-item {{ strtolower(str_replace(' ', '-', $project->category->name)) }}">
                            <div class="grid-item-holder">
                                <img src="{{ $project->thumbnail }}" alt="{{ $project->name }}"
                                    style="height:250px; object-fit:cover;">
                                <a class="grid-det" style="display: block;" href="{{ route('project-detail', $project->id) }}">
                                {{-- <div class="grid-det"> --}}
                                    <div class="grid-det_category">
                                        <a style="position: relative; top: 20px;" href="{{ route('project-detail', $project->id) }}"> {{ $project->category->name }}</a>
                                    </div>
                                    <div class="grid-det-item">
                                        <a style="position: relative; bottom: 20px;" href="{{ route('project-detail', $project->id) }}"
                                            class="ajax grid-det_link">{{ $project->name }} <i class="fal fa-long-arrow-right"></i></a>
                                    </div>
                                {{-- </div> --}}
                                </a>
                            </div>
                            <div class="pr-bg pr-bg-white"></div>
                        </div>
                        <!-- gallery-item end-->

                    @empty
                        <h4>No projects available</h4>
                    @endforelse
                </div>
                <!-- portfolio end -->
                <div class="order-wrap dark-bg fl-wrap">
                    <div class="pr-bg pr-bg-white"></div>
                    <h4>Need any consultation for your project? </h4>
                    <a href="{{ route('home-contacts',) }}" class="ajax">Get In Touch <i class="fal fa-envelope"></i></a>
                </div>
            </div>
        </section>
        <!--column-wrap end-->
        <div class="limit-box fl-wrap"></div>
    </div>
@endsection
