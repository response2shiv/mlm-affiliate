@component('layouts.components.modal', ['id' => 'modalThankYou'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="row">
        <div class="col-12 text-center">
            <h3 class="thank-you divider">Thank you! Your order is complete</h3>
            <p class="mt-5">Your new ncrease should be in your inventory and available for sending now! Enjoy your purchase!</p>
        </div>
    </div>

    @slot('actions')
        <button id="btnReturnToDashboard" class="ladda-button btn btn-yellow" data-style="expand-right">
            <span class="ladda-label">Return to Dashboard</span>
            <span class="ladda-spinner"></span>
            <div class="ladda-progress" style="width: 0px;"></div>  
        </button>
    @endslot
@endcomponent

@prepend('scripts')

    <script src="{{ asset('js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Bind normal buttons
            Ladda.bind( '#btnReturnToDashboard',{ timeout: 10000 });
        });
        $('#btnReturnToDashboard').on('click', function () {
            location.reload();
        });
    </script>
@endprepend
