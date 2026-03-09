@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <style>
    .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
    }

    .gallery img {
        cursor: pointer;
        width: 85%;
        height: auto;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .gallery img:hover {
        transform: scale(1.05);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
    }

    .modal img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .modal img:hover {
        transform: scale(1.1); /* Zoom effect */
    }

    .modal .close {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 30px;
        font-weight: bold;
        color: white;
        cursor: pointer;
    }

    .modal .close:hover {
        color: red;
    }

    .modal .download {
        position: absolute;
        bottom: 20px;
        background-color: #fff;
        color: #000;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
    }

    .modal .download:hover {
        background-color: #000;
        color: #fff;
    }
</style>
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

@section('auth_header', __(''))

@section('auth_body')
<form action="{{ route('update-pet', [$summit->id]) }}" method="post" id="confirmationForm">
    @csrf
    <div class="row">
        <div class="card card-outline text-dark col-md-12">
            
            <div class="card-body box-profile">
        
                <h3 class="text-center"><b>{{$summit->control_number}}</b></h3>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Name</b> <a class="float-right">{{$summit->name}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{$summit->email}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Date Registered</b> <a class="float-right">{{date('F d, Y', strtotime($summit->created_at))}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>With Free Popcorn</b> <span class="float-right badge {{$summit->created_at <= '2026-03-13' ? 'badge-success' : 'badge-danger'}}">
                            <b>{{$summit->created_at <= '2026-03-13' ? 'Yes' : 'No'}}</b></span>
                    </li>
                </ul>

                @if($summit->attendance == 0)
                <div class="col-lg-8" style="margin: 20px auto;">
                    <button type="button" class="btn btn-success btn-block rounded-pill" data-toggle="modal" data-target="#confirmModal">
                        <strong>CONFIRM ATTENDANCE</strong>
                    </button>
                </div>
                @else
                <div class="col-lg-8" style="margin: 20px auto;">
                    <button type="submit" class="btn btn-success
                    btn-block rounded-pill" disabled>
                        <strong>ATTENDANCE CONFIRMED <i class="fas fa-check"></i></strong>
                    </button>
                </div>
                @endif
                <div class="card-tools" style="margin: 10px;">
                    <div class="col-lg-12">
                        <a href="{{route('pet-summit')}}" class="btn btn-secondary btn-xs">
                            <i class="fa fa-caret-left"></i>
                            {{__('adminlte::utilities.back')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@if($summit->created_at <= '2026-03-13' && $summit->attendance == 1)
    <div class="gallery text-center">
        <img class="popup-image" src="{{ asset('images/pregister.png') }}" alt="Image pregister" style="max-width: 100%; height: auto;">
    </div>
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img id="modalImage" src="" alt="Expanded Image">
        <a id="downloadLink" target="_blank" class="download" href="" download="Pre-registered Online.png">Download</a>
    </div>
@elseif($summit->created_at > '2026-03-13' && $summit->attendance == 1)
    <div class="gallery text-center">
        <img class="popup-image" src="{{ asset('images/walkins.png') }}" alt="Image onsite" style="max-width: 100%; height: auto;">
    </div>
    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img id="modalImage" src="" alt="Expanded Image">
        <a id="downloadLink" target="_blank" class="download" href="" download="Walk-ins.png">Download</a>
    </div>
@else
@endif

@stop

@section('auth_footer')

<p class="text-center">
    © 2026
    <a href="https://www.top2tail.com.ph/" target="_blank">Top2Tail.</a>
    All rights reserved.
</p>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Final Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Are you sure you want to confirm this attendance for Top2Tail Pawradise Carnival?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                
                <button type="button" class="btn btn-success" onclick="submitRegistrationForm()">Yes, Confirm</button>
            </div>
        </div>
    </div>
</div>
<script>
    function submitRegistrationForm() {
    const confirmBtn = event.target;
    confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    confirmBtn.disabled = true;
    document.getElementById('confirmationForm').submit();
}
</script>
<script>
    const galleryImages = document.querySelectorAll('.popup-image');
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const downloadLink = document.getElementById('downloadLink');
    const closeModal = document.querySelector('.modal .close');

    galleryImages.forEach((image) => {
        image.addEventListener('click', () => {
            modalImage.src = image.src; 
            downloadLink.href = image.src; 
            imageModal.style.display = 'flex';
        });
    });

    closeModal.addEventListener('click', () => {
        imageModal.style.display = 'none';
    });

    imageModal.addEventListener('click', (event) => {
        if (event.target === imageModal) {
            imageModal.style.display = 'none';
        }
    });
</script>
@stop
