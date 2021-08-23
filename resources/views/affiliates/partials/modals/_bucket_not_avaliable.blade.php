@component('layouts.components.loading', ['id' => 'bucketNotAvaliable'])
    @slot('title')
        <div class="text-center">
            <img src="{{asset('images/logo_200.png')}}">
        </div>
    @endslot

    <div class="row">
        <div class="col-12 text-center">
            <h3 class="thank-you divider">This feature is not available to you yet...</h3>
            <p class="mt-5">You are not allowed to use the Placement Lounge<br> until you are placed in the tree. Please contact your sponsor and request to be placed.</p>
        </div>
        <div class="col-12 text-center">
            <button id="btnReturnToDashboard" class="ladda-button btn btn-primary" data-style="expand-right">
                <span class="ladda-label">Return to Dashboard</span>
                <span class="ladda-spinner"></span>
                <div class="ladda-progress" style="width: 0px;"></div>  
            </button>
        </div>
    </div>

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
            window.location.href = '/';
        });
    </script>
@endprepend
