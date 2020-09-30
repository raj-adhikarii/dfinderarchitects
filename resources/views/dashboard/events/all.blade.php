@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Events</title>
@endsection
@section('events-nav')
    {{ 'active' }}
@endsection

@section('content')
    <div class="content content-fixed" style="min-height:calc(100vh - 106px);">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Events</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">List of all Events organised.</h4>
                </div>
                <div class="d-none d-md-block">
                    <a href="{{ route('new-event') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase">
                        <i data-feather="plus" class="wd-10 mg-r-5"></i> New Event
                    </a>
                </div>
            </div>
            <div class="row row-xs">
                <div class="col-md-12">
                    @if(Session::has('success'))
                        <div class="alert alert-success" id="alert" role="alert">{{ Session::get('success') }}</div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger" id="alert" role="alert">{{ Session::get('success') }}</div>
                    @endif
                </div>
                @forelse($events as $event)
                    <div class="media-object-list col-sm-6 col-lg-4 mg-t-10 mg-sm-t-0 mg-b-30">
                        <h4>{{ $event->name }}</h4>
                        <small>{!! substr(strip_tags($event->desc),0,100) !!}..</small>
                        <div class="img-container">
                            <img src="{{ $event->thumbnail }}" alt="Events Thumbnail">

                            <div class="overlay">
                                <div class="img-container-action">
                                    <a href="{{ route('edit-event',$event->id) }}" style="color:#fff;font-size:16px;" class="btn btn-outline-danger"><i data-feather="edit"></i> Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <p>No events available yet. Please create new event.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('scripts')
   <script data-cfasync="false">
        $("#alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#alert").alert('close');
            });
    </script>
@endsection
