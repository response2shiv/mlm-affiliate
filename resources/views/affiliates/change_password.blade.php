@extends('layouts.affiliates')
@push('styles')
    <!-- Ladda style -->
    <link href="{{ asset('css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
@endpush
@section('base-content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row justify-content-center div-change-password">
            <div class="col-lg-7">
                <div class="alert alert-dismissable div-api-msg invisible text-center">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <span class="api-msg"></span>.
                </div>
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Change Password</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Current Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="current_pass">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">New Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="pass_1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Re-enter New Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="pass_2">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button id="btnChangePass" class="ladda-change-password btn btn-primary" data-style="zoom-in">
                                <span class="ladda-label">Change Password</span>
                                <span class="ladda-spinner"></span>
                                <div class="ladda-progress" style="width: 0px;"></div>  
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
    <!-- Ladda -->
    <script src="{{ asset('js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Bind normal buttons
            Ladda.bind( '.ladda-change-password',{ timeout: 3500 });

            $("#btnChangePass").on('click', function() {
                $(".div-api-msg").addClass('invisible');

                let url           = '{{ url('/change-password') }}';
                let pass_1        = $('input[name="pass_1"]').val();
                let pass_2        = $('input[name="pass_2"]').val();
                let current_pass  = $('input[name="current_pass"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post(url, {pass_1: pass_1, pass_2: pass_2, current_pass: current_pass}, function(data) {
                    $(".div-api-msg").removeClass('invisible');
                    
                    if (data.response_code != 200) {
                        $(".div-api-msg").removeClass('alert-success');
                        $(".div-api-msg").addClass("alert-danger");
                    } else {
                        $(".div-api-msg").removeClass("alert-danger");
                        $(".div-api-msg").addClass("alert-success");
                        $('input[name="pass_1"]').val('');
                        $('input[name="pass_2"]').val('');
                        $('input[name="current_pass"]').val('');
                    }

                    $(".api-msg").text(data.message);
                });
            });
        });
    </script>
@endpush
