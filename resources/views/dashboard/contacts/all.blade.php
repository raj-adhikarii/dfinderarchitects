@extends('dashboard.layouts.master')
@section('title')
    <title>Architects - Contact Queries</title>
@endsection
@section('contacts-nav')
    {{ 'active' }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('public/dashboard/lib/dataTables/datatables.css') }}">
@endsection

@section('content')
    <div class="content content-fixed" style="min-height:calc(100vh - 106px);">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contacts</li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0 tx-spacing--1">List of all contact queries send by web visitors.</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="row mb-0">
                            <li class="col-md-6">{{session('error')}}</li>
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <ul class="row mb-0">
                            <li class="col-md-6">{{session('success')}}</li>
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row row-xs">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="display table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td data-toggle="modal" data-data="{{$contact}}" data-target="#contactModal" style="cursor:pointer;">{{ $loop->iteration }}</td>
                                    <td data-toggle="modal" data-data="{{$contact}}" data-target="#contactModal" style="cursor:pointer;">{{ $contact->name }}</td>
                                    <td data-toggle="modal" data-data="{{$contact}}" data-target="#contactModal" style="cursor:pointer;">{{ $contact->phone }}</td>
                                    <td data-toggle="modal" data-data="{{$contact}}" data-target="#contactModal" style="cursor:pointer;">{{ $contact->email }}</td>
                                    <td data-toggle="modal" data-data="{{$contact}}" data-target="#contactModal" style="cursor:pointer;">{{ $contact->subject }}</td>
                                    <td data-toggle="modal" data-data="{{$contact}}" data-target="#contactModal" style="cursor:pointer;">{{ substr($contact->message,0,50) }}..</td>
                                    <td data-toggle="modal" data-data="{{$contact}}" data-target="#contactModal" style="cursor:pointer;">{{ date('Y-m-d',strtotime($contact->created_at) ) }}</td>
                                    <td>
                                        @if($contact->followed)
                                            <button class="btn btn-sm btn-outline-success" disabled> Followed</button>
                                        @else
                                            <button class="btn btn-sm btn-outline-danger" disabled> Unfollowed</button>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('toggle.contact.status') }}">
                                            @csrf
                                            @method('PATCH')
                                            @if($contact->followed)
                                                <button type="submit" class="btn btn-sm btn-danger mb-10" > Mark as Unfollowed</button>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-success mb-10" > Mark as Followed</button>
                                            @endif
                                            <input type="hidden" name="contact_id" value="{{ $contact->id}}">
                                        </form>
                                        <form method="POST" action="{{ route('delete.contact.query') }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="contact_id" value="{{ $contact->id}}">
                                            <button type="submit" class="btn btn-sm btn-danger" > Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Contact Query Detail</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5><b>Name : </b><span id="contactName"></span></h5>
                    <h5><b>Phone : </b><span id="contactPhone"></span></h5>
                    <h5><b>Email : </b><span id="contactEmail"></span></h5>
                    <h5><b>Subject : </b><span id="contactSubject"></span></h5>
                    <h5><b>Message</b></h5>
                    <p id="contactMessage"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('public/dashboard/lib/dataTables/datatables.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable({
                responsive: true,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });
        });
    </script>
    <script>
        $('#contactModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var contactQuery = button.data('data') // Extract info from data-* attributes
            var modal = $(this);
            modal.find('#contactName').text( contactQuery.name );
            modal.find('#contactPhone').text( contactQuery.phone );
            modal.find('#contactEmail').text( contactQuery.email );
            modal.find('#contactSubject').text( contactQuery.subject );
            modal.find('#contactMessage').text( contactQuery.message );
        })
    </script>
@endsection
