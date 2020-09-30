@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Abouts</title>
@endsection
@section('abouts-nav')
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
                            <li class="breadcrumb-item active" aria-current="page">Abouts</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">About Information.</h4>
                </div>
                <div class="d-none d-md-block">
                    <a href="{{ route('edit-about') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase">
                        <i data-feather="plus" class="wd-10 mg-r-5"></i> Edit Information
                    </a>
                </div>
            </div>
            <div class="row row-xs">
                <div class="col-md-12">
                    @if(Session::has('success'))
                        <div class="alert alert-success" id="alert" role="alert">{{ Session::get('success') }}</div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger" id="alert" role="alert">{{ Session::get('error') }}</div>
                    @endif
                </div>
                <div class="media-object-list col-sm-12 mg-t-10 mg-sm-t-0 mg-b-30">
                    <h4>About Us</h4>
                    <small>@if($about){!! substr(strip_tags($about->description),0,500) !!}...@else <i>No information</i>@endif</small>
                    <h4>Our Phylosophy</h4>
                    <small>@if($about){!! substr(strip_tags($about->phylosophy),0,500) !!}...@else <i>No information</i>@endif</small>
                    <h4>Our Vision And Mission</h4>
                    <small>@if($about){!! substr(strip_tags($about->vision),0,500) !!}...@else <i>No information</i>@endif</small>

                   <div>
                        <h4>Banner</h4>
                        <div class="about-banner">
                            @if($about && $about->image)<img src="{{ $about->image }}" alt="about image" style="width: 100%">@else <i>No image found</i> @endif
                        </div>
                    </div>
                </div>
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
