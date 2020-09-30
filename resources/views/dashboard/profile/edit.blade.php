@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Update User Profile</title>
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
                    <h4 class="mg-b-0 tx-spacing--1">Update User Information </h4>
                </div>
            </div>
            <div class="row row-xs">
                <div class="col-md-12 mg-t-10 mg-sm-t-0">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <ul class="row">
                                @foreach(session('error')->all() as $error)
                                    <li class="col-md-6">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 mg-b-30">
                            <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <fieldset class="form-fieldset mg-b-30 mg-t-20">
                                    <legend>Enter User Information</legend>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">    
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" disabled value="{{ $user->email }}">    
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="image">Event Thumbnail Image</label>
                                            <input type="file" name="img" class="form-control-file" id="image" onchange="readURL(this)">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Preview Image</label>
                                            <img id="img" src="{{ $user->profile }}" alt="Preview event thumbnail image" style="height:150px;display:block;">
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                        <div class="col-md-12">
                            <form action="{{ route('update.password') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <fieldset class="form-fieldset mg-b-30 mg-t-20">
                                    <legend>Update Password</legend>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="old_password">Old Password</label>
                                            <input type="password" class="form-control" name="old_password" placeholder="Enter Current Password">    
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6 form-group">
                                            <label for="password">New Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Enter New Password">    
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6 form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">    
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function readURL(input) {
            var url = input.value;
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }else{
                $('#img').attr('src', 'https://www.riobeauty.co.uk/images/product_image_not_found_thumb.gif');
            }
        }
    </scripts>
@endsection