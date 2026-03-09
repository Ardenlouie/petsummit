@extends('layouts.app')

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1></h1>
    </div>

</div>
@endsection

@section('content_body')
<div class="row ">
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">REGISTRATIONS</span>
                <span class="info-box-number">{{$all}}</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 ">
        <div class="info-box">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">ATTENDEES</span>
                <span class="info-box-number">{{$attendance}}</span>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Registrations</strong></h3>
            </div>
            <div class="card-body table-responsive" style="max-height: 350px; overflow: auto;">
                <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th class="float-right">Attendance</th>
                    </tr>
                    </thead>
                @foreach ($registers as $register)
                    <tbody>
                        <tr>
                            <td>
                                {{$register->name}}
                            </td>
                            <td>
                                <span class="float-right badge {{$register->attendance == 1 ? 'badge-success' : 'badge-danger'}}">
                                <b>{{$register->attendance == 1 ? 'Yes' : 'No'}}</b></span>
                            </td>
                        </tr>
                    </tbody>
                @endforeach

                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Questions</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4 text-center">
                        <div class="text-bold">1. What type of pet do you own?</div>
                    </div>
                    <!-- <div class="col-2 text-center">
                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ $percent_dog }}%</span>
                        <div class="text-bold">Dog</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ $percent_cat }}%</span>
                        <div class="text-bold">Cat</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ $percent_both }}%</span>
                        <div class="text-bold">Dog & Cat</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ $percent_other }}%</span>
                        <div class="text-bold">Others</div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
@endpush
