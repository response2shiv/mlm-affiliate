@component('layouts.components.modal', [
    'id' => 'modalConfirmPlace',
    'header' => [
        'image' => asset('images/logo_200.png'),
    ]])

    <div class="row">
        <div class="col-8 offset-2 text-center">
            <h4>ATTENTION</h4>
        </div>

        <div class="col-12 mt-3">
            <div class="well text-center">
                <p id="placedUser">

                </p>
                    <h3 class="font-italic" style="color: #f74827;">DOUBLE CHECK! ALL PLACEMENTS ARE FINAL!</h3>
            </div>
        </div>
    </div>

    @slot('actions')
        <button class="btn btn-dark" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="btnPlaceContinue">Confirm</button>
    @endslot
@endcomponent

@push('scripts')
    <script>
        $('#modalConfirmPlace #btnPlaceContinue').on('click', function () {
            $(this).html('Processing...').attr('disabled', 'disabled');

            let bucket = $('input[name=bucket]:checked').val() ?? 0;
                $.get('/organization/place-selected/'+bucket)
                .done(function( data ) {
                    showPopupNotification("success", "User placed successfully");
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                });             
        });

        $('#modalConfirmPlace').on('hidden.bs.modal', function (e) {
            $('#modalConfirmPlace #btnPlaceContinue').html('Confirm').removeAttr('disabled');
        });
    </script>
@endpush
