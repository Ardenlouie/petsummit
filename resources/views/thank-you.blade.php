@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $register_pet = View::getSection('register_pet') ?? config('adminlte.register_pet', 'register_pet') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $register_pet = $register_pet ? route($register_pet) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $register_pet = $register_pet ? url($register_pet) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', __('Thank you for registering!'))

@section('auth_body')
<div class="card">
    <div class="card-header text-center">
        <strong class="text-lg text-justify">Your Carnival Show Pass is also in your registered email. Show it at the Top2Tail Booth #18 to receive exciting rewards. 🎉</strong>
    </div>
    <div class="card-body">
        <iframe 
            src="{{ route('view.pdf', $summit->id) }}" 
            width="100%" 
            height="600px" 
            style="border: none;">
        </iframe>
    </div>
    
</div>
@stop

@section('auth_footer')

<p class="text-center">
    © 2026
    <a href="https://www.top2tail.com.ph/" target="_blank">Top2Tail.</a>
    All rights reserved.
</p>


@stop
