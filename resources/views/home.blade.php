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
            <div class="card-footer">
                <a href="{{ route('export') }}" class="btn btn-success float-right"><i class="fa fa-file-export"></i> Export Attendees</a>
                <a href="{{ route('export.all') }}" class="btn btn-primary"><i class="fa fa-file-export"></i> Export Registrations </a>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Questions</strong></h3>
            </div>
            <div class="card-body">
                <div class="row mb-4 border-bottom pb-3">
                    <div class="col-4 text-center">
                        <div class="text-bold">1. What type of pet do you own?</div>
                    </div>
                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_dog, 2) }}%</span>
                        <div class="text-bold">Dog</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_cat, 2) }}%</span>
                        <div class="text-bold">Cat</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_both, 2) }}%</span>
                        <div class="text-bold">Dog & Cat</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_other, 2) }}%</span>
                        <div class="text-bold">Others</div>
                    </div>
                </div>
                <div class="row mb-4 border-bottom pb-3">
                    <div class="col-4 text-center">
                        <div class="text-bold">2. How much do you usually spend monthly on pet care?</div>
                    </div>
                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_low, 2) }}%</span>
                        <div class="text-bold">Below ₱500</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_medium, 2) }}%</span>
                        <div class="text-bold">₱500-₱1,000</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_high, 2) }}%</span>
                        <div class="text-bold">₱1,000-₱2,500</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_veryhigh, 2) }}%</span>
                        <div class="text-bold">₱2,500+</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 text-center">
                        <div class="text-bold">3. Where do you usually buy pet grooming products?</div>
                    </div>
                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_petstore, 2) }}%</span>
                        <div class="text-bold">Pet Store</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_tiktok, 2) }}%</span>
                        <div class="text-bold">TikTok</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_shopee, 2) }}%</span>
                        <div class="text-bold">Shopee</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_lazada, 2) }}%</span>
                        <div class="text-bold">Lazada</div>
                    </div>
                </div>
                <div class="row mb-4 border-bottom pb-3">
                    <div class="col-4 text-center">
                        <div class="text-bold"></div>
                    </div>
                    <div class="col-4 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_supermarket, 2) }}%</span>
                        <div class="text-bold">Supermarket</div>
                    </div>

                    <div class="col-4 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_vetclinic, 2) }}%</span>
                        <div class="text-bold">Vet Clinic</div>
                    </div>
                </div>
                <div class="row mb-4 border-bottom pb-3">
                    <div class="col-4 text-center">
                        <div class="text-bold">4. How Often Do you Bathe your Pet?</div>
                    </div>
                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_weekly, 2) }}%</span>
                        <div class="text-bold">Weekly</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_twoweeks, 2) }}%</span>
                        <div class="text-bold">Every 2 Weeks</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_monthly, 2) }}%</span>
                        <div class="text-bold">Monthly</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_dirty, 2) }}%</span>
                        <div class="text-bold">Only When Dirty</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 text-center">
                        <div class="text-bold">5. What grooming products do you buy most often?</div>
                    </div>
                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_shampoo, 2) }}%</span>
                        <div class="text-bold">Shampoo and Conditioner</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_soap, 2) }}%</span>
                        <div class="text-bold">Soap</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_wipes, 2) }}%</span>
                        <div class="text-bold">Wipes</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_cologne, 2) }}%</span>
                        <div class="text-bold">Cologne</div>
                    </div>
                </div>
                <div class="row mb-4 border-bottom pb-3">
                    <div class="col-4 text-center">
                        <div class="text-bold"></div>
                    </div>
                    <div class="col-8 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_powder, 2) }}%</span>
                        <div class="text-bold">Powder</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 text-center">
                        <div class="text-bold">6. What matters most when choosing a grooming brand?</div>
                    </div>
                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_price, 2) }}%</span>
                        <div class="text-bold">Price</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_scent, 2) }}%</span>
                        <div class="text-bold">Scent</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_ingredients, 2) }}%</span>
                        <div class="text-bold">Ingredients</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_reviews, 2) }}%</span>
                        <div class="text-bold">Reviews</div>
                    </div>
                </div>
                <div class="row mb-4 border-bottom pb-3">
                    <div class="col-4 text-center">
                        <div class="text-bold"></div>
                    </div>
                    <div class="col-8 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_brandreputation, 2) }}%</span>
                        <div class="text-bold">Brand Reputation</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 text-center">
                        <div class="text-bold">7. What would make you switch to a new brand?</div>
                    </div>
                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_bscent, 2) }}%</span>
                        <div class="text-bold">Better Scent</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_mprice, 2) }}%</span>
                        <div class="text-bold">Most affordable price</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_ningredients, 2) }}%</span>
                        <div class="text-bold">Natural Ingredients</div>
                    </div>

                    <div class="col-2 text-center">
                        <span class="description-percentage text-primary text-bold">{{ number_format($percent_breviews, 2) }}%</span>
                        <div class="text-bold">Better Reviews</div>
                    </div>
                </div>
                <div class="row mb-4 border-bottom pb-3">
                    <div class="col-4 text-center">
                        <div class="text-bold"></div>
                    </div>
                    <div class="col-8 text-center">
                        <span class="description-percentage text-primary text-bold"> {{ number_format($percent_rinfluencer, 2) }}%</span>
                        <div class="text-bold">Influencer recommendation</div>
                    </div>
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

@endpush
