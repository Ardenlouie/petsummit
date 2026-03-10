@extends('adminlte::master')

@push('styles')
<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                    url("{{ asset('images/petsummitbg.jpg') }}") no-repeat center center fixed;
        background-size: cover;
    }
</style>
@endpush

@php
    $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home');

    if (config('adminlte.use_route_url', false)) {
        $dashboard_url = $dashboard_url ? route($dashboard_url) : '';
    } else {
        $dashboard_url = $dashboard_url ? url($dashboard_url) : '';
    }

    $bodyClasses = ($auth_type ?? 'login') . '-page';

    if (! empty(config('adminlte.layout_dark_mode', null))) {
        $bodyClasses .= ' dark-mode';
    }
@endphp

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('iCheckBoostrap', true)

@section('classes_body'){{ $bodyClasses }}@stop

@section('body')

    <div class="container-fluid p-0">
        <img src="{{ asset('images/banner.jpg') }}" class="img-fluid w-100 d-block" style=" object-fit: cover;">
    </div>

    <div class="{{ $auth_type ?? 'login' }}-container-fluid p-0">

        {{-- Logo --}}
        <div class="{{ $auth_type ?? 'login' }}-logo">
            <a href="/">
                <!-- <img src="{{ asset('images/top2taillogo.png') }}" alt="Top2Tail" style="height: 80px;" ><br> -->
                <!-- <img src="{{ asset('images/banner.jpg') }}" class="img-fluid w-100 d-block" style="max-height: 300px; object-fit: cover;"> -->
        
                {{-- Logo Label --}}
                <strong class="text-xl text-dark"><b>PAWRADISE CARNIVAL</b></strong>

            </a>
        </div>

        {{-- Card Box --}}
        <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

            {{-- Card Header --}}
            @hasSection('auth_header')
                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    <h2 class="card-title float-none text-center text-bold">
                        @yield('auth_header')
                    </h2>
                </div>
            @endif

            {{-- Card Body --}}
            <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }} ">
                @yield('auth_body')
            </div>

            {{-- Card Footer --}}
            @hasSection('auth_footer')
                <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                    @yield('auth_footer')
                </div>
            @endif
            
        </div>

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
