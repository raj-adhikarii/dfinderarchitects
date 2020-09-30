@extends('dashboard.layouts.secondary')
@section('title')
<title>Architects - Forgot Password</title>
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('public/dashboard/assets/css/dashforge.auth.css') }}">
@endsection

@section('content')
    <div class="content content-fixed content-auth-alt" style="margin-top:60px;">
        <div class="container d-flex justify-content-center ht-100p">
            <div class="mx-wd-300 wd-sm-450 ht-100p d-flex flex-column align-items-center justify-content-center">
                <div class="wd-80p wd-sm-300 mg-b-15"><img src="{{ asset('public/dashboard/assets/img/img18.png') }}" class="img-fluid" alt=""></div>
                <h4 class="tx-20 tx-sm-24">Reset your password</h4>
                <p class="tx-color-03 mg-b-30 tx-center">Enter your email address and we will send you a link to
                    reset your password.</p>
                <div class="wd-100p d-flex flex-column flex-sm-row mg-b-40">
                    <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
                        @csrf
                    </form>
                        <input type="text" name="email" form="forgotPasswordForm" class="form-control wd-sm-250 flex-fill @error('email') is-invalid @enderror"
                            placeholder="Enter email address">
                        <button type="submit" form="forgotPasswordForm" class="btn btn-brand-02 mg-sm-l-10 mg-t-10 mg-sm-t-0">Reset Password</button>
                </div>

            </div>
        </div><!-- container -->
    </div>
@endsection