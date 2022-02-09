@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts.sessions')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Change Password</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('passwordupdate') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="password" class="font-weight-light col-md-4 text-md-right">
                                    Current Password <span class="rqfield">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="current_password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="font-weight-light col-md-4 text-md-right">
                                    New Password <span class="rqfield">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" required>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="password" class="font-weight-light col-md-4 text-md-right">
                                    New Confirm Password <span class="rqfield">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="far fa-save fa-fw"></i> Update Password
                                    </button>
                                    <p class="text-muted mt-2 mb-2">
                                        <i class="fas fa-info-circle fa-fw"></i> <span class="rqfield1">*</span>
                                        marked fields are mandatory.
                                    </p>
                                    <p class="text-muted mt-2 mb-2">
                                        <i class="fas fa-info-circle fa-fw"></i> <span class="rqfield1">*</span>
                                        You will be logged out after updating your password.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
