<div class="ibox float-e-margins widget-rank-insights">
    <div class="ibox-title widget-rounded-border-top">
        <div class="row">
            <div class="col-xl-8 border-bottom-title">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="ibumm-widget-title">RANK INSIGHTS </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <select class="form-control form-control-sm" name="history" id="selectHistory">
                                <option value="" disabled selected>History</option>
                                @foreach ($dashboard['rank_insights']['history'] as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3">
                        @include('components.affiliates.spinners.wave')
                    </div>

                </div>
            </div>
            <div class="col-xl-4 border-bottom-title">
                <div class="ibumm-widget-title team-insights-hidden">TEAM INSIGHTS</div>
            </div>
        </div>
    </div>
    <div class="ibox-content widget-rounded-border-bottom">
        <div class="row">
            {{-- First column --}}
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 border-right">
                <ul class="list-group list-group-flush no-borders">
                    <li class="list-group-item border-bottom">
                        <div class="row">
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-md-6 list-group-item-label">Lifetime Rank</div>
                                    <div class="col-md-12 list-group-item-value lifetime-rank">{{ $dashboard['rank_insights']['achieved'] }}</div>
                                   
                                </div>
                            </div>

                            <div class="col-5">
                                <ul class="custom-tabs pull-right" id="rankTypes">
                                    <li class="tab-item tab-active" id="volume">Volume</li>
                                    @if ($dashboard['rank_insights']['has_tsa'])
                                        <li class="tab-item" id="tsa">TSA Credits</li>
                                    @endif
                                </ul>
                                <input type="hidden" id="hiddenRankType" name="rankType" value="volume">
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item border-bottom">
                        <div class="row">
                            <div class="col-md-12 list-group-item-label">Month Rank</div>                            
                            <div class="col-md-12 list-group-item-value" id="valueMonthRankDesc">{{ $dashboard['rank_insights']['monthly'] }}</div>
                            <input type="hidden" id="hiddenRank" value="{{ $dashboard['rank_insights']['rank_types'][0]['id']-10 }}">
                        </div>
                    </li>
                    <li class="list-group-item border-bottom">
                        <div class="row d-flex flex-row">
                            <div class="col-md-6">
                                <div class="list-group-item-label" id="labelTotalMonthly">Total Monthly QV</div>
                                <div class="list-group-item-value" id="valueTotalMonthly">{{ $dashboard['rank_insights']['monthly_qv'] }}</div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="list-group-item-label" id="labelRankQualified">Rank Qualified Volume</div>
                                <div class="list-group-item-value" id="qv">{{ $dashboard['rank_insights']['qv'] }}</div>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="col-md-12 mt-2 text-muted font-weight-bold observation-font-color">
                    * All rank qualifications are based on Qualifying Volume only.
                </div>
            </div>

            {{-- Second column --}}
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 border-right">
                <div class="d-flex flex-column">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-bottom">
                            <div class="row">
                                <div class="col-7">
                                    <div class="list-group-item-label">Qualifications</div>
                                    <div class="list-group-item-value text-uppercase" id="qualification">{{ $dashboard['rank_insights']['next_rank'] }}</div>
                                </div>
                                <div class="col-5">
                                    <select class="form-control m-input form-control-sm m-input--air m-input--pill rank-dp m-input--solid rank-type" id="selectRank">
                                        @foreach ($dashboard['rank_insights']['rank_types'] as $rank_type)
                                            <option value="{{ $rank_type['id'] }}" {{ ($dashboard['rank_insights']['next_rank'] !== $rank_type['type']) ?: 'selected' }}>{{ $rank_type['type'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item border-bottom">                                                        
                            <div class="list-group-item-label" id="labelMontlyNeeded">Monthly QV Needed</div>
                            <div class="list-group-item-value" id="nextQV">{{ $dashboard['rank_insights']['next_qv'] }}</div>                        
                        </li>

                        <li class="list-group-item border-bottom">
                            <div class="list-group-item-label">Personally Enrolled Required</div>
                            <div class="row">
                                <div class="col-md-6 ">                                    
                                    <div class="list-group-item-label">Left</div>
                                    @if($dashboard['business_snapshot']['binary_qualified']['left'] >= $dashboard['rank_insights']['binary_limit'])
                                        <div class="list-group-item-label text-success">
                                    @else
                                        <div class="list-group-item-label text-danger">
                                    @endif
                                    {{$dashboard['business_snapshot']['binary_qualified']['left']}}/<span id="leftBinaryLimitValue" class="list-group-item-label"> {{$dashboard['rank_insights']['binary_limit']}}</span>
                                    </div>                                   
                                </div>
                                <div class="col-md-6">
                                    <div class="list-group-item-label">Right</div>
                                         @if($dashboard['business_snapshot']['binary_qualified']['right'] >= $dashboard['rank_insights']['binary_limit'])
                                        <div class=" list-group-item-label text-success">
                                    @else
                                        <div class="list-group-item-label text-danger">
                                    @endif
                                        {{$dashboard['business_snapshot']['binary_qualified']['right']}}/<span id="rightBinaryLimitValue" class="list-group-item-label"> {{$dashboard['rank_insights']['binary_limit']}}</span>
                                    </div> 
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div id="qcDivPercentage" class="mt-2 text-muted font-weight-bold observation-font-color">* No more than {{$dashboard['rank_insights']['next_qc_percentage']}}% can come from a single personal leg.</div>
                </div>
            </div>

            {{-- Contributors --}}
            <div class="col-12 border-bottom border-top team-insights-show mt-3">
                <div class="ibumm-widget-title">TEAM INSIGHTS</div>
            </div>
            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                <div class="top-producing-personal-legs">Top Producing Personal Legs</div>
                <ul class="list-group list-group-flush list-contributors" id="listContributors">
                    @foreach($dashboard['rank_insights']['team'] as $member)
                        <a href="/report/pear/{{ $member->user_id }}" data-toggle="tooltip">
                            <li class="list-group-item d-flex flex-row justify-content-between border-bottom font-contributors">
                                {{ sprintf('%s %s', $member->firstname, $member->lastname) }}
                                <div>
                                    <span class="value">{{ number_format($member->qv_contribution, 0, '.', ',') }} / {{ number_format($member->min_qv, 0, '.', ',') }}</span>
                                    <span class="font-qv">QV</span>
                                </div>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/dashboard/widgets/rank_insights.js') }}"></script>
@endpush
