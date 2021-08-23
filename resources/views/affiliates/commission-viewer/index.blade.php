@extends('layouts.affiliates')

@push('styles')
    <link href="{{ asset('css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
@endpush

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn">

    @include('affiliates.commission-viewer.topbar')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title border-bottom">
                    <div class="ibumm-widget-title">COMMISSION OVERVIEW</div>
                </div>
                <div class="ibox-content" style="position: relative;">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ibox-title">
                                <h5>LIFETIME EARNINGS <h2 class="font-weight-bold pl-3 inline" id="lifetime_total"></h2></h5>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                @include('components.affiliates.spinners.wave')
                            </div>
                            <div id="commission-tracking-area-chart" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"> </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ibox-title">
                                <h5>Commissions Type</h5>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                @include('components.affiliates.spinners.wave')
                            </div>
                            <div id="commission-tracking-donut-chart"></div>
                            <div class="container"></div>
                        </div>

                        <!-- LEGENDS -->
                        <div class="col-12 pt-3">
                            <div class="container">
                                <div class="row justify-content-md-center">
                                    <div class="chart-legend-fsb mr-1"></div> FSB
                                    <div class="chart-legend-tsb ml-3 mr-1"></div> TSB
                                    <div class="chart-legend-ldb ml-3 mr-1"></div> LIB
                                    <div class="chart-legend-unilevel ml-3 mr-1"></div> Unilevel
                                    <div class="chart-legend-dual-team ml-3 mr-1"></div> Dual-Team
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <form id="form_teste">
            
        </form>
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title border-bottom">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="ibumm-widget-title">COMMISSION TYPE</div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-2">
                            <div class="form-group">
                                <select class="form-control form-control-sm" name="year" id="year">
                                    <option value="2020" selected>2020</option>
                                    <option value="2019">2019</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="ibox-content">
                    <ul class="nav justify-content-center mb-3" id="tab" role="tablist">
                        <li class="nav-item col-3">
                            <a class="nav-link active" id="tab-monthly" data-toggle="pill" href="#data-tab-monthly" role="tab" aria-controls="tab-monthly" aria-selected="true">
                            <span class="link-commissions-table">Monthly Commissions</span></a>
                        </li>
                        <li class="nav-item col-3">
                            <a class="nav-link" id="tab-weekly" data-toggle="pill" href="#data-tab-weekly" role="tab" aria-controls="tab-weekly" aria-selected="false">
                                <span class="link-commissions-table">Weekly Commissions</span></a>
                        </li>
                        <li class="nav-item col-3">
                            <a class="nav-link" id="tab-combined" data-toggle="pill" href="#data-tab-combined" role="tab" aria-controls="tab-combined" aria-selected="false">
                            <span class="link-commissions-table">Combined Commissions</span></a>
                        </li>
                    </ul>

                    <div class="tab-content" id="tabContent">
                        <div class="tab-pane fade show active" id="data-tab-monthly" role="tabpanel" aria-labelledby="tab-monthly">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">

                            <div class="table-responsive">
                                <table class="table table-hover dataTables-example dataTable ib-table" id="dt_dlg_monthly_commissions" style="color: #676a6c">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Total Commission</th>
                                            <th>Unilevel</th>
                                            <th>LIB</th>
                                            <th>Direct Bonuses</th>
                                            <th>Adjustments</th>
                                        </tr>
                                    </thead>
                                
                                    <thead id="total_monthly_commission"></thead>
                                    <tbody id="monthly_commission"></tbody>
                                </table>    
                            </div>
                            </div>    
                        </div>
                        
                        <div class="tab-pane fade" id="data-tab-weekly" role="tabpanel" aria-labelledby="tab-weekly">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">

                                <table class="table table-hover dataTables-example dataTable ib-table" id="dt_dlg_monthly_commissions" style="color: #676a6c"style="color: #676a6c">
                                    <thead>
                                        <tr>
                                            <th width="10%">Month</th>
                                            <th>Total Commission</th>
                                            <th>New Volume Left</th>
                                            <th>New Volume Right</th>
                                            <th>Dual-Team</th>
                                            <th>FSB</th>
                                        </tr>
                                    </thead>
                                    <thead id="total_weekly_commission"></thead>
                                    <tbody id="weekly_commission"> </tbody>
                                </table>    

                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="data-tab-combined" role="tabpanel" aria-labelledby="tab-combined">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">
                                <div class="table-responsive">
                                    <table class="table table-hover dataTables-example dataTable ib-table" id="dt_dlg_monthly_commissions" style="color: #676a6c"style="color: #676a6c">
                                        <thead>
                                            <tr>
                                                <th>Month</th>
                                                <th>Total Commission</th>
                                                <th>MONTHLY</th>
                                                <th>WEEKLY</th>
                                                <th>BONUSES</th>
                                            </tr>
                                        </thead>
                                    
                                        <thead id="total_combined_commission"></thead>
                                        <tbody id="combined_commission"> </tbody>
                                    </table>    
                                </div>
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
    @include('affiliates.partials.modals._commission_weekly')
    @include('affiliates.partials.modals._verification_code')
    @include('affiliates.partials.modals._commission_monthly')
@endpush

@push('scripts')

    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/reports/commissions_viewer.js') }}"></script>

    <!-- Morris  Graphs -->
    <script src="{{ asset('js/plugins/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/plugins/morris/morris.js') }}"></script>

    <script src="{{ asset('js/ibuumerang/reports/tax_docs.js') }}"></script>
@endpush