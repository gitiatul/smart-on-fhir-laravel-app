@extends('layouts.master')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts.sessions')
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Add Facility
                        <div class="card-tools">
                            <a class="btn btn-danger btn-sm" href="{{ url('/admin/facilities/index') }}">
                                <i class="fas fa-undo fa-fw"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('/admin/facilities/store') }}" method="post">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="facility_name">Facility Name <span
                                                class="rqfield">*</span></label>
                                        <input type="text" name="facility_name" id="facility_name"
                                            value="{{ old('facility_name') }}" class="form-control" required></br>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="facility_owner_name">Facility Owner Name <span
                                                class="rqfield">*</span></label>
                                        <input type="text" name="facility_owner_name" id="facility_owner_name"
                                            value="{{ old('facility_owner_name') }}" class="form-control" required></br>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="far fa-save fa-fw"></i> Add
                                </button>
                                <p class="text-muted mt-2 mb-2">
                                    <i class="fas fa-info-circle fa-fw"></i> <span class="rqfield1">*</span>
                                    marked
                                    fields
                                    are mandatory.
                                </p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
