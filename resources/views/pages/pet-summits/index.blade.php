@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Pet Summit'))
@section('content_header_title', __('Pet Summit'))
@section('content_header_subtitle', __('Register'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-lg-6 align-middle">
                    <strong class="text-lg">{{__('Registered List')}}</strong>
                </div>
                <div class="col-lg-6 text-right">
                   
                </div>
            </div>
        </div>
        <div class="card-body">
            
            {{ html()->form('GET', route('pet-summit'))->open() }}
                <div class="row mb-1">
                    <div class="col-lg-4">
                        <div class="form-group">
                            {{ html()->label(__('adminlte::utilities.search'), 'search')->class('mb-0') }}
                            {{ html()->input('text', 'search', $search)->placeholder(__('adminlte::utilities.search'))->class(['form-control', 'form-control-sm'])}}
                        </div>
                    </div>
                </div>
            {{ html()->form()->close() }}
            
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-sm table-striped table-hover mb-0 rounded">
                        <thead class="text-center bg-dark">
                            <tr class="text-center">
                                <th>{{__('adminlte::utilities.name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Date Registered')}}</th>
                                <th>{{__('Attendance')}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($summit as $summits)
                                <tr>
                                    <td class="align-middle text-center">
                                        {{$summits->name}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{$summits->email}}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{date('F d, Y', strtotime($summits->created_at))}}
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($summits->attendance)
                                            <span class="badge badge-success"><b>Confirmed</b></span>
                                        @else
                                            <span class="badge badge-danger"><b>Not Confirmed</b></span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-right p-0 pr-1">
                                        <a href="{{ route('confirm', [$summits->id]) }}" class="btn btn-info btn-xs mb-0 ml-0">
                                            <i class="fa fa-list"></i>
                                            {{__('adminlte::utilities.view')}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer">
            {{$summit->links()}}
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
    <script>
        $(function() {
            $('body').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Livewire.dispatch('setDeleteModel', {type: 'Role', model_id: id});
                $('#modal-delete').modal('show');
            });
        });
    </script>
@endpush