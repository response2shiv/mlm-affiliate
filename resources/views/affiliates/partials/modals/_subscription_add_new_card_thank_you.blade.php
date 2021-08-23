@component('layouts.components.modal', [
    'id' => 'modalSuscriptionAddNewCardThankYou',
    'header' => [
        'image' => asset('assets/images/iBuumerangLogo.png'),
        'width' => '150px'
    ],
    'modal_size' => 'modal-sm'
    ])

    <div class="row">
        <div class="col-12 text-center">
            <h4 class="thank-you">New card added</h4>
        </div>
    </div>

    @slot('actions')        
        <button id="btnSubscriptionAddNewCardThankYouReturnToDashboard" class="ladda-button btn btn-yellow" data-style="expand-right">
            <span class="ladda-label">close</span>
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
            Ladda.bind( '#btnSubscriptionAddNewCardThankYouReturnToDashboard',{ timeout: 10000 });
        });      
    </script>
@endprepend