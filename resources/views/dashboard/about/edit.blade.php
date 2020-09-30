
@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Edit About Information</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('public/dashboard/lib/quill/quill.snow.css') }}">
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
                            <li class="breadcrumb-item"><a href="{{ route('abouts') }}">About</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit About Information</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">Edit About Information</h4>
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
                    <form id="aboutForm" method="POST" action="{{ route('edit.about') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset class="form-fieldset mg-b-30" style="min-height:700px;">
                            <legend>Fill the information</legend>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="d-block">About Description</label>
                                    <div id="about_desc" class="ht-300">@if($about){!! old('description', $about->description) !!}@else {!! old('description') !!}@endif</div>
                                    <input type="hidden" name="description">
                                </div>

                                <div class="col-md-12 form-group" style="margin-top: 80px;">
                                    <label class="d-block">Our Phylosophy</label>
                                    <div id="about_phy" class="ht-300">@if($about){!! old('phylosophy', $about->phylosophy) !!}@else {!! old('phylosophy') !!}@endif</div>
                                    <input type="hidden" name="phylosophy">
                                </div>

                                <div class="col-md-12 form-group" style="margin-top: 80px;">
                                    <label class="d-block">Our Vision And Mision</label>
                                    <div id="about_vision" class="ht-300">@if($about){!! old('vision', $about->vision) !!}@else {!! old('vision') !!}@endif</div>
                                    <input type="hidden" name="vision">
                                </div>
                                <div class="col-md-6 form-group mg-t-100">
                                    <label for="image">Banner Image</label>
                                    <input type="file" name="img" class="form-control-file" id="image" onchange="readURL(this)">
                                </div>
                                <div class="col-md-6 form-group mg-t-100">
                                    <label>Preview Image</label>
                                    <img id="img" src="@if($about){{ $about->image }}@else https://www.riobeauty.co.uk/images/product_image_not_found_thumb.gif @endif" alt="Preview event thumbnail image" style="height:100px;display:block;">
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('public/dashboard/lib/quill/quill.min.js') }}"></script>
    <script>
        var quill_desc = new Quill('#about_desc', {
            modules: {
                toolbar: [
                ['bold', 'italic'],
                [{ size: [ 'small', false, 'large', 'huge' ]}],
                [{ align: '' }, { align: 'center' }, { align: 'right' }, { align: 'justify' }],
                ['link', 'blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['clean']
                ]
            },
            placeholder: 'Compose an awesome description...',
            theme: 'snow'
        });
        var quill_phy = new Quill('#about_phy', {
            modules: {
                toolbar: [
                ['bold', 'italic'],
                [{ size: [ 'small', false, 'large', 'huge' ]}],
                [{ align: '' }, { align: 'center' }, { align: 'right' }, { align: 'justify' }],
                ['link', 'blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['clean']
                ]
            },
            placeholder: 'Compose an awesome Information...',
            theme: 'snow'
        });
        var quill_vision = new Quill('#about_vision', {
            modules: {
                toolbar: [
                ['bold', 'italic'],
                [{ size: [ 'small', false, 'large', 'huge' ]}],
                [{ align: '' }, { align: 'center' }, { align: 'right' }, { align: 'justify' }],
                ['link', 'blockquote', 'code-block'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['clean']
                ]
            },
            placeholder: 'Compose an awesome Information...',
            theme: 'snow'
        });
        var form = document.querySelector('form#aboutForm');
        form.onsubmit = function() {
            // Populate hidden desc form on submit
            var description = document.querySelector('input[name=description]');
            description.value = quill_desc.root.innerHTML;
            // Populate hidden info form on submit
            var phylosophy = document.querySelector('input[name=phylosophy]');
            phylosophy.value = quill_phy.root.innerHTML;
            // Populate hidden info form on submit
            var vision = document.querySelector('input[name=vision]');
            vision.value = quill_vision.root.innerHTML;
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
