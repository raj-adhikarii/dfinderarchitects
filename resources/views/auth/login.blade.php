@extends('dashboard.layouts.secondary')
@section('title')
<title>Architects - Login Dashboard</title>
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('public/dashboard/assets/css/dashforge.auth.css') }}">
@endsection

@section('content')
<div class="content content-fixed content-auth" style="margin-top:80px;">
    <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
            <div class="media-body align-items-center d-none d-lg-flex">
                <div class="mx-wd-600">
                    <img src="{{ asset('public/dashboard/assets/img/img15.png') }}" class="img-fluid" alt="">
                </div>
            </div><!-- media-body -->
            <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
                <div class="wd-100p">
                    <h3 class="tx-color-01 mg-b-5">Sign In</h3>
                    <p class="tx-color-03 tx-16 mg-b-40">Welcome back! Please signin to continue.</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter your password">
                        </div>
                        <button class="btn btn-brand-02 btn-block">Sign In</button>
                    </form>
                    <div class="tx-13 mg-t-20 tx-center">
                        Incase of any login issues, please contact system admin.</a>
                        <p>Or <a href="{{ route('index') }}"> Back to home</a></p>
                    </div>
                </div>
            </div><!-- sign-wrapper -->
        </div><!-- media -->
    </div><!-- container -->
</div>
@endsection
