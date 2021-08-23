<div class="ibox float-e-margins">
    <div id="test" class="ibox-content widget-rounded-border-bottom dashboard_block text-left monthly-team-performance bg">
        <div class="col-md-12 col-lg-12 col-sm-12 d-flex flex-column align-items-center justify-content-center">
            <h4 class="loading text-white">Loading...</h4>
            <div class="green-zone">
                <img src="{{asset('images/WorldSeries-Logo.png')}}" width="12%" alt="" class="logo-world mt-3" {{date('m') == '06' ? '' : 'hidden'}}>
                <img src="{{asset('images/ThePlayoffslogo.png')}}" width="12%" alt="" class="logo-world mt-3" {{date('m') == '07' ? '' : 'hidden'}}>
                <h2 class="zone-title-world position-title"><span class="text-lowercase">ncrease</span> WORLD SERIES</h2>
                <div class="horizontal-line"></div>
                <div class="run-owner-back text-center">
                    <p id="owner_runs">{{number_format($dashboard['world_series']['owner']->runs)}}</p>
                </div>
                <div class="total-owner-back text-center">
                    <p id="owner_total">{{number_format($dashboard['world_series']['owner']->total)}}</p>
                </div>
                <div class="hit-owner-back text-center">
                    <p id="owner_hits">{{number_format($dashboard['world_series']['owner']->hits)}}</p>
                </div>
                <div class="error-owner-back text-center">
                    <p id="owner_errors">{{number_format($dashboard['world_series']['owner']->errors)}}</p>
                </div>
                <p class="owner-title">OWNER</p>
                <div class="horizontal-line-two"></div>
                <div class="run-player-back text-center">
                    <p>{{number_format($dashboard['world_series']['player']->runs)}}</p>
                </div>

                <div class="hit-player-back text-center">
                    <p>{{number_format($dashboard['world_series']['player']->hits)}}</p>
                </div>
                <div class="error-player-back text-center">
                    <p>{{number_format($dashboard['world_series']['player']->errors)}}</p>
                </div>
                <div class="total-player-back text-center">
                    <p>{{number_format($dashboard['world_series']['player']->total)}}</p>
                </div>
                <p class="player-title">PLAYER</p>
                <p class="run-title">RUNS</p>
                <p class="run-player-title">RUNS</p>
                <p class="hit-title">HITS</p>
                <p class="hit-player-title">HITS</p>
                <p class="error-title">ERRORS</p>
                <p class="error-subtitle">REFUNDS & CHARGEBACKS</p>
                <p class="error-player-title">ERRORS</p>
                <p class="error-player-subtitle">REFUNDS & CHARGEBACKS</p>
                <p class="total-title">TOTAL</p>
                <p class="total-player-title">TOTAL</p>
                <input type="text" hidden name="sponsorId" id="sponsorId" value="{{\Auth::user()->id}}">
                <input type="text" hidden name="sponsorId" id="sponsorIdPlayer" value="{{$dashboard['world_series']['sponsor_player']}}">
                <div class="horizontal-line-three"></div>
                <p class="ws-toogle">
                    <a href="#" id="season" {{date('m') == '06' ? 'class=active' : ''}}>SEASON</a>
                    <a href="#" id="playoffs" {{date('m') == '07' ? 'class=active' : ''}}>PLAYOFFS</a>
                    <a href="#" id="world-series" {{date('m') == '08' ? 'class=active' : ''}}>WORLD SERIES</a>
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/ibuumerang/dashboard/widgets/world_series.js') }}"></script>
@endpush
