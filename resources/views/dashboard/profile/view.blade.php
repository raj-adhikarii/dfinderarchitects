@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - User Profile</title>
@endsection

@section('content')
    <div class="content content-fixed" style="min-height:calc(100vh - 106px);">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">User Information </h4>
                </div>
                <a href="{{ route('edit-profile') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase pull-right">
                    <i data-feather="edit-3" class="wd-10 mg-r-5"></i> Edit Profile
                </a>
            </div>
            <div class="row row-xs">
                <div class="col-md-12 mg-t-10 mg-sm-t-0">
                    <div class="row">
                        <div class="col-md-12">
                            @if(Session::has('success'))
                                <div class="alert alert-success" id="alert" role="alert">{{ Session::get('success') }}</div>
                            @elseif(Session::has('error'))
                                <div class="alert alert-danger" id="alert" role="alert">{{ Session::get('success') }}</div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="user-profile-image">
                                <img src="{{ $user->profile }}">
                                <div class="overlay">
                                    <div class="user-profile-image-action">
                                        <a href="{{ route('edit-profile') }}" style="color:#fff;font-size:16px;" class="btn btn-outline-danger"><i data-feather="edit"></i> Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><b>Email:</b></p>
                                    <p><i>{{ $user->email }}</i></p></br>
                                    <p><b>Name:</b></p>
                                    <p><i>{{ $user->name }}</i></p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>Joined:</b></p>
                                    <p><i>{{ date('Y-m-d', strtotime($user->created_at)) }}</i></p></br>
                                    <p><b>Last Updated:</b></p>
                                    <p><i>{{ date('Y-m-d', strtotime($user->updated_at)) }}</i></p>
                                </div>
                            </div>
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