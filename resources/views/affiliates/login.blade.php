@extends('layouts.affiliates')

@section('base_body')
    @if(isset($type) && $type = 'reset-password')
        @include('affiliates.reset_password')
    @endif
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div class="login-panel">
                <img class="logo-name" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
            </div>

            <form class="m-t" action="{{ route('authenticate') }}" method="POST">
                @csrf

                @if ($errors->count() > 0)
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <div class="alert alert-dismissable div-api-msg invisible">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <span class="api-msg"></span>
                </div>

                <div class="form-group">
                    <label for="username" class="control-label text-uppercase font-weight-bold"></label>
                    <input type="text" name="username" class="form-control @if ($errors->has('username')) is-invalid @endif" placeholder="USERNAME" />
                    @if ($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class="control-label text-uppercase font-weight-bold"></label>
                    <input type="password" name="password" class="form-control @if ($errors->has('password')) is-invalid @endif" placeholder="PASSWORD">
                    @if ($errors->has('password'))
                        <div class="invalid-feedback text-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <div class="">
                        <div class="text-left icheckbox_square-green" style="margin-left: 8%">
                            <input type="hidden" name="remember" value="false">
                            <input class="form-check-input" type="checkbox" value="true" name="remember" style="position: absolute; display: block; padding: 0px; background: rgb(255, 255, 255); border: 0px; ">
                            <label class="form-check-label" style="color: gray; font-weight: bold;">Remember me</label>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button class="ladda-button btn btn-login block btn-lg btn-block" type="submit" data-style="expand-right">
                        <span class="ladda-label">LOG IN</span>
                        <span class="ladda-spinner"></span>
                        <div class="ladda-progress" style="width: 0px;"></div>
                    </button>
                </div>

                <div class="form-group">
                    <div class="col-12 div-forget-password">
                        <a href="#" data-toggle="modal" data-target="#forget-password" class="forget-password">FORGOT YOUR PASSWORD?</a>
                    </div>
                </div>.
            </form>
        </div>
    </div>
    @include('affiliates.forgot_password')
@endsection

@push('scripts')
    <!-- Ladda -->
    <script src="{{ asset('js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ladda/ladda.jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Bind normal buttons
            Ladda.bind( '.btn-login',{ timeout: 10500 });
            localStorage.removeItem("modalAttention");
        });
    </script>
@endpush
