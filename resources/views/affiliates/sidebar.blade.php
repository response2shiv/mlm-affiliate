@section('base-sidebar')
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="logo-element-2">
                <div class="logo">
                    <img alt="image" style="float: left; margin:3px 0px 3px 10px; padding: 3px; width: 90%"  class="profile-element"  src="{{asset('images/logo_200.png')}}"/>
                </div>
            </li>
            <li class="nav-header">
                <div class="dropdown profile-element d-flex flex-column justify-content-center align-items-start">
                    <img alt="image" class="rounded-circle" id="profile-avatar" src="{{ \App\Models\User::getProfilePicture() }}"/>
                    <span class="block font-bold text-white full-name-avatar text-truncate">{{ \App\Models\User::getFirstName() }}<br>{{ \App\Models\User::getLastName() }}</span>
                    <div class="pv-bar" style="width:50%"></div>
                    {{-- <div id="rank-profile-description" class="text-muted text-xs user-title rank-profile-description">{{ \App\Models\User::getRankDescription() }}</div> --}}
                    <div id="rank-profile-description" class="text-muted text-xs user-title rank-profile-description">ISBO</div>
                    <div class="text-muted text-xs user-title rank-profile-description">{{  \App\Models\User::getTsa() }}</div>
                </div>
                    <div class="nav nav-profile profile-element justify-content-left"  align="justify">
                        <ol class="list-unstyled">
                            @if(Auth::user() !== null)
                                @if (Auth::user()->account_status == \App\Models\User::ACC_STATUS_SUSPENDED)
                                    <!-- NO MENU - ACCOUNT IS SUSPENDED-->
                                @elseif (Auth::user()->getConversionCountry() == 'US' && (int)Auth::user()->is_tax_confirmed == 0)
                                    <!-- NO MENU - US costumer with no tax info -->
                                @elseif (Auth::user()->getConversionCountry() == 'UM' && (int)Auth::user()->is_tax_confirmed == 0)
                                    <!-- NO MENU - US costumer with no tax info -->
                                @elseif (Auth::user()->getConversionCountry() == 'VI' && (int)Auth::user()->is_tax_confirmed == 0)
                                    <!-- NO MENU - US costumer with no tax info -->
                                @else
                                    <li> <a href="{{route('affiliates.profile')}}"><i class="fa fa-user mr-3"></i> MY PROFILE</a></li>
                                    <li><a href="{{ route('affiliates.frm.change-password') }}"><i class="fa fa-exchange mr-3"></i> CHANGE PASSWORD </a></li>
                                @endif
                            @endif
                            <li> <a href="{{ route('affiliates.auth.logout') }}"> <i class="fa fa-sign-out mr-3"></i> LOG OUT</a></li>
                        </ol>
                    </div>
                <div class="logo-element">
                  <img alt="image" style="float: left; margin-left:20px; width: 35%; margin-top: -10px; margin-bottom: 7px;"  src="{{asset('assets/images/icon-sm.png')}}"/>
                </div>
            </li>

            @if(Auth::user() !== null)
                @if (Auth::user()->account_status == \App\Models\User::ACC_STATUS_SUSPENDED)
                    <!-- NO MENU - ACCOUNT IS SUSPENDED-->
                @elseif (Auth::user()->getConversionCountry() == 'US' && (int)Auth::user()->is_tax_confirmed == 0)
                    <!-- NO MENU - US costumer with no tax info -->
                @elseif (Auth::user()->getConversionCountry() == 'UM' && (int)Auth::user()->is_tax_confirmed == 0)
                    <!-- NO MENU - US costumer with no tax info -->
                @elseif (Auth::user()->getConversionCountry() == 'VI' && (int)Auth::user()->is_tax_confirmed == 0)
                    <!-- NO MENU - US costumer with no tax info -->
                @else
                    <li {{Request::url() == url('/') ? 'class=active' : ''}}>
                        <a href="{{url('/')}}"><i class="fa fa-th-large"></i> <span class="nav-label">DASHBOARD</span></a>
                    </li>
                    @php
                        $array = [url('/tools/training')];
                    @endphp
                    @if((Auth::user()->current_product_id == 3) ||(Auth::user()->current_product_id == 10))
                        <li {{in_array(Request::url(), $array) ? 'class=active' : '' }}>
                            <a href="#"><i class="fa fa-graduation-cap"></i> <span class="nav-label">NCREASEU</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li {{ Request::url() == url('/tools/training') ? 'class=active' : '' }}>
                                    <a href="{{url('/tools/training')}}"><i class="fa fa-graduation-cap"></i> FX TRAINING</a></li>
                                </li>
                                <li {{ Request::url() == url('/tools/training') ? 'class=active' : '' }}>
                                    <a href="{{url('/tools/live-sessions/new-york')}}"><i class="fa fa-youtube-play"></i> LIVE SESSIONS</a></li>
                                </li>
                            </ul>
                        </li>

                    </li>
                    @endif
                    @php
                        $array = [url('/report/distributors_by_level/'), url('/report/invoice'),url('/report/weekly-binary-report'), url('/report/pear/'),  url('/report/historical/')];
                    @endphp
                    <li {{in_array(Request::url(), $array) ? 'class=active' : '' }}>
                        <a href="#"><i class="fa fa-book"></i> <span class="nav-label">REPORTS</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <!-- <li {{Request::url() == url('/report/distributors_by_level/') ? 'class=active' : ''}}><a href="{{url('/report/distributors_by_level')}}">ORGANIZATIONS</a></li> -->
                            <!-- <li {{Request::url() == url('/report/weekly-binary-report') ? 'class=active' : ''}}><a href="{{url('/report/weekly-binary-report')}}">WEEKLY BINARY</a></li> -->
                            <li {{Request::url() == url('/report/weekly-enrollment-report') ? 'class=active' : ''}}><a href="{{url('/report/weekly-enrollment-report')}}">WEEKLY ENROLLMENT</a></li>
                            <li {{Request::url() == url('/report/pear/') ?  'class=active' : ''}}><a href="{{url('/report/pear/')}}">P.E.A.R.</a></li>
                            <!-- <li {{Request::url() == url('/report/historical/') ? 'class=active' : ''}}><a href="{{url('/report/historical/')}}">HISTORICAL VOLUME </a></li> -->
                        </ul>
                    </li>
                    <!-- <li {{in_array(Request::url(), [url('/individual-boomerangs'), url('/group-boomerangs')]) ? 'class=active' : '' }}>
                        <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Boomerang</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li {{Request::url() == url('/individual-boomerangs') ? 'class=active' : ''}}><a href="{{url('/individual-boomerangs')}}">INDIVIDUAL</a></li>
                            <li {{Request::url() == url('/group-boomerangs') ? 'class=active' : ''}}><a href="{{url('/group-boomerangs')}}">GROUP</a></li>
                        </ul>
                    </li> -->
                    <li  {{Request::url() == url('/commission') ? 'class=active' : ''}}>
                        <a href="/commission"><i class="fa fa-line-chart"></i> <span class="nav-label">COMMISSIONS</span></a>
                    </li>

                    <li {{Request::url() == url('/report/invoice') ? 'class=active' : ''}}>
                        <a href="{{url('/report/orders')}}"><i class="fa fa-newspaper-o"></i> <span class="nav-label">MY ORDERS</span></a>
                    </li>

                    <!-- <li  {{Request::url() == url('/world-series') ? 'class=active' : ''}}>
                        <a href="{{url('/world-series')}}"><i class="fa fa-trophy"></i> <span class="nav-label">WORLD SERIES</span></a>
                    </li> -->

                    <li  {{Request::url() == url('/e-wallet') ? 'class=active' : ''}}>
                        <a href="{{url('/e-wallet')}}"><i class="fa fa-google-wallet"></i> <span class="nav-label">E WALLET</span></a>
                    </li>
                    {{-- <li {{Request::url() == url('/subscription') ? 'class=active' : ''}}>
                        <a href="{{url('/subscription')}}"><i class="fa fa-list-alt"></i> <span class="nav-label">SUBSCRIPTION</span></a>
                    </li> --}}

                    @if(Config::get('const.show_shop_menu'))
                        <li {{Request::url() == url('/shop') ? 'class=active' : ''}}>
                            <a href="{{url('/shop')}}"><i class="fa fa-list-alt"></i> <span class="nav-label">SHOP</span></a>
                        </li>
                    @endif
                    <li {{Request::url() == url('/organization/bucket-placement') ? 'class=active' : ''}}>
                        <a href="{{url('/organization/bucket-placement')}}"><i class="fa fa-users"></i> <span class="nav-label">PLACEMENT LOUNGE</span></a>
                    </li>
                    <li {{ in_array(Request::url(), [url('/organization/entire-organization-report'), url('/organization/binary-viewer'), url('/organization/customers'), url('/organization/placement')]) ? 'class=active' : '' }}>
                        <a href="#"><i class="fa fa-group"></i> <span class="nav-label">ORGANIZATION</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li {{Request::url() == url('/organization/entire-organization-report') ? 'class=active' : ''}}><a href="{{url('/organization/entire-organization-report')}}" target="_blank">ENTIRE ORGANIZATION REPORT</a></li>
                            <li {{Request::url() == url('/organization/binary-viewer') ? 'class=active' : ''}}><a href="{{url('/organization/binary-viewer')}}" target="_blank">BUCKET VIEWER</a></li>
                            {{-- <li {{Request::url() == url('/organization/placement') ? 'class=active' : ''}}><a href="{{url('/organization/placement')}}">BUCKET PLACEMENT</a></li> --}}
                            <li {{Request::url() == url('/organization/customers') ? 'class=active' : ''}}><a href="{{url('/organization/customers')}}">CUSTOMERS</a></li>
                        </ul>
                    </li>
                    {{--  <li>
                        <a href="#" data-toggle="modal" data-target="#modalBuyVoucher" id="btnVoucher"><i class="fa fa-ticket"></i> <span class="nav-label">BUY VOUCHER</span></a>
                    </li>  --}}
                    {{--  <li>
                        <a href="javascript:;" id="login-to-events-browse-btn"><i class="fa fa-list-alt"></i> <span class="nav-label">EVENTS</span></a>
                        <a id="current-user-events-token" style="display: none;" href="" >{{ App\Models\User::getRememberTokenForEvents() }}</a>
                    </li>
                    <form method="POST" id="login-to-events-browse" name="login-to-events-browse" action="{{ Config::get('app.events_url') }}/signin/ibuum-user" target="_blank" autocomplete="off">
                        <input type="hidden" name="token" value="*****" />
                    </form>
                    @php
                        $arrayT = [url('/tools'), url('/tools/medias'), url('/tools/presentations'), url('/tools/training'), url('/tools/downloads')];
                    @endphp  --}}
                    <li class="mb-5 mb-md-3 {{ in_array(Request::url(), $array) ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-group"></i> <span class="nav-label">TOOLS</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li {{ Request::url() == url('/tools') ? 'class=active' : '' }}><a href="{{url('/tools')}}">DOCUMENT LIBRARY</a></li>
                            {{--<li {{ Request::url() == url('/tools/training') ? 'class=active' : '' }}><a href="{{url('/tools/training')}}">TRAINING</a></li>--}}
                            {{--<li {{ Request::url() == url('/tools/downloads') ? 'class=active' : '' }}><a href="{{url('/tools/downloads')}}">DOWNLOADS</a></li> --}}
                            @php
                                /*<li {{ Request::url() == url('/tools/presentations') ? 'class=active' : '' }}><a href="{{url('/tools/presentations')}}">PROMOS</a></li>*/
                            @endphp
                        </ul>
                    </li>
                @endif
            @endif
        </ul>
        <div class="mt-5" ></div>
    </div>
</nav>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#login-to-events-browse-btn').on('click',function (event) {
                event.preventDefault();

                var remember_token = $("#current-user-events-token").text();
                var eventLogin = document.querySelector('#login-to-events-browse');
                var eventLoginToken = eventLogin.querySelector('input[name="token"]');

                $.ajax({
                    url: '{{route("api-request")}}',
                    method: 'POST',
                    data: {
                            method:'POST',
                            endpoint:'/affiliate/dashboard/events-update-token',
                            remember_token : remember_token
                    },
                    success: function(res) {
                        eventLoginToken.setAttribute('value', res.data);
                        $("#login-to-events-browse").submit();
                    }
                })

            });
        });
    </script>
@endpush

@push('modals')
    @include('affiliates.partials.modals._buy_voucher')

    @component('components.toast', ['title' => 'Notification'])
        <p id="toastContent"></p>
    @endcomponent
@endpush
