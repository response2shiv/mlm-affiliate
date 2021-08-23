@extends('layouts.affiliates')

@section('base-content')

<div class="wrapper wrapper-content animated fadeInRight">
    
    @include('affiliates.commission-viewer.topbar')

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h3>Historical Volume Report</h3>
                    </div>

                    <div class="ibox-content">
                        <div class="ibox-actions">
                            <div class="row">
                                <div class="col-2">
                                    <div class="ibox-section-title">
                                        Weekly Volumes
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped text-center ib-table">
                                <thead>
                                    <tr>
                                        <th>Week <br/> Ending</th>
                                        <th>Carryover <br/> Volume Left</th>
                                        <th>Carryover <br/> Volume Right</th>
                                        <th>Adjusted <br/> Volume Left</th>
                                        <th>Adjusted <br/> Volume Right</th>
                                        <th>Total <br/> Volume Left</th>
                                        <th>Total <br/> Volume Right</th>
                                        <th>Paid <br/> On Volume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($response->commissions as $item)
                                        <tr>
                                            <td>{{substr($item->week_ending, 0, 11)}}</td>
                                            <td>{{number_format($item->carryover_left)}}</td>
                                            <td>{{number_format($item->carryover_right)}}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>{{number_format($item->total_volume_left)}}</td>
                                            <td>{{number_format($item->total_volume_right)}}</td>
                                            <td>{{number_format($item->amount_earned)}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">There's nothing to show here.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="ibox-actions">
                            <div class="row">
                                <div class="col-2">
                                    <div class="ibox-section-title">
                                        Monthly Volumes
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped text-center ib-table">
                                <thead>
                                    <tr>
                                        <th>Pay Period</th>
                                        <th>Monthly QV</th>
                                        <th>Adjusted Monthly QV</th>
                                        <th>Total QV</th>
                                        <th>Rank Qualified QV</th>
                                        <th>Monthly CV</th>
                                        <th>Adjusted CV</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($response->rankHistory as $item)
                                        <tr>
                                            <td class="font-weight-bold">{{substr($item->period, 0, 11)}}</td>
                                            <td>{{number_format($item->monthly_qv)}}</td>
                                            <td>-</td>
                                            <td>{{number_format($item->monthly_qv)}}</td>
                                            <td>{{number_format($item->qualified_qv)}}</td>
                                            <td>{{number_format($item->monthly_cv)}}</td>
                                            <td>0</td>
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
@endsection

@push('modals')
    @include('affiliates.partials.modals._verification_code')
@endpush

@push('scripts')    

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Morris -->
    <script src="{{ asset('js/plugins/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/plugins/morris/morris.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

    <!-- Morris demo data-->
    <script src="{{ asset('js/demo/morris-demo.js') }}"></script>

    <script src="{{ asset('js/ibuumerang/reports/tax_docs.js') }}"></script>

@endpush