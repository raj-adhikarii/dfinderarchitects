@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Categories information</title>
@endsection
@section('categories-nav')
    {{ 'active' }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('public/dashboard/lib/dataTables/datatables.css') }}">
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
@endsection

@section('content')
    <div class="content content-fixed" style="min-height:calc(100vh - 106px);">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Categories</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">List of all Categories.</h4>
                </div>
                <div class="d-none d-md-block">
                    <a href="{{ route('new-category') }}" class="btn btn-sm pd-x-15 btn-white btn-uppercase">
                        <i data-feather="plus" class="wd-10 mg-r-5"></i> New Category
                    </a>
                </div>
            </div>
            <div class="row row-xs">
                <div class="col-md-12">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <ul class="row">
                                <li class="col-md-6">{{session('error')}}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Categories</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($categories as $category)
                                        <li class="list-group-item" style="padding-right: 0;">
                                            <div class="d-flex justify-content-between">
                                                {{ $category->name }}

                                                <div class="button-group d-flex">
                                                    <a href="{{ route('edit-category',$category->id) }}" class="btn btn-outline-warning mr-2"> Edit</a>

                                                    <form action="{{ route('delete.category') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="cate_id" value="{{ $category->id}}">
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                                                    </form>
                                                </div>
                                            </div>

                                            @if ($category->children)
                                            <ul class="list-group mt-2">
                                                @foreach ($category->children as $child)
                                                <li class="list-group-item" style="padding-right: 0;">
                                                    <div class="d-flex justify-content-between">
                                                        {{ $child->name }}

                                                        <div class="button-group d-flex">
                                                            <a href="{{ route('edit-category',$child->id) }}" class="btn btn-sm btn-outline-warning mr-2" style="height: 30px;"> Edit</a>

                                                            <form action="{{ route('delete.category') }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="cate_id" value="{{ $child->id}}">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Create Category</h3>
                                </div>

                                <div class="card-body">
                                    <form action="{{ route('new.category') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <select class="form-control" name="parent_id">
                                                <option value="">Select Parent Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @if ($category->children)
                                                        @foreach ($category->children as $child)
                                                            <option value="{{ $child->id }}" {{ $child->id === old('category_id') ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <option value="">No Parent Category</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Category Name" required>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
