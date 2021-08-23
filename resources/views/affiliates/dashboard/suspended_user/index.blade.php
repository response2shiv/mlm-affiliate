@extends('layouts.affiliates')

@section('base-content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title text-center" style="background-color: #01B6EB">
                        <h5 class="suspended-message">
                            Your payment did not successfully run with your current payment method. Your access has been temporarily restricted. Please add an alternative payment method to reactivate your subscription.
                        </h5>
                    </div>
                    <div class="ibox-content text-center">
                        <h4> Would you like to reactivate your account?</h4>
                        <br>
                        <button id="reactivate-subscription-suspended-user" class="btn m-btn m-btn--air btn-info" data-href="{{URL::to('dlg-subscription-reactivate-suspended-user')}}">
                        	Yes
                        </button>
                    </div>
                </div>
            </div>
	    </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery UI -->
    <script src="{{ asset('js/ibuumerang/suspended_user.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endpush