<div class="ibox float-e-margins">
    <div class="ibox-title widget-rounded-border-top border-bottom">
        <div class="ibumm-widget-title">THE BUILDING ZONE</div>
    </div>

    <div class="ibox-content widget-rounded-border-bottom dashboard_block text-left monthly-team-performance">
        <div class="col-md-12 col-lg-12 col-sm-12 d-flex flex-column align-items-center justify-content-center">
            <div class="zone {{ $dashboard['build_zone']['class'] ?? 'gold-zone' }}">
                <h2 class="zone-title">{{$dashboard['build_zone']['zone']}}</h2>
                <div class="zone-subtitle">
                    <p>{{ $dashboard['build_zone']['range'] ?? '11TH - 20TH OF THE MONTH' }}</p>
                    <p>ACTIVITY: {{ $dashboard['build_zone']['activity'] ?? 'MASSIVE SPONSORING'}}</p>
                </div>
                <p class="zone-body">
                    {{ $dashboard['build_zone']['body'] ?? 'Time to get prospect started. Use 3ways calls to launch new team' }}
                </p>
            </div>


            @if($dashboard['build_zone']['class'] === 'gold-zone')
                <div class="button text-center mt-3">
                    <a href="{{ route('upgrade-prospects') }}" class="btn btn-primary rounded-pill">Upgrade Prospects</a>
                </div>
            @endif
        </div>
    </div>
</div>

