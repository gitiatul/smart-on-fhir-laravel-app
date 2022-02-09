@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible auto-hide3">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p class="mb-0"><i class="fa fa-check fa-fw"></i> <strong>Success!</strong>
            {{ Session::get('success') }} <i class="fas fa-spinner fa-pulse fa-fw"></i></p>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        <p class="mb-0"><i class="fa fa-exclamation-triangle fa-fw"></i> <strong>Error!</strong>
            {{ Session::get('error') }}{{ Session::forget('error') }}</p>
    </div>
@endif

@if (Session::has('epicError'))
    <div class="alert alert-danger">
        <p class="mb-0"><i class="fa fa-exclamation-triangle fa-fw"></i>
            <strong>Error!</strong><br><br>{{ Session::get('epicError') }}{{ Session::forget('epicError') }}</p>
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible auto-hide5">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p class="mb-0"><i class="fa fa-warning fa-fw"></i> <strong>Warning!</strong>
            {{ Session::get('warning') }} <i class="fas fa-spinner fa-pulse fa-fw"></i></p>
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible auto-hide5">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p class="mb-0"><i class="fa fa-info-circle fa-fw"></i> <strong>Info!</strong>
            {{ Session::get('info') }} <i class="fas fa-spinner fa-pulse fa-fw"></i></p>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="list-style-type: none;" class="mb-0">
            @foreach ($errors->all() as $error)
                <li><i class="fa fa-exclamation-triangle fa-fw"></i> <strong>Error!</strong> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
