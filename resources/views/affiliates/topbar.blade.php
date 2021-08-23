@section('base-topbar')
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
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
                    <div class="topbar_icons d-flex flex-row">
                        <li class="text-nowrap" data-toogle="tooltip" id="tooltip-shopping-cart" data-placement="top" title="Shopping Cart">
                            @include('affiliates.widgets.topbar.shopping-cart')
                        </li>
                        <!-- 
                        <li class="" data-toggle="tooltip" id="tooltip-billgenius" data-placement="top" title="Bill Genius Portal">
                            @include('affiliates.widgets.topbar.billgenius')
                        </li>
                        <li class="" data-toggle="tooltip" id="tooltip-foundation" data-placement="top" title="The büüm Foundation">
                            @include('affiliates.widgets.topbar.foundation')
                        </li>
                        <li class="" data-toggle="tooltip" id="tooltip-idecide" data-placement="top" title="iDecide Portal">
                            @include('affiliates.widgets.topbar.idecide')
                        </li>
                        <li data-toggle="tooltip" data-placement="top" id="tooltip-igo" title="iGo Portal">
                            @include('affiliates.widgets.topbar.igo')
                        </li> -->
                   </div>
               @endif
          @endif
        </ul>
    </nav>
</div>
@endsection

@push('scripts')
    <script>
        $("#tooltip-foundation").tooltip();
        $("#tooltip-idecide").tooltip();
        $("#tooltip-igo").tooltip();
        $("#tooltip-shopping-cart").tooltip();
        $("#tooltip-billgenius" ).tooltip();
    </script>
@endpush
