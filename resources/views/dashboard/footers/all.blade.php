@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Footer and Side Setting</title>
@endsection
@section('footers-nav')
    {{ 'active' }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('public/dashboard/lib/dataTables/datatables.css') }}">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
@endsection

@section('content')
    <div class="content content-fixed" style="min-height:calc(100vh - 106px);">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Footer and Side Setting</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">
                        Footer And Side Setting Information
                    </h4>
                </div>
                <div class="d-none d-md-block">
                    <a href="{{ route('edit-footer') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase">
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
                    <table style="width:100%">
                        <tr>
                            <th>Phone</th>
                            <td>@if($footer) {{$footer->phone}} @endif</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>@if($footer) {{$footer->email}} @endif</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>@if($footer) {{$footer->location}} @endif</td>
                        </tr>
                        <tr>
                            <th>Facebook</th>
                            <td>@if($footer) {{$footer->social_facebook}} @endif</td>
                        </tr>
                        <tr>
                            <th>Twitter</th>
                            <td>@if($footer) {{$footer->social_twitter}} @endif</td>
                        </tr>
                        <tr>
                            <th>Instagram</th>
                            <td>@if($footer) {{$footer->social_instagram}} @endif</td>
                        </tr>
                        <tr>
                            <th>Linkedin</th>
                            <td>@if($footer) {{$footer->social_linkedin}} @endif</td>
                        </tr>
                    </table>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-4">
                            <h5><b>Logo</b></h5>
                            @if($footer)<img src="{{ $footer->logo }}" alt="logo" style="height: 100px; object-fit: cover;">@else <i>No image
                                found</i> @endif
                        </div>
                        <div class="col-md-8">
                            <h5><b>Footer Description</b></h5>
                            <p>@if($footer){!! substr(strip_tags($footer->footer_description),0,300) !!}..@endif</p>
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
