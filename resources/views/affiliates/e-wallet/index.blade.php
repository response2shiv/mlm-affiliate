@extends('layouts.affiliates')
@push('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endpush
@section('base-content')
{{-- @include('affiliate.e-wallet.widgets.dlg_payap_config') --}}
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
      <div class="col-lg-12">
          <div class="ibox ">
              <div class="ibox-title">
                  <h5>My E-Wallet</h5>
                  <div class="ibox-tools">
                  </div>
              </div>
              <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-12">
                            @include('affiliates.e-wallet.widgets.ipayout')
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">

                            @include('affiliates.e-wallet.widgets.tax1099')
                        </div>
                    </div>
              </div>
          </div>
      </div>
      <div class="col-lg-12">
          <div class="ibox ">
              <div class="ibox-title">
                  <h5>Transfer History</h5>
                  <div class="ibox-tools">
                  </div>
              </div>
              <div class="ibox-content">

                      @include('affiliates.e-wallet.widgets.transfer_history')

              </div>
          </div>
      </div>
  </div>
</div>
@endsection

@push('modals')
    <!-- SMS -->
    <div class="modal fade" tabindex="-1" role="dialog" id="2FactorDialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header m-portlet m-portlet--info m-portlet--head-solid-bg m-portlet__head m--align-center">
                    <h3 class="m-portlet__head-text">Verification</h3>
                </div>
                <div class="modal-body">
                    <div id="test">
                        <div class="col-md-12">A 7 digit confirmation code has been sent via SMS / text to the
                            mobile number you provided. Please enter it here.
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3">
                            <input type="text" class="form-control" id="verificationCode" maxlength="7"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="button" id="btnSubmit2FAEWallet" class="btn btn-primary rounded-pill">Submit</button>
                            <button type="button" id="btnSubmit2FAETransfer" class="btn btn-primary rounded-pill">Submit</button>
                            <button type="button" data-dismiss="modal" class="btn btn-primary rounded-pill ">Cancel</button>
                        </div>
                        <div class="col-md-12 mt-3">
                            <span id="btnResend2FAEWallet" class="font-weight-bold span-link">Resend My Code</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EMAIL -->
    <div class="modal fade" tabindex="-1" role="dialog" id="2FactorDialogEmail">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header m-portlet m-portlet--info m-portlet--head-solid-bg m-portlet__head m--align-center">
                    <h3 class="m-portlet__head-text">Verification</h3>
                </div>
                <div class="modal-body">
                    <div id="test">
                        <div class="col-md-12">A 7 digit confirmation code has been sent to the
                            EMAIL you provided. Please enter it here.
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3">
                            <input type="text" class="form-control" id="verificationCode" maxlength="7"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                            <input type="text" class="form-control" id="authyUserId" value="" hidden>
                        <div class="col-md-12 mt-4">
                            <button type="button" id="btnSubmitEmail2FAETransfer" class="btn btn-primary rounded-pill">Submit</button>
                            <button type="button" data-dismiss="modal" class="btn btn-primary rounded-pill ">Cancel</button>
                        </div>
                        <div class="col-md-12 mt-3">
                            <span id="btnResendEmail2FAEWallet" class="font-weight-bold span-link">Resend My Code</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="2FactorDialogPDF">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header m-portlet m-portlet--info m-portlet--head-solid-bg m-portlet__head m--align-center">
                    <h3 class="m-portlet__head-text">Verification</h3>
                </div>
                <div class="modal-body">
                    <div id="test">
                        <div class="col-md-12">A 7 digit confirmation code has been sent via SMS / text to the
                            mobile number you provided. Please enter it here.
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3">
                            <input type="text" class="form-control" id="verificationCode" maxlength="7"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="button" id="btnSubmit2FAEPDF" class="btn btn-primary rounded-pill">Submit</button>                            
                            <button type="button" data-dismiss="modal" class="btn btn-primary rounded-pill ">Cancel</button>
                        </div>
                        <div class="col-md-12 mt-3">
                            <span id="btnResend2FAEWalletPDF" class="font-weight-bold span-link">Resend My Code</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EMAIL -->
    <div class="modal fade" tabindex="-1" role="dialog" id="2FactorDialogEmailPDF">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header m-portlet m-portlet--info m-portlet--head-solid-bg m-portlet__head m--align-center">
                    <h3 class="m-portlet__head-text">Verification</h3>
                </div>
                <div class="modal-body">
                    <div id="test">
                        <div class="col-md-12">A 7 digit confirmation code has been sent to the
                            EMAIL you provided. Please enter it here.
                        </div>
                        <div class="col-md-6 offset-md-3 mt-3">
                            <input type="text" class="form-control" id="verificationCode" maxlength="7"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                            <input type="text" class="form-control" id="authyUserId" value="" hidden>
                        <div class="col-md-12 mt-4">
                            <button type="button" id="btnSubmit2FAEWalletEmailPDF" class="btn btn-primary rounded-pill">Submit</button>
                            <button type="button" data-dismiss="modal" class="btn btn-primary rounded-pill ">Cancel</button>
                        </div>
                        <div class="col-md-12 mt-3">
                            <span id="btnResendEmail2FAEWalletPDF" class="font-weight-bold span-link">Resend My Code</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('affiliates.partials.modals._check_for_2fa')
    @include('affiliates.partials.modals._check_for_2fa_PDF')

@endpush

@push('scripts')
    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/ewallet/ewallet.js') }}"></script>
    <script src="{{ asset('js/plugins/intTelInput/intlTelInput-jquery.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/utils.js') }}"></script>
    <script>
        $("#txtSendPDFSMS").intlTelInput({
            utilsScript: '/js/ibuumerang/utils.js',
            initialCountry: "{{\Auth::user()->country_code}}",
        });
        $("#txtSendSMS").intlTelInput({
            utilsScript: '/js/ibuumerang/utils.js',
            initialCountry: "{{\Auth::user()->country_code}}",
        });
    </script>

@endpush
