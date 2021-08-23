@push('styles')
{{--  <link rel="stylesheet" href="{{ asset('css/plugins/intTelInput/intlTelInput.css') }}">   --}}
@endpush

<div class="ibox ibox-content br-20">
    {{--
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center">
            <img src="{{ asset('assets/images/ibuum_gen_logo.png') }}" id="logoWidgetImage" class="img-widget-logo">
            <img src="{{ asset('assets/images/generic_bg.png') }}" id="widgetImage" class="img-fluid" />
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-center p-4">
            <div class="dashboard_2_dashboard_1_image">
                <img src="{{asset('assets/images/dashboard/icon-sm.png')}}" />
            </div>
            <div class="dashboard_2_dashboard_1_container_1">
                <div class="dashboard_2_dashboard_1_container_1_left">
                    <div class="widget_title buumerang_title">Available ncrease</div>
                    <div class="widget_subtitle">excluding active</div>
                </div>
                <div class="dashboard_2_dashboard_1_container_1_right">
                    <div class="dashboard_2_dashboard_1_container_value" id="available_buumerangs">{{ $dashboard['buumerangs']['available'] }}</div>
                </div>
            </div>
            <div class="dashboard_2_dashboard_1_container_2">
                <div class="dashboard_2_dashboard_1_container_2_left">
                    <div class="widget_title buumerang_title">Pending ncrease</div>
                    <div class="widget_subtitle">active links</div>
                </div>
                <div class="dashboard_2_dashboard_1_container_2_right">
                    <div class="dashboard_2_dashboard_1_container_value" id="pending_buumerangs">{{ $dashboard['buumerangs']['pending'] }}</div>
                </div>
            </div>
            <div class="dashboard_2_dashboard_1_footer">
                <button type="button" class="btn btn-primary rounded-pill" id="btnReloadBuumerangs">Reload ncrease</button>
                <!-- <button type="button" class="btn btn-primary rounded-pill" id="btnAddProductShoppingCart" data-product-id="15">Reload ncrease</button> -->
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 p-4 b-r">
            <div class="form-group">
                <label for="type" class="control-label">Type of crease</label>
                <select name="type" id="type" class="form-control">
                    <option value="">...</option>
                    <option value="igo">iGo</option>
                    <option value="vibe-rider">Vibe Rider</option>
                    <option value="vibe-driver">Vibe Driver</option>
                    <option value="bill-genius">BillGenius</option>
                </select>
            </div>

            <div class="buttons text-center">
                <div class="btn-group d-none" role="group" aria-label="Group" id="group">
                    <button type="button" class="btn btn-xs btn-primary rounded-pill" id="btnIndividual">Individual</button>
                    <button type="button" class="btn btn-xs btn-outline-primary rounded-pill" id="btnGroup">Group</button>
                </div>

                <input type="hidden" name="igoType" value="individual">
            </div>

            <div class="dashboard_2_dashboard_2_container_input" data-type="group">
                <div class="dashboard_2_dashboard_2_container_input_title">
                    <span>CAMPAIGN NAME</span>
                    <span style="color: red;">*</span>
                </div>
                <input type="text" class="form-control" id="campaign_name" name="campaign_name">
            </div>

            <div class="row">
                <div class="dashboard_2_dashboard_2_container_input col-6" data-type="individual">
                    <div class="dashboard_2_dashboard_2_container_input_title">
                        <span>FIRST NAME</span>
                        <span style="color: red;">*</span>
                    </div>
                    <input type="text" class="form-control" id="firstname" name="firstname">
                </div>

                <div class="dashboard_2_dashboard_2_container_input col-6" data-type="individual">
                    <div class="dashboard_2_dashboard_2_container_input_title">
                        <span>LAST NAME</span>
                        <span style="color: red;">*</span>
                    </div>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
            </div>

            <div class="dashboard_2_dashboard_2_container_input" data-type="individual">
                <div class="dashboard_2_dashboard_2_container_input_title">
                    <span>EMAIL</span>
                    <span style="color: red;">*</span>
                </div>
                <input type="text" class="form-control" id="email" name="email">
            </div>

            <div class="row">
                <div class="dashboard_2_dashboard_2_container_input col-md-6 col-sm-12" data-type="individual">
                    <div class="dashboard_2_dashboard_2_container_input_title">
                        <span>PHONE NUMBER</span>
                        <span style="color: red;">*</span>
                    </div>
                    <input type="text" class="form-control" id="txtSendSMS" name="mobile">
                </div>

                <div class="dashboard_2_dashboard_2_container_dropdown col-md-6 col-sm-12">
                    <div class="dashboard_2_dashboard_2_container_dropdown_1">
                        <div class="dashboard_2_dashboard_2_container_input_title">
                            <span>EXPIRATION DATE</span>
                            <span style="color: red;">*</span>
                        </div>
                        <select class="dashboard_2_dashboard_2_container_dropdown_1_select form-control" id="exp_date" name="exp_date">
                            <option value="">Select...</option>
                            <option value="1">1 DAY</option>
                            <option value="3">3 DAYS</option>
                            <option value="7">7 DAYS</option>
                            <option value="15">15 DAYS</option>
                            <option value="45">45 DAYS</option>
                            <option value="60">60 DAYS</option>
                            <option value="90">90 DAYS</option>
                        </select>
                    </div>
                    <div class="dashboard_2_dashboard_2_container_dropdown_2" data-type="group">
                        <div class="dashboard_2_dashboard_2_container_input_title">
                            <span>NUMBER OF USES</span>
                            <span style="color: red;">*</span>
                        </div>
                        <input class="form-control" type="text" id="number_of_uses" name="number_of_uses">
                    </div>
                </div>
            </div>

            <div class="dashboard_2_dashboard_2_container_dropdown">
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <button type="button" class="btn btn-primary form-control boomerang-code-btn rounded-pill" id="btnGenerateCode">
                            <img src="{{ asset('assets/images/white-icon.png') }}" width="15" height="15" alt="white-icon">
                            Generate
                        </button>
                    </div>

                    <div class="col-md-6">
                        <div class="dashboard_2_dashboard_2_container_dropdown_2">
                            <div class="dashboard_2_dashboard_2_container_input_title">
                                <span>Ncrease CODE</span>
                            </div>
                            <input class="form-control" type="text" id="buumerang_code" name="buumerang_code" readonly>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 d-flex flex-column align-items-center justify-content-start p-4">
            <div class="text-center">
                <h4>Send ncrease!</h4>
            </div>
            <div class="text-center mt-2">Choose a method to send</div>
            <div class="d-flex flex-column mt-5">
                <button type="button" class="btn btn-primary rounded-pill" id="btnSendSMS">Send as SMS</button>
                <button type="button" class="btn btn-primary rounded-pill mt-3" id="btnSendEmail">Send as Email</button>
                <button class="btn btn-primary rounded-pill mt-3" id="buttonClipboard" data-clipboard-text="">Copy to Clipboard</button>
            </div>
        </div>
    </div>
    --}}
</div>

@push('scripts')
{{--
<script src="{{ asset('js/plugins/intTelInput/intlTelInput-jquery.js') }}"></script>
<script src="{{ asset('js/ibuumerang/utils.js') }}"></script>
<script src="{{ asset('js/plugins/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset(mix('js/ibuumerang/dashboard/widgets/buumerang.js')) }}"></script>
--}}
@endpush

{{--

@push('modals')
@include('affiliates.partials.modals._reload_buumerangs')
@include('affiliates.partials.modals._checkout')

@component('components.toast', ['title' => 'Notification'])
<p id="toastContent"></p>
@endcomponent
@endpush
--}}
