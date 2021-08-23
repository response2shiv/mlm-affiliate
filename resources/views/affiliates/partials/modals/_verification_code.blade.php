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