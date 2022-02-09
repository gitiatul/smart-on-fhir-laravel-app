@extends('layouts.master')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts.sessions')
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Audit Logs
                    </div>
                    <div class="card-body">

                        <div class="container-fluid">
                            <div class="row">
                                <div style="overflow:auto">
                                    <table class="table table-bordered table-hover data-table">
                                        <thead>
                                            <tr>
                                                <th>AuditLog Id</th>
                                                <th>Request Url</th>
                                                <th>Request Method</th>
                                                <th>Ip Address</th>
                                                <th>Browser Useragent</th>
                                                <th>Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-xl" id="showModal" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    Audit Log: <strong id="auditlog_id"> </strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 20%">Request Token</th>
                                    <td>
                                        <div id="request_token">
                                            <div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 20%">Request Url</th>
                                    <td>
                                        <div id="request_url"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 20%">Request Method</th>
                                    <td>
                                        <div id="request_method"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 20%">Request Query</th>
                                    <td>
                                        <div id="request_query"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 20%">Request Payload</th>
                                    <td>
                                        <div id="request_payload"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 20%">Ip Address</th>
                                    <td>
                                        <div id="ip_address"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 20%">Browser Useragent</th>
                                    <td>
                                        <div id="browser_useragent"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 20%">Response Code</th>
                                    <td>
                                        <div id="response_code"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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


    <style>

        @media (max-width: 768px) {

            /* use the max to specify at each container level */
            .specifictd {
                width: 360px;
                /* adjust to desired wrapping */
                display: table;
                white-space: pre-wrap;
                /* css-3 */
                white-space: -moz-pre-wrap;
                /* Mozilla, since 1999 */
                white-space: -pre-wrap;
                /* Opera 4-6 */
                white-space: -o-pre-wrap;
                /* Opera 7 */
                word-wrap: break-word;
                /* Internet Explorer 5.5+ */
            }
        }

    </style>

@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
    <script>
        $('.data-table').DataTable({
            responsive: true,
            bAutoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.auditlogs.list') }}",
            columns: [{
                    data: 'auditlog_id',
                    name: 'auditlog_id'
                },
                {
                    data: 'request_url',
                    name: 'request_url'
                },
                {
                    data: 'request_method',
                    name: 'request_method'
                },

                {
                    data: 'ip_address',
                    name: 'ip_address'
                },
                {
                    data: 'browser_useragent',
                    name: 'browser_useragent'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: false
                }
            ],
            order: [
                [0, 'desc']
            ]
        });
        $('body').on('click', '.showAuditLog', function() {

            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ url('admin/auditlogs/show') }}' + "/" + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#showModal').modal('show');
                    document.getElementById('auditlog_id').innerHTML = id;
                    document.getElementById('request_token').innerHTML = data.request_token;
                    document.getElementById('request_url').innerHTML = data.request_url;
                    document.getElementById('request_method').innerHTML = data.request_method;
                    document.getElementById('request_query').innerHTML = decodeURIComponent(data
                        .request_query);
                    document.getElementById('request_payload').innerHTML = decodeURIComponent(data
                        .request_payload);
                    document.getElementById('ip_address').innerHTML = data.ip_address;
                    document.getElementById('browser_useragent').innerHTML = data.browser_useragent;
                    document.getElementById('response_code').innerHTML = data.response_code;
                }
            })
        });
    </script>

@endpush
