@extends('layouts.affiliates')

@push('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush

@section('base_body')
<div class="ibox ">
    <div class="ibox-title">
        <h2>Entire Organization Report</h2>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="row">
                    <div class="col-12 col-sm-4 col-xl-4">
                        <h4>TOTAL DISTRIBUITORS</h4>
                        <h4 id="recordsTotalValue" class="text-success"></h4>
                    </div>
                    <div class="col-12 col-sm-4 col-xl-4">
                        <h4>ACTIVE DISTRIBUITORS</h4>
                        <h4 id="countActiveUsers" class="text-success"></h4>
                    </div>
                    <div class="col-12 col-sm-4 col-xl-4">
                        <h4>TOTAL LEVELS</h4>
                        <h4 class="text-success">{{ $max_level }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-lg-3 col-xl-2 right form-inline justify-content-start">
                <div id="tableLengthDiv" class="mt-lg-4 pt-xl-2"></div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4 col-xl-3 justify-content-sm-end">
                <div class="row">
                    <div class="col-12 col-sm-4 mt-sm-2 text-sm-right col-lg-12 text-lg-left" id="labelSortDiv">
                        <label>Level Sort</label>
                    </div>
                    <div class="col-12 col-sm-8 col-lg-12">
                        <div class="input-group">
                            <input type="number" min="0" max="{{ $max_level }}" aria-label="From Level" placeholder="FROM LEVEL" class="form-control" id="levelFrom" value="{{ $levelFrom}}">
                            <input type="number" min="0" max="{{ $max_level }}" aria-label="To Level" placeholder="TO LEVEL" class="form-control" id="levelTo" value="{{ $levelTo }}">
                            <div class="input-group-append">
                                <button id="viewByLevel" class="btn btn-info m-btn--air btn-block mt-1 mt-sm-0">View</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2 col-sm-6 col-lg-5 col-xl-4">
                <div class="row">
                    <div class="col-12 mt-sm-1">Sort by Enrollment Date</div>

                    <div class="col-8 col-sm-8 mt-lg-2">
                        <input type="hidden" id="dateFrom" name="dateFrom" value="{{ app('request')->input('dateFrom') ?? '' }}">
                        <input type="hidden" id="dateTo" name="dateFrom" value="{{ app('request')->input('dateFrom') ?? '' }}">

                        <div id="reportrange" class="form-group-inline" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
                    </div>

                    <div class="col-4 col-sm-4 mt-lg-2">
                        <button class="btn btn-info btn-block" id="btnResetDateRange">Reset</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-12 col-xl-3 pt-xl-3 right form-inline justify-content-end">
                <div id="divForSearch" class="mt-sm-4 mt-xl-4"></div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover dataTables-example dataTable table-striped ib-table" id="dt_binary_tree_report" aria-describedby="myTable" role="grid" style="width: 100%;">
                <thead>
                    <tr role="row" class="header">
                        <th>Dist ID</th>
                        <th>Level</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <!-- <th>Username</th> -->
                        <th>Enrollment Date</th>
                        <th>Country</th>
                        <th>State/Province</th>
                        <th>Pack</th>
                        <!-- <th>Sponsor ID</th> -->
                        <th>Sponsor Name</th>
                        <!-- <th>Lifetime Rank</th> -->
                        {{-- <th>Paid-As Rank</th> --}}
                        <th>Active Status</th>
                        {{-- <th>Binary Qualified</th> --}}
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1">Dist ID</th>
                        <th rowspan="1" colspan="1">Level</th>
                        <th rowspan="1" colspan="1">First Name</th>
                        <th rowspan="1" colspan="1">Last Name</th>
                        <!-- <th rowspan="1" colspan="1">Username</th> -->
                        <th rowspan="1" colspan="1">Enrollment Date</th>
                        <th rowspan="1" colspan="1">Country</th>
                        <th rowspan="1" colspan="1">State/Province</th>
                        <th rowspan="1" colspan="1">Pack</th>
                        <!-- <th rowspan="1" colspan="1">Sponsor ID</th> -->
                        <th rowspan="1" colspan="1">Sponsor Name</th>
                        <!-- <th rowspan="1" colspan="1">Lifetime Rank</th> -->
                        {{-- <th rowspan="1" colspan="1">Paid-As Rank</th> --}}
                        <th rowspan="1" colspan="1">Active Status</th>
                        {{-- <th rowspan="1" colspan="1">Binary Qualified</th> --}}
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Scripts -->
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('js/plugins/daterangepicker/daterangepicker.min.js') }}"></script>
<script src="{{ asset(mix('js/ibuumerang/reports/entire_organization.js')) }}"></script> 
@endpush