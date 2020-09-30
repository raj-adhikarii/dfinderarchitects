@extends('dashboard.layouts.secondary')
@section('title')
<title>Architects - Reset Password</title>
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('public/dashboard/assets/css/dashforge.auth.css') }}">
@endsection

@section('content')
    <div class="content content-fixed content-auth" style="margin-top:60px;">
        <div class="container">
            <div class="media align-items-stretch justify-content-center ht-100p">
                <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
                    <div class="wd-100p">
                        <h4 class="tx-color-01 mg-b-5">Reset your passsword</h4>
                        <p class="tx-color-03 tx-16 mg-b-40">Enter new password.</p>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label>Email address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between mg-b-5">
                                    <label class="mg-b-0-f">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between mg-b-5">
                                    <label class="mg-b-0-f">Confirm Password</label>
                                </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Password Confirmation">
                            </div>

                            <button type="submit" class="btn btn-brand-02 btn-block">Reset</button>
                        </form>
                    </div>
                </div><!-- sign-wrapper -->
                <div class="media-body pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
                    <div class="mx-lg-wd-500 mx-xl-wd-550">
                        <img src="{{ asset('public/dashboard/assets/img/img16.png') }}" class="img-fluid" alt="">
                    </div>
                </div><!-- media-body -->
            </div><!-- media -->
        </div><!-- container -->
    </div>
@endsection