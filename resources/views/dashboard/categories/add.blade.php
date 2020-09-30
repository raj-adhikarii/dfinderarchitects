@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Add New Category</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('categories') }}">Category</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Category</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">Add new Project Category</h4>
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
                    <form method="POST" action="{{ route('new.category') }}">
                        @csrf
                        <fieldset class="form-fieldset mg-b-30">
                            <legend>Fill the information</legend>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="parent_id">Parent Category</label>
                                    <select class="form-control" name="parent_id" required>
                                        <option value="">Select a Category</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id === old('parent_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @if ($category->children)
                                                @foreach ($category->children as $child)
                                                    <option value="{{ $child->id }}" {{ $child->id === old('parent_id') ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        <option value="">No Parent Category</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" name="name" placeholder="Enter category name" value="{{ old('name') }}" required>
                                </div>

                                <div class="col-md-12 form-group">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
