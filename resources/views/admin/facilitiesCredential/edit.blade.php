@extends('layouts.master')
@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts.sessions')
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Facilities Credential
                        <div class="card-tools">
                            <a class="btn btn-danger btn-sm" href="{{ url('/admin/facilities/index') }}">
                                <i class="fas fa-undo fa-fw"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ url('admin/facilitycredential/edit/' . $facilityCredential->facility_credentials_id) }}"
                            method="post">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="ehr_client_id">Ehr Client id<span
                                                class="rqfield">*</span></label>
                                        <input type="text" name="ehr_client_id" id="ehr_client_id"
                                            value="{{ old('ehr_client_id', $facilityCredential->ehr_client_id) }}"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="ehr_token_endpoint">Hl7 Facility Id<span
                                                class="rqfield">*</span></label>
                                        <input type="text" name="facility_hl7_id" id="facility_hl7_id"
                                            value="{{ old('facility_hl7_id', $facilityCredential->facility_hl7_id) }}"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="facility_internal_id">Internal Facility
                                            Id<span class="rqfield">*</span></label>

                                        <select name="address_id" id="address_id" class="form-control selectpicker"
                                            required>
                                            @foreach ($ocAddress as $item)
                                                <option data-tokens="{{ $item->company }}"
                                                    {{ old('address_id', $facilityCredential->address_id) == $item->address_id ? 'selected' : '' }}
                                                    value="{{ $item->address_id }}">{{ $item->company }}</option>
                                            @endforeach
                                            <option value=""
                                                {{ old('address_id', $facilityCredential->address_id) == '' ? 'selected' : '' }}>
                                                Select Internal Facility Id</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="ehr_metadata_endpoint">Ehr Metadata
                                            Endpoint<span class="rqfield">*</span></label>
                                        <textarea type="text" name="ehr_metadata_endpoint" id="ehr_metadata_endpoint"
                                            class="form-control"
                                            required>{{ old('ehr_metadata_endpoint', $facilityCredential->ehr_metadata_endpoint) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="ehr_authorize_endpoint">Ehr Authorize
                                            Endpoint<span class="rqfield">*</span></label>
                                        <textarea type="text" name="ehr_authorize_endpoint" id="ehr_authorize_endpoint"
                                            class="form-control"
                                            required>{{ old('ehr_authorize_endpoint', $facilityCredential->ehr_authorize_endpoint) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="ehr_token_endpoint">Ehr Token Endpoint<span
                                                class="rqfield">*</span></label>
                                        <textarea type="text" name="ehr_token_endpoint" id="ehr_token_endpoint"
                                            class="form-control"
                                            required>{{ old('ehr_token_endpoint', $facilityCredential->ehr_token_endpoint) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="ehr_fhir_endpoint">Ehr Fhir Endpoint<span
                                                class="rqfield">*</span></label>
                                        <textarea type="text" name="ehr_fhir_endpoint" id="ehr_fhir_endpoint"
                                            class="form-control"
                                            required>{{ old('ehr_fhir_endpoint', $facilityCredential->ehr_fhir_endpoint) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="far fa-save fa-fw"></i> Update
                                </button>
                                <p class="text-muted mt-2 mb-2">
                                    <i class="fas fa-info-circle fa-fw"></i> <span class="rqfield1">*</span> marked
                                    fields are mandatory.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('.selectpicker').select2()
    </script>
@endpush
