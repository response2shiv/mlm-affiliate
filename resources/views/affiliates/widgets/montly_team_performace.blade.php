<div class="ibox float-e-margins">
    <div class="ibox-title widget-rounded-border-top border-bottom">
        <div class="ibumm-widget-title">MONTHLY TEAM PERFORMANCE</div>
    </div>

    <div class="ibox-content widget-rounded-border-bottom dashboard_block text-center monthly-team-performance">
        <div class="row justify-content-center">
            <div class="col-7 col-sm-6 col-xl-6 col-lg-6 col-md-6">
                <div class="d-flex flex-column">
                    <div class="arrow {{ $dashboard['mtp']['ambassadors']['arrow'] }}">
                        <i class="fa fa-{{ $dashboard['mtp']['ambassadors']['arrow'] }}"></i>
                    </div>
                    <div class="h3 font-weight-bold">{{ $dashboard['mtp']['ambassadors']['value'] }}</div>
                    <div class="h5 font-weight-bold">Active Distribuitors</div>
                </div>
            </div>

            <div class="col-7 col-sm-6 col-xl-6 col-lg-6 col-md-6">
                <div class="d-flex flex-column">
                    <div class="arrow {{ $dashboard['mtp']['customers']['arrow'] }}">
                        <i class="fa fa-{{ $dashboard['mtp']['customers']['arrow'] }}"></i>
                    </div>
                    <div class="h3 font-weight-bold">{{ $dashboard['mtp']['customers']['value'] }}</div>
                    <div class="h5 font-weight-bold">Active Customers</div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .monthly-team-performance .arrow {
            font-size: 100px;
        }

        .monthly-team-performance .arrow-down i {
            background: -webkit-gradient(linear, left top, left bottom, from(rgba(253,147,22,1)), to(rgba(253,0,44,1)));
            -webkit-background-clip: text;
	        -webkit-text-fill-color: transparent;
        }

        .monthly-team-performance .arrow-up i {
            background: -webkit-gradient(linear, left top, left bottom, from(rgba(57,251,176,1)), to(rgba(0,204,96,1)));
            -webkit-background-clip: text;
	        -webkit-text-fill-color: transparent;
        }
    </style>
@endpush
