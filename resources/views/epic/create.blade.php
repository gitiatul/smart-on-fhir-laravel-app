@extends('layouts.epic')
@section('content')

    @php
    $providerNPI = $providerArray['npi'];
    $providerFirstName = $providerArray['firstname'];
    $providerLastName = $providerArray['lastname'];
    $providerEmail = $providerArray['email'];
    $providerMobile = $providerArray['mobile'];
    $providerSuffix = $providerArray['suffix'];
    $providePrefix = $providerArray['prefix'];
    $provideFhirId = $providerArray['fhirid'];
    $provideSecPhone = $providerArray['secphone'];
    $provideFacilityId = $providerArray['facilityid'];
    $provideFacilityName = $providerArray['facilityname'];

    @endphp
    <div class="provider">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card-body">

                        <form>
                            {!! csrf_field() !!}
                            <div class="row">
                                <h5> Your account does not exist. Please confirm your details:</h5>
                                <br><br>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="P_FNAME">First Name <span
                                                class="rqfield"></span></label>
                                        <input type="text" name="P_FNAME" id="P_FNAME"
                                            value="{{ old('P_FNAME', $providerFirstName) }}" class="form-control"
                                            required>
                                        <span class="text-danger error-text P_FNAME_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="P_LNAME">Last Name <span
                                                class="rqfield"></span></label>
                                        <input type="text" name="P_LNAME" id="P_LNAME"
                                            value="{{ old('P_LNAME', $providerLastName) }}" class="form-control"
                                            required>
                                        <span class="text-danger error-text P_LNAME_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="P_email">Email Id <span
                                                class="rqfield"></span></label>
                                        <input type="text" name="P_email" id="P_email"
                                            value="{{ old('P_email', $providerEmail) }}" class="form-control" required>
                                        <span class="text-danger error-text P_email_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="facility_owner_name">Mobile No.<span
                                                class="rqfield"></span></label>
                                        <input type="text" name="P_SMS" id="P_SMS"
                                            value="{{ old('P_SMS', $providerMobile) }}" class="form-control" required>
                                        <span class="text-danger error-text P_SMS_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="P_NPI">NPI <span
                                                class="rqfield"></span></label>
                                        <input type="text" name="P_NPI" id="P_NPI"
                                            value="{{ old('P_NPI', $providerNPI) }}" class="form-control" required>
                                        <span class="text-danger error-text P_NPI_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="hidden" id="P_SUFFIX" name="P_SUFFIX" value="{{ $providerSuffix }}">
                                <input type="hidden" id="P_SALUTE" name="P_SALUTE" value="{{ $providePrefix }}">
                                <input type="hidden" id="P_FHIR_ID" name="P_FHIR_ID" value="{{ $provideFhirId }}">
                                <input type="hidden" id="P_sec_phone" name="P_sec_phone" value="{{ $provideSecPhone }}">
                                <input type="hidden" id="P_FACILITY" name="P_FACILITY" value="{{ $provideFacilityName }}">
                                <input type="hidden" id="P_FACILITY_ID" name="P_FACILITY_ID"
                                    value="{{ $provideFacilityId }}">

                                <button type="submit" class="btn btn-primary btn-md providerButton">
                                    Register & Continue
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    @php
    $patientFirstName = $patientArray['firstname'];
    $patientMedName = $patientArray['med'];
    $patientLastName = $patientArray['lastname'];
    $patientEmail = $patientArray['email'];
    $patientFhirId = $patientArray['fhirid'];
    $patientMobile = $patientArray['mobile'];
    $patientDob = $patientArray['dob'];
    $patientGender = $patientArray['gender'];
    $patientPhoneHome = $patientArray['phonehome'];
    $patientCity = $patientArray['city'];
    $patientState = $patientArray['state'];
    $patientCounty = $patientArray['county'];
    $patientStreet = $patientArray['street'];
    $patientPostalcode = $patientArray['postal_code'];
    $patientCountrycode = $patientArray['country_code'];
    $patientDeceased = $patientArray['deceased'];

    @endphp
    <div class="patient">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include('layouts.sessions')
                </div>
                <div class="col-md-12">
                    <div class="card-body">

                        <form>
                            {!! csrf_field() !!}
                            <div class="row">
                                <h5> Patient details not found</h5>
                                <br><br>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="p_fname">First Name <span
                                                class="rqfield"></span></label>
                                        <input type="text" name="p_fname" id="p_fname"
                                            value="{{ old('p_fname', $patientFirstName) }}" class="form-control"
                                            required>
                                            <span class="text-danger error-text p_fname_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="p_lname">Last Name <span
                                                class="rqfield"></span></label>
                                        <input type="text" name="p_lname" id="p_lname"
                                            value="{{ old('p_lname', $patientLastName) }}" class="form-control"
                                            required>
                                            <span class="text-danger error-text p_lname_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="p_email">Email Id <span
                                                class="rqfield"></span></label>
                                        <input type="text" name="p_email" id="p_email"
                                            value="{{ old('p_email', $patientEmail) }}" class="form-control" required>
                                            <span class="text-danger error-text p_email_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="p_phone_cell">Mobile No.<span
                                                class="rqfield"></span></label>
                                        <input type="text" name="p_phone_cell" id="p_phone_cell"
                                            value="{{ old('p_phone_cell', $patientMobile) }}" class="form-control"
                                            required>
                                            <span class="text-danger error-text p_phone_cell_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="p_dob">DOB<span
                                                class="rqfield"></span></label>
                                        <input type="date" name="p_dob" id="p_dob"
                                            value="{{ old('p_dob', $patientDob) }}" class="form-control" required>
                                            <span class="text-danger error-text p_dob_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-light" for="p_gender">Gender <span
                                                class="rqfield"></span></label>
                                        <select name="p_gender" id="p_gender" class="form-control" required>
                                            <option value=""> Select Gender</option>
                                            <option value="1" @if (old('p_gender', $patientGender) == 'male') selected='selected' @endif>Male</option>
                                            <option value="2" @if (old('p_gender', $patientGender) == 'female') selected='selected' @endif>Female</option>
                                            <option value="3" @if (old('p_gender', $patientGender) == 'other') selected='selected' @endif>Other</option>
                                            <option value="4" @if (old('p_gender', $patientGender) == 'unknown') selected='selected' @endif>unknown</option>
                                            <option value="5" @if (old('p_gender', $patientGender) == 'not available') selected='selected' @endif>not available</option>
                                            <option value="6" @if (old('p_gender', $patientGender) == 'not applicable') selected='selected' @endif>not applicable</option>
                                        </select>
                                        <span class="text-danger error-text p_gender_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="hidden" id="p_fhir_id" name="p_fhir_id" value="{{ $patientFhirId }}">
                                <input type="hidden" id="p_mname" name="p_mname" value="{{ $patientMedName }}">
                                <input type="hidden" id="p_phone_home" name="p_phone_home"
                                    value="{{ $patientPhoneHome }}">
                                <input type="hidden" id="p_street" name="p_street" value="{{ $patientStreet }}">
                                <input type="hidden" id="p_city" name="p_city" value="{{ $patientCity }}">
                                <input type="hidden" id="p_county" name="p_county" value="{{ $patientCounty }}">
                                <input type="hidden" id="p_state" name="p_state" value="{{ $patientState }}">
                                <input type="hidden" id="p_postal_code" name="p_postal_code"
                                    value="{{ $patientPostalcode }}">
                                <input type="hidden" id="p_country_code" name="p_country_code"
                                    value="{{ $patientCountrycode }}">
                                <input type="hidden" id="p_deceased" name="p_deceased" value="{{ $patientDeceased }}">
                                <button type="submit" class="btn btn-primary btn-md patientButton">
                                    Create & Continue
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="index">
        <p id="providerIndex">Provider PUID : {{ $providerPUID }}</p>
        <p id="patientIndex">Patient PUID : {{ $patientPUID }}</p>
    </div>

    <!-- Provider Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Provider Created Successfully</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Modal -->
    <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Patient Created Successfully</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    @if ($providerFlag == 1 && $patientFlag == 1)
        <script>
            $('.patient').hide();
            $('.index').hide();
        </script>
    @endif
    @if ($providerFlag == 1 && $patientFlag == 0)
        <script>
            $('.patient').hide();
            $('.index').hide();
        </script>
    @endif
    @if ($providerFlag == 0 && $patientFlag == 1)
        <script>
            $('.provider').hide();
            $('.index').hide();
        </script>
    @endif
    @if ($providerFlag == 0 && $patientFlag == 0)
        <script>
            $('.provider').hide();
            $('.patient').hide();
        </script>
    @endif
    <script type="text/javascript">
        $(".providerButton").click(function(e) {

            e.preventDefault();

            var P_FNAME = $("#P_FNAME").val();
            var P_LNAME = $("#P_LNAME").val();
            var P_email = $("#P_email").val();
            var P_SMS = $("#P_SMS").val();
            var P_NPI = $("#P_NPI").val();
            var P_SUFFIX = $("#P_SUFFIX").val();
            var P_FHIR_ID = $("#P_FHIR_ID").val();
            var P_sec_phone = $("#P_sec_phone").val();
            var P_FACILITY = $("#P_FACILITY").val();
            var P_FACILITY_ID = $("#P_FACILITY_ID").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('epic.provider.store') }}",
                data: {
                    P_FNAME: P_FNAME,
                    P_LNAME: P_LNAME,
                    P_email: P_email,
                    P_SMS: P_SMS,
                    P_NPI: P_NPI,
                    P_SUFFIX: P_SUFFIX,
                    P_FHIR_ID: P_FHIR_ID,
                    P_sec_phone: P_sec_phone,
                    P_FACILITY: P_FACILITY,
                    P_FACILITY_ID: P_FACILITY_ID
                },
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response) {
                        if (response.status == 0) {
                            $.each(response.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val);
                            });
                        } else {
                            obj = JSON.parse(JSON.stringify(response));
                            document.getElementById("providerIndex").innerHTML = "Provider PUID : " +
                                obj
                                .providerPUID;
                            $("#myModal").modal('show');
                            {{ $providerFlag = 0 }}
                            if ({{ $patientFlag }} == 1) {
                                $('.provider').hide();
                                $('.patient').show();
                            }
                            if ({{ $patientFlag }} == 0) {
                                $('.provider').hide();
                                $('.patient').hide();
                                $('.index').show();
                            }
                        }
                    }
                }
            })
        });
    </script>
    <script type="text/javascript">
        $(".patientButton").click(function(e) {

            e.preventDefault();

            var p_fname = $("#p_fname").val();
            var p_lname = $("#p_lname").val();
            var p_email = $("#p_email").val();
            var p_phone_cell = $("#p_phone_cell").val();
            var p_dob = $("#p_dob").val();
            var p_gender = $("#p_gender").val();
            var p_fhir_id = $("#p_fhir_id").val();
            var p_mname = $("#p_mname").val();
            var p_phone_home = $("#p_phone_home").val();
            var p_street = $("#p_street").val();
            var p_city = $("#p_city").val();
            var p_county = $("#p_county").val();
            var p_state = $("#p_state").val();
            var p_postal_code = $("#p_postal_code").val();
            var p_country_code = $("#p_country_code").val();
            var p_deceased = $("#p_deceased").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('epic.patient.store') }}",
                data: {
                    p_fname: p_fname,
                    p_lname: p_lname,
                    p_email: p_email,
                    p_phone_cell: p_phone_cell,
                    p_dob: p_dob,
                    p_gender: p_gender,
                    p_fhir_id: p_fhir_id,
                    p_mname: p_mname,
                    p_phone_home: p_phone_home,
                    p_street: p_street,
                    p_city: p_city,
                    p_county: p_county,
                    p_state: p_state,
                    p_postal_code: p_postal_code,
                    p_country_code: p_country_code,
                    p_deceased: p_deceased
                },
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response) {
                        if (response.status == 0) {
                            $.each(response.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            obj = JSON.parse(JSON.stringify(response));
                                document.getElementById("patientIndex").innerHTML = "Patient PUID : " + obj
                                .patientPUID;
                            $("#myModal1").modal('show');
                            $('.patient').hide();
                            $('.provider').hide();
                            $('.index').show();
                            {{ $patientFlag = 0 }}
                        }
                    }
                }
            });

        });
    </script>


@endpush
