
@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Edit Side Setting </title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('public/dashboard/lib/quill/quill.snow.css') }}">
@endsection
@section('footers-nav')
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
                            <li class="breadcrumb-item"><a href="{{ route('footers') }}">Footers</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Side Setting And Footer</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">Edit Side Setting And Footer Info</h4>
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
                    <form id="footerForm" method="POST" action="{{ route('edit.footer') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset class="form-fieldset mg-b-30" style="min-height:790px;">
                            <legend>Fill the information</legend>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="image">Logo Setting</label>
                                    <input type="file" name="img" class="form-control-file" id="image" onchange="readURL(this)">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Preview Image</label>
                                    <img id="img" src="@if($footer){{ $footer->logo }}@else https://www.riobeauty.co.uk/images/product_image_not_found_thumb.gif @endif" alt="Preview logo" style="height:100px;display:block;">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Phone Number</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="phone"
                                    placeholder="Enter phone number" @if($footer)value="{{ old('phone', $footer->phone) }}" @else value="{{ old('phone') }}" @endif>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Email</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="email"
                                    placeholder="Enter email" @if($footer)value="{{ old('email', $footer->email) }}" @else value="{{ old('email') }}" @endif>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Location</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="location"
                                        placeholder="Enter Location" @if($footer)value="{{ old('location', $footer->location) }}" @else value="{{ old('location') }}" @endif>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Facebook</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="social_facebook"
                                        placeholder="Enter facebook link" @if($footer)value="{{ old('social_facebook', $footer->social_facebook) }}" @else value="{{ old('social_facebook') }}" @endif>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Instagram</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="social_instagram"
                                        placeholder="Enter instagram link" @if($footer)value="{{ old('social_instagram', $footer->social_instagram) }}" @else value="{{ old('social_instagram') }}" @endif>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Twitter</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="social_twitter"
                                        placeholder="Enter twitter link" @if($footer)value="{{ old('social_twitter', $footer->social_twitter) }}" @else value="{{ old('social_twitter') }}" @endif>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Linkedin</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="social_linkedin"
                                        placeholder="Enter linkedin link" @if($footer)value="{{ old('social_linkedin', $footer->social_linkedin) }}" @else value="{{ old('social_linkedin') }}" @endif>
                                </div>
                                <hr>
                                <div class="col-md-12 form-group">
                                    <label class="d-block">Footer Description</label>
                                    <div id="footer_desc" class="ht-300">@if($footer){!! old('footer_description', $footer->footer_description) !!}@else {!! old('footer_description') !!}@endif</div>
                                    <input type="hidden" name="footer_description">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div class="col-md-12 form-group">
                        <input type="submit" form="footerForm" class="btn btn-primary" value="save">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('public/dashboard/lib/quill/quill.min.js') }}"></script>
    <script>
        var quill_foot = new Quill('#footer_desc', {
            modules: {
                toolbar: [
                ['bold', 'italic'],
                [{ size: [ 'small', false, 'large', 'huge' ]}],
                ['link', 'blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['clean']
                ]
            },
            placeholder: 'Compose an awesome Information...',
            theme: 'snow'
        });
        var form = document.querySelector('form#footerForm');
        form.onsubmit = function() {
            // Populate hidden desc form on submit
            var description = document.querySelector('input[name=footer_description]');
            description.value = quill_foot.root.innerHTML
        };

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
    </script>
@endsection
