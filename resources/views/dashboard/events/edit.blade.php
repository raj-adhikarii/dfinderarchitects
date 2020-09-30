@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Edit Event</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('public/dashboard/lib/quill/quill.snow.css') }}">
@endsection
@section('events-nav')
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
                            <li class="breadcrumb-item"><a href="{{ route('events') }}">Events</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">Update Event to show for web visitors</h4>
                </div>
                <form method="POST" action="{{ route('delete.event') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <button type="submit" class="btn btn-sm btn-uppercase btn-danger pull-right" onclick="return confirm('Are you sure you want to delete this event?');">
                        <i data-feather="trash-2" class="wd-10 mg-r-5"></i>Delete
                    </button>
                </form>
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
                    <form method="POST" action="{{ route('edit.event') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset class="form-fieldset mg-b-30" style="min-height:350px;">
                            <legend>Fill the information</legend>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Event Name</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="name" placeholder="Enter event name" value="{{ old('name',$event->name) }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="d-block">Event Date</label>
                                    <input type="date" class="form-control {{ $errors->has('date') ? ' has-error' : '' }}" name="date" placeholder="Enter event date" value="{{ old('date',$event->date) }}" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="d-block">Event Description</label>
                                    <div id="editor" class="ht-300">{!! old('desc', $event->desc) !!}</div>
                                    <input type="hidden" name="desc">
                                </div>
                                <div class="col-md-6 form-group mg-t-100">
                                    <label for="image">Event Thumbnail Image</label>
                                    <input type="file" name="img" class="form-control-file" id="image" onchange="readURL(this)">
                                </div>
                                <div class="col-md-6 form-group mg-t-100">
                                    <label>Preview Image</label>
                                    <img id="img" src="{{ $event->thumbnail }}" alt="Preview event thumbnail image" style="height:100px;display:block;">
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group">
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('public/dashboard/lib/quill/quill.min.js') }}"></script>
    <script>
        var quill = new Quill('#editor', {
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

        var form = document.querySelector('form');
        form.onsubmit = function() {
            // Populate hidden form on submit
            var desc = document.querySelector('input[name=desc]');
            desc.value = quill.root.innerHTML;
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
