@component('layouts.components.modal', [
    'id' => 'modalIGoAgreement',
    'header' => [
        'image' => asset('assets/images/igo-logo.png'),
        'width' => '60px'
    ]])

    <div class="row">
        <div class="col-8 offset-2 text-center">
            <h4>Congratulations, You are about to enter iGo and enjoy access to members only prices for travel! But first, a little housekeeping:</h4>
        </div>

        <div class="col-12 mt-3">
            <div class="well">
                <p>By clicking Agree and Continue, I hereby,</p>
                <p>agree and consent to the Terms and Conditions, its policies, Privacy Policy and Spam Policy.</p>
                <p>agree by proceeding to create my account that I am entering a proprietary system using iGo services, therefore, I agree to waive the right to a refund. I expressly instruct ncrease to communicate specific information about me and my account to third parties in accordance with the Privacy Policy.</p>
                <p>Specifically, and expressly consent to the use of website tracking methods, including cookies, and to the safe and secure transmission of my personal information outside the European Economic Area in accordance with the Privacy Policy are agreeing to our Terms and Conditions and Privacy Policy.</p>
            </div>
        </div>
    </div>

    @slot('actions')
        <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
        <button class="btn btn-yellow" id="btnAcceptAndContinue">Accept & Continue</button>
    @endslot
@endcomponent

@push('scripts')
    <script>
        $('#modalIGoAgreement #btnAcceptAndContinue').on('click', function () {
            $(this).html('Processing...').attr('disabled', 'disabled');

            ajaxReq('/affiliate/save-on/create-save-on-account', 'POST', {}, function (res) {
                if (res.error === "0") {
                    window.open(res.url);
                    $('#modalIGoAgreement').modal('hide');
                }
            });
        });

        $('#modalIGoAgreement').on('hidden.bs.modal', function (e) {
            $('#modalIGoAgreement #btnAcceptAndContinue').html('Accept & Continue').removeAttr('disabled');
        });
    </script>
@endpush
