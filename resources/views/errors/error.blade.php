@extends('layouts.errors')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">

                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                @include('layouts.sessions')
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
