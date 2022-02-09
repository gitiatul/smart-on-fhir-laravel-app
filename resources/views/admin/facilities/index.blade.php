@extends('layouts.master')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts.sessions')
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">All Facilities
                        <div class="card-tools">
                            <a class="btn btn-success btn-sm" href="{{ url('/admin/facilities/create') }}">
                                <i class="fas fa-plus fa-fw"></i> Add
                            </a>
                            <a class="btn btn-danger btn-sm" href="{{ url('/admin/home') }}">
                                <i class="fas fa-undo fa-fw"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="container-fluid">
                            <div class="row">
                                <div style="overflow:auto">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Facility Id</th>
                                                <th>Facility App Id</th>
                                                <th>Facility Name</th>
                                                <th>Facility Owner Name</th>
                                                <th>Created</th>
                                                <th>Facility Status</th>
                                                <th style="width: 15%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('css')
    <link href="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css"
        rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">



@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
    <script>
        $('table').DataTable({
            responsive: true,
            "bAutoWidth": false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.facilities.list') }}",
            columns: [{
                    data: 'facility_id',
                    name: 'facility_id'
                },
                {
                    data: 'facility_app_id',
                    name: 'facility_app_id'
                },
                {
                    data: 'facility_name',
                    name: 'facility_name'
                },
                {
                    data: 'facility_owner_name',
                    name: 'facility_owner_name'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'facility_status',
                    name: 'facility_status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: false
                },
            ]
        });
    </script>
@endpush
