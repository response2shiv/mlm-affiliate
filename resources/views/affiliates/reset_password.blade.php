@push('styles')
    <!-- Ladda style -->
    <link href="{{ asset('css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
@endpush

<div class="modal fade" id="dd_reset_pass" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resetting Password</h5>
            </div>
            <div class="modal-body">
                <form id="frmResetPass" class="m-form m-form__section--first m-form--label-align-right">
                    <input type="hidden" name="token" value="{{$token}}" />
                    <div class="form-group m-form__group row">
                        <label class="col-md-5 col-form-label">New Password</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="pass_1">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-md-5 col-form-label">Re-enter new password</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="pass_2">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnSetNewPass" class="ladda-button btn btn-primary" data-style="expand-right">
                    <span class="ladda-label">Submit</span>
                    <span class="ladda-spinner"></span>
                    <div class="ladda-progress" style="width: 0px;"></div>  
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <!-- Ladda -->
    <script src="{{ asset('js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Bind normal buttons
            Ladda.bind( '.ladda-button',{ timeout: 5500 });

            $('#dd_reset_pass').modal('hide');

            let reset = '{{ $type }}';

            if (reset == 'reset-password') {
                $('#dd_reset_pass').modal('show')
            }

            $("#btnSetNewPass").on('click', function() {

                let url    = '{{ url('/reset-password') }}';
                let pass_1 = $('input[name="pass_1"]').val();
                let pass_2 = $('input[name="pass_2"]').val();
                let token  = $('input[name="token"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post(url, {pass_1: pass_1, pass_2: pass_2, token: token}, function(data) {
                    $("#forget-password").modal('hide');
                    $(".div-api-msg").removeClass('invisible');
                    
                    if (data.error == 1) {
                        $(".div-api-msg").addClass("alert-danger");
                    } else {
                        $(".div-api-msg").addClass("alert-success");
                    }

                    $(".api-msg").html(data.msg);
                });

                setTimeout(function() {
                    $("#dd_reset_pass").modal('hide');
                },5500);

            });
        });  
    </script>
@endpush