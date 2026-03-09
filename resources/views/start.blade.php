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

@section('auth_header', __('REGISTER FORM'))

@section('auth_body')
    <form action="{{ $register_pet }}" method="post">
        @csrf
        
        <div class="input-group mb-3 col-lg-8 text-center" style="margin: 0 auto;">
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-5 col-lg-8 text-center" style="margin: 0 auto;">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="{{ __('Name') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-lg-10 mb-5" style="margin: 0 auto;">
            <label>
                <h4>{{ __('1. What type of pet do you own?') }}</h4>
            </label>

            <div class="">
                <div class="form-control h-auto @error('pets') is-invalid @enderror" style="padding: 15px 25px;">

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="pets[]" id="dog" value="dog"
                            {{ is_array(old('pets')) && in_array('dog', old('pets')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="dog">{{ __('Dog') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="pets[]" id="cat" value="cat"
                            {{ is_array(old('pets')) && in_array('cat', old('pets')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="cat">{{ __('Cat') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="pets[]" id="dogcat" value="dogcat"
                            {{ is_array(old('pets')) && in_array('dogcat', old('pets')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="dogcat">{{ __('Dog & Cat') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="pets[]" id="others" value="others"
                            {{ is_array(old('pets')) && in_array('others', old('pets')) ? 'checked' : '' }}
                            onclick="toggleOthersInput()">
                        <label class="custom-control-label" for="others">{{ __('Others') }}</label>
                    </div>

                    <div id="other-pet-input" style="display: {{ is_array(old('pets')) && in_array('others', old('pets')) ? 'block' : 'none' }}; margin-top: 10px;">
                        <input type="text" name="other_pet_name" class="form-control" 
                            placeholder="Please specify" value="{{ old('other_pet_name') }}">
                    </div>

                </div>
            </div>

            @error('pets')
                <span class="invalid-feedback d-block text-center" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-lg-10 mb-5" style="margin: 0 auto;">
            <label>
                <h4>{{ __('2. How much do you usually spend monthly on pet care?') }}</h4>
            </label>

            <div class="">
                <div class="form-control h-auto @error('spend') is-invalid @enderror" style="padding: 15px 25px;">

                    <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="radio" name="spend" id="low" value="low"
                            {{ old('spend') == 'low' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="low">{{ __('Below ₱500') }}</label>
                    </div>

                    <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="radio" name="spend" id="medium" value="medium"
                            {{ old('spend') == 'medium' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="medium">{{ __('₱500-₱1,000') }}</label>
                    </div>

                    <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="radio" name="spend" id="high" value="high"
                            {{ old('spend') == 'high' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="high">{{ __('₱1,000-₱2,500') }}</label>
                    </div>

                    <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="radio" name="spend" id="veryhigh" value="veryhigh"
                            {{ old('spend') == 'veryhigh' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="veryhigh">{{ __('₱2,500+') }}</label>
                    </div>

                </div>
            </div>

            @error('spend')
                <span class="invalid-feedback d-block text-center" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-lg-10 mb-5" style="margin: 0 auto;">
            <label>
                <h4>{{ __('3. Where do you usually buy pet grooming products?') }}</h4>
            </label>

            <div class="">
                <div class="form-control h-auto @error('store') is-invalid @enderror" style="padding: 15px 25px;">
                    
                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="store[]" id="petstore" value="petstore"
                            {{ is_array(old('store')) && in_array('petstore', old('store')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="petstore">{{ __('Pet Store') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="store[]" id="tiktok" value="tiktok"
                            {{ is_array(old('store')) && in_array('tiktok', old('store')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="tiktok">{{ __('Tiktok Shop') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="store[]" id="shopee" value="shopee"
                            {{ is_array(old('store')) && in_array('shopee', old('store')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="shopee">{{ __('Shopee') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="store[]" id="lazada" value="lazada"
                            {{ is_array(old('store')) && in_array('lazada', old('store')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="lazada">{{ __('Lazada') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="store[]" id="supermarket" value="supermarket"
                            {{ is_array(old('store')) && in_array('supermarket', old('store')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="supermarket">{{ __('Supermarket') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="store[]" id="vetclinic" value="vetclinic"
                            {{ is_array(old('store')) && in_array('vetclinic', old('store')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="vetclinic">{{ __('Vet Clinic') }}</label>
                    </div>

                </div>
            </div>

            @error('store')
                <span class="invalid-feedback d-block text-center" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-lg-10 mb-5" style="margin: 0 auto;">
            <label>
                <h4>{{ __('4. How Often Do you Bathe your Pet?') }}</h4>
            </label>

            <div class="">
                <div class="form-control h-auto @error('bath') is-invalid @enderror" style="padding: 15px 25px;">
                    
                    <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="radio" name="bath" id="weekly" value="weekly"
                            {{ old('bath') == 'weekly' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="weekly">{{ __('Weekly') }}</label>
                    </div>

                    <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="radio" name="bath" id="twoweeks" value="twoweeks"
                            {{ old('bath') == 'twoweeks' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="twoweeks">{{ __('Every 2 weeks') }}</label>
                    </div>

                    <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="radio" name="bath" id="monthly" value="monthly"
                            {{ old('bath') == 'monthly' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="monthly">{{ __('Monthly') }}</label>
                    </div>

                    <div class="custom-control custom-radio mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="radio" name="bath" id="dirty" value="dirty"
                            {{ old('bath') == 'dirty' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="dirty">{{ __('Only when dirty') }}</label>
                    </div>

                </div>
            </div>

            @error('bath')
                <span class="invalid-feedback d-block text-center" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-lg-10 mb-5" style="margin: 0 auto;">
            <label>
                <h4>{{ __('5. What grooming products do you buy most often?') }}</h4>
            </label>

            <div class="">
                <div class="form-control h-auto @error('store') is-invalid @enderror" style="padding: 15px 25px;">
                    
                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="product[]" id="shampoo" value="shampoo"
                            {{ is_array(old('product')) && in_array('shampoo', old('product')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="shampoo">{{ __('Shampoo and Conditioner') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="product[]" id="soap" value="soap"
                            {{ is_array(old('product')) && in_array('soap', old('product')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="soap">{{ __('Soap') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="product[]" id="wipes" value="wipes"
                            {{ is_array(old('product')) && in_array('wipes', old('product')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="wipes">{{ __('Wipes') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="product[]" id="cologne" value="cologne"
                            {{ is_array(old('product')) && in_array('cologne', old('product')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="cologne">{{ __('Cologne') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="product[]" id="powder" value="powder"
                            {{ is_array(old('product')) && in_array('powder', old('product')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="powder">{{ __('Powder') }}</label>
                    </div>

                </div>
            </div>

            @error('product')
                <span class="invalid-feedback d-block text-center" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-lg-10 mb-5" style="margin: 0 auto;">
            <label>
                <h4>{{ __('6. What matters most when choosing a grooming brand?') }}</h4>
            </label>

            <div class="">
                <div class="form-control h-auto @error('store') is-invalid @enderror" style="padding: 15px 25px;">
                    
                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="brand[]" id="price" value="price"
                            {{ is_array(old('brand')) && in_array('price', old('brand')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="price">{{ __('Price') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="brand[]" id="scent" value="scent"
                            {{ is_array(old('brand')) && in_array('scent', old('brand')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="scent">{{ __('Scent') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="brand[]" id="ingredients" value="ingredients"
                            {{ is_array(old('brand')) && in_array('ingredients', old('brand')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="ingredients">{{ __('Ingredients') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="brand[]" id="reviews" value="reviews"
                            {{ is_array(old('brand')) && in_array('reviews', old('brand')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="reviews">{{ __('Reviews') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="brand[]" id="brand_reputation" value="brand_reputation"
                            {{ is_array(old('brand')) && in_array('brand_reputation', old('brand')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="brand_reputation">{{ __('Brand Reputation') }}</label>
                    </div>

                </div>
            </div>

            @error('brand')
                <span class="invalid-feedback d-block text-center" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-lg-10 mb-5" style="margin: 0 auto;">
            <label>
                <h4>{{ __('7. What would make you switch to a new brand?') }}</h4>
            </label>

            <div class="">
                <div class="form-control h-auto @error('store') is-invalid @enderror" style="padding: 15px 25px;">
                    
                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="switch[]" id="bscent" value="bscent"
                            {{ is_array(old('switch')) && in_array('bscent', old('switch')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="bscent">{{ __('Better Scent') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="switch[]" id="mprice" value="mprice"
                            {{ is_array(old('switch')) && in_array('mprice', old('switch')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="mprice">{{ __('Most affordable price') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="switch[]" id="ningredients" value="ningredients"
                            {{ is_array(old('switch')) && in_array('ningredients', old('switch')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="ningredients">{{ __('Natural Ingredients') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="switch[]" id="breviews" value="breviews"
                            {{ is_array(old('switch')) && in_array('breviews', old('switch')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="breviews">{{ __('Better Reviews') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox mb-2">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" name="switch[]" id="rinfluencer" value="rinfluencer"
                            {{ is_array(old('switch')) && in_array('rinfluencer', old('switch')) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="rinfluencer">{{ __('Influencer recommendation') }}</label>
                    </div>
                    <input type="hidden" name="control_number" value="{{$control_number}}"> 

                </div>
            </div>

            @error('switch')
                <span class="invalid-feedback d-block text-center" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 col-lg-10" style="margin: 0 auto;">
            <div class="">
                <div class="form-control h-auto">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="privacy_policy" onchange="toggleSubmit()">
                        <label class="custom-control-label" for="privacy_policy">
                            {{ __('I accept the') }} <a href="#" class="btn-upload">{{ __('Privacy Policy') }}</a>
                            
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8" style="margin: 20px auto;">
            <button type="submit" class="btn btn-dark btn-block rounded-pill" onclick="this.disabled=true; this.form.submit();" id="submit-btn" disabled>
                <strong>REGISTER NOW</strong>
            </button>
        </div>

        


    </form>
@stop

@section('auth_footer')
<p class="text-center">
    © 2026
    <a href="https://www.top2tail.com.ph/" target="_blank">Top2Tail.</a>
    All rights reserved.
</p>
<div class="modal fade" id="modal-upload">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <h3 class="text-center">Top2Tail Pet Summit 2026 - Registration Terms & Conditions</h3>
                <div class="mt-4 text-justify" style="line-height: 1.6;">
                    <p>By registering for Top2Tail Pet Summit 2026, you agree to the following terms and conditions:</p>

                    <p>1. Personal Data and Privacy By completing your registration, you consent to the collection and use of your personal information (e.g., name, contact details, and optional pet-related data) by the event organizers. This information will be used solely for event-related communications, updates, and special promotions.

                    Your data will not be shared with third parties beyond event sponsors, suppliers, and partners directly involved in delivering the event experience. You may opt out of promotional emails anytime by contacting henlo@top2tail.com.ph.</p>
                    <p>2. Assumption of Risk Participation in Top2Tail Pet Summit 2026 is voluntary. By attending, you assume all risks associated with the event, including potential risks related to your pet(s), other attendees, and the venue environment.</p>

                    <p>3. Release of Liability You waive any claims, demands, or legal actions against the event organizers, venue partners, sponsors, suppliers, and exhibitors for any injury, loss, or damage sustained during the event.</p>

                    <p>4. Pet Responsibility If attending with a pet, you acknowledge full responsibility for your pet’s safety, behavior, and well-being. You agree to follow event guidelines to ensure a safe and enjoyable experience for all attendees and their pets.</p>

                    <p>5. Media Release By registering, you grant permission for event organizers and partners to use photographs, videos, or recordings taken during the event for promotional purposes.</p>

                    <p>6. Code of Conduct All attendees, including pets, must adhere to event rules and regulations. Disruptive behavior may result in removal from the event.</p>

                    <p>7. Event Modifications and Cancellations The event organizers reserve the right to modify the event schedule, activities, or venue details. In case of cancellation due to unforeseen circumstances, registered attendees will be notified via their provided contact details.</p>

                    <p>By registering for Top2Tail Pet Summit 2026, you confirm that you have read, understood, and agreed to these Terms & Conditions.</p>

                    <p>For inquiries, please contact henlo@top2tail.com.ph.</p>
                </div>

            </div>
             <div class="modal-footer text-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleOthersInput() {
        const checkbox = document.getElementById('others');
        const inputDiv = document.getElementById('other-pet-input');
        
        if (checkbox.checked) {
            inputDiv.style.display = 'block';
            // Optional: Auto-focus the input when it appears
            inputDiv.querySelector('input').focus();
        } else {
            inputDiv.style.display = 'none';
            // Optional: Clear the input if they uncheck it
            inputDiv.querySelector('input').value = '';
        }
    }
</script>
@stop
