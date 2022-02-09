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
                        Edit Facility: <strong>{{ $facilities->facility_name }}</strong>
                        <div class="card-tools">
                            <a class="btn btn-success btn-sm" href="{{ url('/admin/facilities/create') }}">
                                <i class="fas fa-plus fa-fw"></i> Add
                            </a>
                            <a class="btn btn-danger btn-sm" href="{{ url('/admin/facilities/index') }}">
                                <i class="fas fa-undo fa-fw"></i> Back
                            </a>
                        </div>
                    </div>
                    <form action="{{ url('admin/facilities/edit/' . $facilities->facility_id) }}" method="post">
                        <div class="card-body">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="facility_app_id">Facility App Id <span
                                                class="rqfield">*</span></label>
                                        <input class="form-control" type="text" name="facility_app_id"
                                            id="facility_app_id" placeholder="Facility App Id"
                                            value="{{ old('facility_app_id', $facilities->facility_app_id) }}" required
                                            readonly>
                                        <p class="text-muted mt-2 mb-2">
                                            <a href="#" class="no-link"
                                                onclick="generateFacilityAppId('facility_app_id')">
                                                <i class="fas fa-sync fa-fw"></i> Click here to generate new facility app id
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="font-weight-light" for="facility_name">Facility Name <span
                                                    class="rqfield">*</span></label>
                                            <input class="form-control" type="text" name="facility_name"
                                                id="facility_name" placeholder="Facility Name"
                                                value="{{ old('facility_name', $facilities->facility_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">

                                        <div class="form-group">
                                            <label class="font-weight-light" for="facility_owner_name">Facility Owner Name
                                                <span class="rqfield">*</span></label>
                                            <input class="form-control" type="text" name="facility_owner_name"
                                                id="facility_owner_name" placeholder="Facility Owner Name"
                                                value="{{ old('facility_owner_name', $facilities->facility_owner_name) }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="font-weight-light" for="facility_status">Facility Status <span
                                                    class="rqfield">*</span></label>
                                            <select name="facility_status" id="facility_status" class="form-control"
                                                required>
                                                <option value="">Select facility status</option>
                                                <option value="0" @if (old('facility_status', $facilities->facility_status) == '0') selected='selected' @endif>Inactive</option>
                                                <option value="1" @if (old('facility_status', $facilities->facility_status) == '1') selected='selected' @endif>Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="far fa-save fa-fw"></i> Update
                                    </button>
                                    <p class="text-muted mt-2 mb-2">
                                        <i class="fas fa-info-circle fa-fw"></i> <span class="rqfield1">*</span>
                                        marked fields are mandatory.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
