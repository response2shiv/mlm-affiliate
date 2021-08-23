@component('layouts.components.loading', ['id' => 'waitingPayment'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="row">
        <div class="col-12 text-center">
        <div class="spinner-border text-primary mb-3" role="status">
            <span class="sr-only">Loading...</span>
        </div>
            <h3 class="thank-you divider">Waiting Paiment</h3>
            <h3 class="py-3">Your purchase is being processed and we are waiting for the payment confirmation. You will be redirected to the payment system.</h3>
        </div>
    </div>
@endcomponent

@prepend('scripts')

    <script src="{{ asset('js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.jquery.min.js') }}"></script>

@endprepend
