@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Add New Projects</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('public/dashboard/lib/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard/assets/css/dropzone.min.css') }}">
@endsection
@section('projects-nav')
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
                            <li class="breadcrumb-item"><a href="{{ route('projects') }}">Projects</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Project</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">Add new Projects to show for web visitors</h4>
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
                    <form id="projectForm" method="POST" action="{{ route('new.project') }}" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="form-fieldset mg-b-30" style="min-height:350px;">
                            <legend>Fill the information</legend>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Project Name</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="name" placeholder="Enter project name" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Project Category</label>
                                    <select name="cate_id" class="form-control {{ $errors->has('cate_id') ? ' has-error' : '' }}" value="{{ old('cate_id') }}" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if(old('cate_id') == $category->id ) selected @endif>{{ $category->name }}</option>
                                            @if ($category->children)
                                                @foreach ($category->children as $child)
                                                <option value="{{ $child->id }}" {{ $child->id === old('cate_id') ? 'selected' : '' }}>
                                                    &nbsp;&nbsp;{{ $child->name }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="d-block">Project Description</label>
                                    <div id="editor_desc" class="ht-300">{!! old('desc') !!}</div>
                                    <input type="hidden" name="desc">
                                </div>

                                <div class="col-md-12 form-group" style="margin-top: 80px; margin-bottom: 80px;">
                                    <label class="d-block">Project Information</label>
                                    <div id="editor_info" class="ht-300">{!! old('info') !!}</div>
                                    <input type="hidden" name="info">
                                </div>
                            </div>
                        </fieldset>
                    </form>

                    <fieldset class="form-fieldset mg-b-30">
                        <legend>Upload Image Gallery</legend>
                        <form action="{{ route('upload.project.gallery') }}" method="POST" id="dropzone" class="dropzone" enctype="multipart/form-data">
                            @csrf
                            <div class="dz-message" data-dz-message><span>Drop photos or click here to upload!</span></div>

                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>

                        <input id="images" form="projectForm" type="hidden" name="images">
                    </fieldset>

                    <fieldset class="form-fieldset mg-b-30">
                        <legend>Project Thumbnail</legend>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="thumbnail">project Thumbnail Image</label>
                                <input type="file" name="thumbnail" form="projectForm" class="form-control-file" id="thumbnail" onchange="readURL(this)">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Preview Image</label>
                                <img id="img" src="https://www.riobeauty.co.uk/images/product_image_not_found_thumb.gif" alt="Preview project thumbnail image"
                                    style="height:100px;display:block;">
                            </div>
                        </div>
                    </fieldset>

                    <div class="col-md-12 form-group">
                        <input type="submit" form="projectForm" class="btn btn-primary" value="Save">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('public/dashboard/lib/quill/quill.min.js') }}"></script>
    <script src="{{ asset('public/dashboard/assets/js/dropzone.min.js') }}"></script>
    <script>
        var urlArray = [];
        var quill_desc = new Quill('#editor_desc', {
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
        var quill_info = new Quill('#editor_info', {
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
        var form = document.querySelector('form#projectForm');
        form.onsubmit = function() {
            // Populate hidden desc form on submit
            var desc = document.querySelector('input[name=desc]');
            desc.value = quill_desc.root.innerHTML;
            // Populate hidden info form on submit
            var info = document.querySelector('input[name=info]');
            info.value = quill_info.root.innerHTML;
        };
        Dropzone.autoDiscover = false;
        $(document).ready(function(){
            $("#dropzone").dropzone({
                dictDefaultMessage: 'Drop photos or click here to upload',
                paramName: 'file',
                url: '{{ route('upload.project.gallery') }}',
                clickable: true,
                enqueueForUpload: true,
                maxFilesize: 5,
                resizeWidth: 1280,
                resizeMethod: "contain",
                acceptedFiles: ".jpg,.jpeg,.png,.gif",
                uploadMultiple: false,
                addRemoveLinks: true,
                success: function (file, response) {
                    file.previewElement.id = response.image;
                    urlArray.push(response.image);
                    $('#images').val(urlArray);
                },
                removedfile: function (file) {
                    $.ajaxSetup({
                        headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                            }
                    });
                    $.ajax({
                        method: 'post',
                        url: '{{ route("ajax-removeProjectGallery")}}?url='+file.previewElement.id,
                        success: function(result) {
                            if(result == 'success'){
                                var success = true;
                            }
                        },
                        error: function(request,msg,error) {
                            console.log(error);
                        }
                    });
                    if(success = true){
                        var index = urlArray.indexOf(file.previewElement.id);
                        if (index !== -1) urlArray.splice(index, 1);
                        file.previewElement.remove();
                        $('#images').val(urlArray);
                    }
                }
            });
        });

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
