@component('layouts.components.modal', [
        'id' => $id ?? 'modalThankYou',
        'header' => [
            'image' => asset('assets/images/iBuumerangLogo.png'),
            'width' => '180px'
        ]
    ])

    <div class="row">
        <div class="col-12 text-center">
            <h3 class="thank-you divider">Thank you! Your order is complete</h3>
        </div>
    </div>

    @slot('actions')        
        <button id="btnCloseModalThankYou" class="ladda-button btn btn-yellow" data-style="expand-right">
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
            Ladda.bind( '#btnCloseModalThankYou',{ timeout: 10000 });
        });
        $('#btnCloseModalThankYou').on('click', function () {
            location.reload();
        });
    </script>
@endprepend
