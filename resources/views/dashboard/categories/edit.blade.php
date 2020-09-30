
@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Edit Category</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('public/dashboard/lib/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dashboard/assets/css/dropzone.min.css') }}">
@endsection
@section('categories-nav')
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
                            <li class="breadcrumb-item"><a href="{{ route('categories') }}">Categories</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">Edit Category to show for web visitors</h4>
                </div>
                <form method="POST" action="{{ route('delete.category') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="cate_id" value="{{ $category->id }}">
                    <button type="submit" class="btn btn-sm btn-uppercase btn-danger pull-right" onclick="return confirm('Are you sure you want to delete this category?');">
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
                    <form method="POST" action="{{ route('edit.category') }}">
                        @csrf
                        @method('PUT')
                        <fieldset class="form-fieldset mg-b-30">
                            <legend>Fill the information</legend>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="category_id">Parent Category</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="">Select a Category</option>

                                        @foreach ($categories as $category_list)
                                            <option value="{{ $category_list->id }}" {{ $category->parent_id === $category_list->id ? 'selected' : '' }} {{ $category->id === $category_list->id ? 'disabled' : '' }}>{{ $category_list->name }}</option>
                                            @if ($category_list->children)
                                                @foreach ($category_list->children as $child)
                                                    <option value="{{ $child->id }}" {{ $category->parent_id === $child->id ? 'selected' : '' }} {{ $category->id === $child->id ? 'disabled' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        <option value="">No Parent Category</option>
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="name"
                                        placeholder="Enter category name" value="{{ old('name', $category->name) }}" required>
                                </div>

                                <div class="col-md-12 form-group">
                                    <input type="hidden" name="cate_id" value="{{ $category->id }}">
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
