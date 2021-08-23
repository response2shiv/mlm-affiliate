@component('layouts.components.modal', ['id' => 'modalAlert'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="row">
        <div class="col-12 text-center">
            <h3 id="alert-title" class="thank-you divider"></h3>
            <p id="alert-message"class="mt-5"></p>
        </div>
    </div>

    @slot('actions')
        <button id="btnYesAlert" class="ladda-button btn btn-yellow" data-style="expand-right">
            <span class="ladda-label">Yes, set it!</span>
            <span class="ladda-spinner"></span>
            <div class="ladda-progress" style="width: 0px;"></div>  
        </button>
        
        <button id="btnCancelAlert" class="ladda-button btn btn-yellow" data-style="expand-right">
            <span class="ladda-label">Cancel</span>
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
            Ladda.bind( '#btnCancelAlert',{ timeout: 10000 });
            Ladda.bind( '#btnYesAlert',{ timeout: 10000 });
        });
        $('#btnCancelAlert').on('click', function () {
            location.reload();
        });
    </script>
@endprepend