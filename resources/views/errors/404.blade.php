@extends('layouts.errors')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">

                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <p class="mb-0"><i class="fa fa-exclamation-triangle fa-fw"></i>
                                    <strong>Error!</strong><br><br> Page Not Found</p>
                            </div>
                        </div>
                        <br>
                        <a class="btn btn-primary" href="{{ url('/') }}">GO TO HOMEPAGE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
