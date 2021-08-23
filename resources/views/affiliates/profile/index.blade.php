@extends('layouts.affiliates')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/plugins/croppie/croppie.css') }}">
@endpush


@section('base-content')
<div class="wrapper wrapper-content annimated fadeInRight">

    <div class="row animated fadeInRight">
        <div class="col-xl-4 col-lg-12 col-auto">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>My Profile</h5>
                </div>
                <div class="ibox-content">
                    <div class="ibox-content text-center">
                        <div>
                            <img alt="image" width="50%" class="img-thumbnail" src="{{ \App\Models\User::getProfilePicture() }}">
                            <h1 class="user-name"><strong>{{$user->firstname}} {{$user->lastname}}</strong></h1>
                            <h2 class="user-distid"><strong>{{$user->distid}}</strong></h2>
                            <button class="btn btn-primary btn-xs mt-1" data-toggle="collapse" href="#collapseUpload" id="scroll-target" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <a class="fa-fa-picture">Update Photo</a>
                            </button>
                        </div>
                    </div>
                    <div class="ibox-content text-center">
                        <div class="user-button-container ">
                            <div class="user-button-box">
                                <ol style="width:max-content; padding-left: 0px;">
                                    <li style="display:grid;"><a href="{{ route('affiliates.profile') }}" class="btn btn-primary btn-sm {{Request::url() == url('/profile') ? 'active' : ''}}">Basic Information</a></li>
                                    <li style="display:grid;"><a href="{{ route('affiliates.profile','primary-address')}}" class="btn btn-primary btn-sm {{Request::url() == url('/profile/primary-address') ? 'active' : ''}}">Primary Address</a></li>
                                    <li style="display:grid;"><a href="{{ route('affiliates.profile','shipping-address')}}" class="btn btn-primary btn-sm {{Request::url() == url('/profile/shipping-address') ? 'active' : ''}}">Shipping Address</a></li>
                                    <!-- <li style="display:grid;"><a href="{{ route('affiliates.profile','billing-address')}}" class="btn btn-primary btn-sm {{Request::url() == url('/profile/billing-address') ? 'active' : ''}}">Billing Address</a></li> -->
                                    <li style="display:grid;"><a href="{{ route('affiliates.profile','payment-methods')}}" class="btn btn-primary btn-sm {{Request::url() == url('/profile/payment-methods') ? 'active' : ''}}">Payment Methods</a></li>                                    
                                    <li style="display:grid;"><a href="{{ route('affiliates.profile','replicated-site') }}" class="btn btn-primary btn-sm {{Request::url() == url('/profile/replicated-site') ? 'active' : ''}}">Replicated Site Preferences</a></li>
                                    <li style="display:grid;"><a href="#" class="btn btn-primary btn-sm">Comunications</a></li>
                                    {{--  <li style="display:grid;"><a href="{{ route('affiliates.profile','idecide')}}" class="btn btn-primary btn-sm {{Request::url() == url('/profile/idecide') ? 'active' : ''}}">IDecide</a></li>  --}}
                                    <!--<li style="display:grid;"><a href="{{ route('affiliates.profile','binary-placement')}}" class="btn btn-primary btn-sm {{Request::url() == url('/profile/binary-placement') ? 'active' : ''}}">Binary Placement</a></li>-->
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col" id="target">
            <div class="collapse mb-5" id="collapseUpload">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div id="upload-demo"></div>
                    </div>
                    <div class="custom-file col-md-4">
                        <input type="file" id="upload" class="custom-file-input" accept="image/*">
                        <label for="logo" class="custom-file-label">Select Image...</label>
                        <button class="btn btn-primary upload-result mb-1 mt-1" disabled>Upload Photo</button>
                    </div>
                </div>
            </div>
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>@yield('title','Basic Information')</h5>
                    <div class="ibox-tools">
                        @include('components.affiliates.spinners.wave')
                    </div>
                </div>
                <div class="ibox-content">
                    @yield('child')
                </div>
            </div>

        </div>
    </div>
</div>



@endsection

@push('modals')
@include('affiliates.partials.modals._add_new_card_shopping_cart')
@endpush

@push('scripts')
<script src="{{ asset('js/plugins/croppie/croppie.js') }}"></script>
<script src="{{asset(mix('js/ibuumerang/myprofile/myprofile.js'))}}" type="text/javascript"></script>
@endpush