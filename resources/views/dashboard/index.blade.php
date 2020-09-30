@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Admin Dashboard</title>
@endsection
@section('dashboard-nav')
    {{ 'active' }}
@endsection

@section('content')
    <div class="content content-fixed" style="height: calc(100vh - 106px); display: flex; align-items: center;">
        <div class="container">
            <div class="row" style="margin-bottom: 50px;">
                <div class="col-md-12 text-center">
                    <h3>Hello Admin, Welcome to Dashboard.</h3>
                    <small>Latest updates for {{ date('d M Y', strtotime(now())) }}</small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body">
                        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Projects</h6>
                        <div class="d-flex d-lg-block d-xl-flex align-items-end">
                            <h2 class="tx-normal tx-primary tx-rubik mg-b-10 mg-r-5 lh-5">{{ \App\Project::count() }}</h2>
                        </div>
                        <a href="{{ route('projects') }}">View all projects <i data-feather="arrow-right" style="height: 16px; width: 16px; margin-left: 5px;"></i> </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body">
                        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Project Varieties</h6>
                        <div class="d-flex d-lg-block d-xl-flex align-items-end">
                            <h2 class="tx-normal tx-info tx-rubik mg-b-10 mg-r-5 lh-5">{{ \App\Category::count() }}</h2>
                        </div>
                        <a href="{{ route('categories') }}">View all categories <i data-feather="arrow-right" style="height: 16px; width: 16px; margin-left: 5px;"></i> </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body">
                        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Events</h6>
                        <div class="d-flex d-lg-block d-xl-flex align-items-end">
                            <h2 class="tx-normal tx-warning tx-rubik mg-b-10 mg-r-5 lh-5">{{ \App\Event::count() }}</h2>
                        </div>
                        <a href="{{ route('events') }}">View all events <i data-feather="arrow-right" style="height: 16px; width: 16px; margin-left: 5px;"></i> </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body">
                        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Contact Queries</h6>
                        <div class="d-flex d-lg-block d-xl-flex align-items-end">
                            <h2 class="tx-normal tx-success tx-rubik mg-b-10 mg-r-5 lh-5">{{ \App\Contact::count() }}</h2>
                        </div>
                        <a href="{{ route('contacts') }}">View all contact queries <i data-feather="arrow-right" style="height: 16px; width: 16px; margin-left: 5px;"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
