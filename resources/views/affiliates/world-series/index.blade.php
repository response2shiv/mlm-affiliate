@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">    
        <div class="col-lg-12">
            <div class="ibox box-table widget-rounded-border-top widget-rounded-border-bottom bg-standings table-responsive">
                <div class="container">
                    <table class="table table-striped table-round-corner" cellspacing="0">
                        <thead class="t-head">
                            <tr>
                                <th colspan="5">
                                    <div class="row text-center">
                                        <div class="col-lg-9 col-md-12"> 
                                            <h2>NCREASE WORLD SERIES STANDINGS</h2>
                                        </div>
                                        <div class="col-3 top-100">
                                            <li>
                                                <a href="#" id="season">Season Top 100</a>
                                            </li>
                                            <li>
                                                <a href="#" id="playoffs">Playoffs Top 100</a>
                                            </li>
                                            <li>
                                                <a href="#" id="world-series">World Series Top 100</a>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="green-line"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PLACE</td>
                                <td>NAME</td>
                                <td>RUNS</td>
                                <td>HITS</td>
                                <td>ERRORS</td>
                              </tr>
                              @foreach ($top_teams as $key => $value)
                                    <tr class="{{$key == 0 ? 'place-one' : ''}}">
                                        <td>@php echo $key + 1 @endphp</td>
                                        <td>{{$value->sponsor->firstname}} {{$value->sponsor->lastname}}</td>
                                        <td>{{$value->runs}}</td>
                                        <td>{{$value->hits}}</td>
                                        <td>{{$value->errors}}</td>
                                    </tr>
                              @endforeach
                        </tbody>
                      </table>
                </div>
            </div>  
        </div>    
    </div>

    <div class="row" {{date('m') == '06' || date('m') == '07' ? '' : 'hidden'}}>    
        <div class="col-lg-12">
            <div class="ibox widget-rounded-border-top widget-rounded-border-bottom bg-diamod table-responsive">
                <div class="text-center">
                    {{-- <img src="{{asset('assets/images/diamond.png')}}" class="image-diamond" alt=""> --}}
                    <img src="{{asset('assets/images/diamond_no_links.png')}}" class="image-diamond" alt="" {{date('m') == '06' ? '' : 'hidden'}}>
                    <img src="{{asset('assets/images/diamond-playoffs.png')}}" class="image-diamond" alt="" {{date('m') == '07' ? '' : 'hidden'}}>
                </div>
                <!-- images -->
                @if ($diamond->first_base_user_id)
                    <a href="#" class="tooltipw">
                        <img src="{{ $diamond->first_base_user->profile_image_url ? \Storage::URL($diamond->first_base_user->profile_image_url) : asset('/assets/images/boomerangs.png')}}" class="img-player player-two" alt=""> 
                        <div class="distributor-details distributor-detail-min-width two-player">
                            <div class="details-wrap">
                                <div class="details-title">Details</div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">NAME</div>
                                    <div class="value">{{$diamond->first_base_user->firstname}} {{$diamond->first_base_user->lastname}}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">TSA#</div>
                                    <div class="value">{{$diamond->first_base_user->distid}}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">Enrollment Date</div>
                                    <div class="value">{{ $diamond->first_base_user->created_date }}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">Sponsor</div>
                                    <div class="value">{{ $diamond->first_base_user->sponsorid}}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">Enrollment Pack</div>
                                    <div class="value">{{ $diamond->first_base_user->current_product->productname }}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">VISION 2020 Admission Ticket</div>
                                    <div class="value">{{ $diamond->first_user_event->has_ticket ? 'YES' : 'NO' }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
                @if ($diamond->second_base_user_id)
                <a href="#" class="tooltipw">
                    <img src="{{$diamond->second_base_user->profile_image_url ? \Storage::URL($diamond->second_base_user->profile_image_url) : asset('/assets/images/boomerangs.png')}}" class="img-player player-three" alt=""> 
                        <div class="distributor-details distributor-detail-min-width one-player">
                            <div class="details-wrap">
                                <div class="details-title">Details</div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">NAME</div>
                                    <div class="value">{{$diamond->second_base_user->firstname}} {{$diamond->second_base_user->lastname}}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">TSA#</div>
                                    <div class="value">{{$diamond->second_base_user->distid}}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">Enrollment Date</div>
                                    <div class="value">{{ $diamond->second_base_user->created_date }}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">Sponsor</div>
                                    <div class="value">{{ $diamond->second_base_user->sponsorid}}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">Enrollment Pack</div>
                                    <div class="value">{{ $diamond->second_base_user->current_product->productname }}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">VISION 2020 Admission Ticket</div>
                                    <div class="value">{{ $diamond->second_user_event->has_ticket ? 'YES' : 'NO' }}</div>
                                </div>
                            </div>
                        </div>
                </a>
                @endif
                @if ($diamond->third_base_user_id)
                   <a href="#" class="tooltipw">
                       <img src="{{$diamond->third_base_user->profile_image_url ? \Storage::URL($diamond->third_base_user->profile_image_url) :asset('/assets/images/boomerangs.png')}}" class="img-player player-one" alt="">
                        <div class="distributor-details distributor-detail-min-width three-player">
                            <div class="details-wrap">
                                <div class="details-title">Details</div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">NAME</div>
                                    <div class="value">{{$diamond->third_base_user->firstname}} {{$diamond->third_base_user->lastname}}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">TSA#</div>
                                    <div class="value">{{$diamond->third_base_user->distid}}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">Enrollment Date</div>
                                    <div class="value">{{ $diamond->third_base_user->created_date }}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">Sponsor</div>
                                    <div class="value">{{ $diamond->third_base_user->sponsorid}}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">Enrollment Pack</div>
                                    <div class="value">{{ $diamond->third_base_user->current_product->productname }}</div>
                                </div>
                                <div class="details-row distributor-detail-font-size">
                                    <div class="label-tooltip">VISION 2020 Admission Ticket</div>
                                    <div class="value">{{ $diamond->third_user_event->has_ticket ? 'YES' : 'NO' }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
                <!-- Scoreboard TITLES -->
                <p class="scoreboard title-runs">RUNS</p>
                <p class="scoreboard title-hits">HITS</p>
                <p class="scoreboard title-errors">ERRORS</p>
                <p class="scoreboard title-totals">TOTAL</p>
                <!-- Scoreboard VALUES -->
                <p class="scoreboard value-runs">{{$diamond->runs}}</p>
                <p class="scoreboard value-hits">{{$diamond->hits}}</p>
                <p class="scoreboard value-errors">{{$diamond->errors}}</p>
                <p class="scoreboard value-totals">{{$diamond->total}}</p>
            </div>
        </div>      
    </div>

    <!--<div class="row">    -->
    <!--    <div class="col-12">-->
    <!--        <div class="ibox">-->
    <!--            <div class="ibox-content text-center bg-standings">-->
    <!--                <h3 class="text-white">Current runs/hits/errors are calculated from a starting date of 06/01/2020, and will be recalculated on Friday to include June 1st-2nd</h3>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>      -->
    <!--</div>-->
</div>
@endsection

@push('modals')
    @include('affiliates.partials.modals._top_team')
@endpush

@push('scripts')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/world_series/world_series.js') }}"></script>
@endpush