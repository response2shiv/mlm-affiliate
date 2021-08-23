@push('styles')
    <!-- Ladda style -->
    <link href="{{ asset('css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
@endpush


<div class="modal inmodal" id="forget-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h5 class="modal-title">Forgot your password ?</h5>
            </div>
            <div class="modal-body text-center">
                <div>
                    Enter your distributor ID or Username to<br/>receive password resetting email
                </div>
                <div style="margin-top: 10px;">
                    <div class="row">
                        <div class="col-sm-9">
                            <input type="text" id="distid" class="form-control" />
                        </div>
                        <div class="col-sm-3">
                            <button id="btnForgotPass" class="ladda-button btn btn-primary" data-style="expand-right">
                                <span class="ladda-label">Submit</span>
                                <span class="ladda-spinner"></span>
                                <div class="ladda-progress" style="width: 0px;"></div>  
                            </button>
                        </div>
                    </div>
                </div>
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
            Ladda.bind( '.ladda-button',{ timeout: 8500 });

            $("#btnForgotPass").on('click', function() {

                let distid = $("#distid").val();
                let url    = '{{ url('/forgot-password') }}'
               
                $.get(url, {distid: distid}, function(data) {
                    $("#forget-password").modal('hide');
                    $(".div-api-msg").removeClass('invisible');
                    
                    if (data.error == 1) {
                        $(".div-api-msg").addClass("alert-danger");
                    } else {
                        $(".div-api-msg").addClass("alert-success");
                    }

                    $(".api-msg").text(data.msg);
                });
            
            });
        });
    </script>
@endpush