@extends('layouts.affiliates')

@push('styles')
    <link href="{{ asset('css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
@endpush

@section('base-content')

<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title border-bottom">
                    <div class="row">
                        <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12">
                            <div class="ibumm-widget-title">{{ $type == 'leadership' ? 'GENERATIONAL' : 'LEVEL'}} PAYOUT PERCENT</div>
                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12" align="right">
                            <a href="{{ url('commission') }}" class="btn btn-primary">Back to Summary</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row justify-content-md-center">
                        <div class="col-xl-3 col-lg-4 align-self-center">
                                <h1 class="commission_subtitle">Pay Period </h1>
                                <h1 class="commission_title_bold mb-3"> {{ $label_period }}</h1>
                                <h1 class="commission_subtitle">{{ ucfirst($type) }} Commissions</h1>
                                <h1 class="commission_title_bold mb-3">${{ number_format($response->amount, 2) }} </h1>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <div id="monthly-donut-chart"></div>
                        </div>
                        <div class="col-xl-3 col-lg-4 align-self-center">
                            <ul>
                            @foreach ($response->resume as $data)
                                <li>
                                    <h1 class="commission_subtitle row">
                                        <div class="chart-legend-level{{ $data->level }} ml-3 mr-1"></div> 
                                        {{ ($type == 'leadership') ? "Gen" : "Level"}} {{ $data->level }} 
                                        <span class="ml-3 commission_subtitle">${{ number_format($data->amount, 2) }}</span>
                                    </h1> 
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title border-bottom">
                    <div class="row">
                        <div class="col-12">
                            <div class="ibumm-widget-title">PAYOUT BY {{ $type == 'leadership' ? 'GENERATION' : 'LEVEL'}}</div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content ">
                    <div class="row justify-content-md-center">
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 text-center">
                            <div class="table-responsive">
                                <table class="table table-hover dataTables-example dataTable ib-table" id="dt_dlg_level_commissions">
                                    <thead>
                                        <tr>
                                            <th>{{ $type == 'leadership' ? 'Generation' : 'Level'}}</th>
                                            <th>Level %</th>
                                            <th>% of Earnings</th>
                                            <th>Earnings</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($response->resume as $data)
                                        <tr>
                                            <td><span class="font-weight-bold" style="color: #676A6C">{{ $data->level }}</span></td>
                                            <td>{{ $data->level_percent }}%</td>
                                            <td><span class="font-weight-bold" style="color: #676A6C">{{ number_format(($data->amount * 100) / $response->amount)  }} %</span></td>  
                                            <td>
                                                <a id="detailCommission" class="font-weight-bold" style="color: #36a3f7"  onclick="getPayoutByLevel('{{ strtolower($type) }}', '{{ $period }}', '{{ $week }}', '{{ $data->level }}')">
                                                    ${{ number_format($data->amount, 2) }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('modals')
    @include('affiliates.partials.modals._commission_monthly')
@endpush

@push('scripts')
    <script>
        var resume = {!! json_encode($response->resume) !!}
        var total =  {!! json_encode($response->amount) !!}
        var type =  '{{ ($type == 'leadership') ? "Gen " : "Level "}}'
    </script>
    
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Morris -->
    <script src="{{ asset('js/plugins/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/plugins/morris/morris.js') }}"></script>
    <!-- Morris Chart-->
    <script src="{{ asset('js/ibuumerang/reports/commissions_monthly.js') }}"></script>
@endpush