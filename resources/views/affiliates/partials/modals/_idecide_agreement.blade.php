@component('layouts.components.modal', [
    'id' => 'modalIDecideAgreement',
    'header' => [
        'image' => asset('assets/images/iDECIDE_SSO.png'),
        'width' => '170px'
    ]])

    <div class="row">
        <div class="col-8 offset-2 text-center">
            <h4>Congratulations, You are about to enter iDecide a personalized interactive presentation platform! iDecide makes sharing the ncrase story easier than ever.</h4>
        </div>

        <div class="col-12 mt-3">
            <div class="well">
                <p>By clicking Agree and Continue, I hereby,</p>
                <p>agree and consent to the Terms and Conditions, its policies, Privacy Policy and Spam Policy.</p>
                <p>agree by proceeding to create my account that I am entering a proprietary system using iDecide services, therefore, I agree to waive the right to a refund. I expressly instruct ncrease to communicate specific information about me and my account to third parties in accordance with the Privacy Policy and Spam Policy.</p>
                <p>Specifically, and expressly consent to the use of website tracking methods, including cookies, and to the safe and secure transmission of my personal information outside the European Economic Area in accordance with the Privacy Policy, Spam Policy.</p>
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
        $('#modalIDecideAgreement #btnAcceptAndContinue').on('click', function () {
            $(this).html('Processing...').attr('disabled', 'disabled');

            ajaxReq('/affiliate/idecide/create-idecide-account', 'POST', {}, function (res) {
                if (res.error === "0") {
                    window.open(res.url);
                    $('#modalIDecideAgreement').modal('hide');
                }
            });
        });

        $('#modalIDecideAgreement').on('hidden.bs.modal', function (e) {
            $('#modalIDecideAgreement #btnAcceptAndContinue').html('Accept & Continue').removeAttr('disabled');
        });
    </script>
@endpush
