    @push('styles')
            <link rel="stylesheet" href="{{ asset('css/plugins/intTelInput/intlTelInput.css') }}">
    @endpush
    
    <!-- EMAIL or SMS -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalSendType">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header m-portlet m-portlet--info m-portlet--head-solid-bg m-portlet__head m--align-center">
                    <h3 class="m-portlet__head-text">Verification</h3>
                </div>
                <div class="modal-body">
                    <div id="test">
                        <div class="col-md-12">Choose a sending method</div>
                        <div class="form-check-inline">
                            <label>
                                <input type="radio"  value="email" id="email-option" name="options">
                                E-mail
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label>
                                <input type="radio" checked value="sms" id="sms-option" name="options">
                                SMS
                            </label>
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3">
                            <input type="text" class="form-control" id="txtSendSMS" placeholder="" value="{{\Auth::user()->phonenumber}}">
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3 form-group">
                            <input type="text" class="form-control" id="txtSendEmail" placeholder="name@email.com" value="{{\Auth::user()->email}}">
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="button" id="btnTranfer" class="btn btn-primary rounded-pill">Submit</button>
                        </div>
                    </div>

                    <p class="mt-2">Having trouble receiving the Code? <br>
                       Please download the Authy app on your mobile phone.
                    </p>
                    <a href="https://play.google.com/store/apps/details?id=com.authy.authy" target="_blank"> <img src="{{asset('assets/images/playstore.png')}}" width="100px"/></a>
                    <a href="https://apps.apple.com/us/app/twilio-authy/id494168017" target="_blank"> <img src="{{asset('assets/images/appstore.png')}}" width="100px"/></a>
                </div>
            </div>
        </div>
    </div>
