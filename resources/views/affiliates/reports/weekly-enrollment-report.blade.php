@extends('layouts.affiliates')

@push('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox ">
        <div class="ibox-title">
            <h5>Weekly Enrollment</h5>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table  class="table table-striped table-hover dataTables-example dataTable ib-table"
                        id="weekly_enrollment_table" aria-describedby="weekly-enrollment" role="grid">
                    <thead>
                        <tr role="row">
                            <th>Dist ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Country</th>
                            <th>State/Province</th>
                            <th>Pack</th>
                            <th>Sponsor ID</th>
                            <th>Sponsor Name</th>
                            <th>Enrollment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($response as $item)
                            <tr role="row">
                                <th>{{ $item->distid }}</th>
                                <th>{{ $item->firstname }}</th>
                                <th>{{ $item->lastname }}</th>
                                <th>{{ $item->username }}</th>
                                <th>{{ $item->countrycode  }}</th>
                                <th>{{ $item->stateprov }}</th>
                                 <th>	
                                    <span hidden>{{\App\Models\Product::getProductName($item->current_product_id)}}</span>	
                                    <li class="{{ array_key_exists($item->current_product_id, $packClasses) ? $packClasses[$item->current_product_id] : 'No Product'}}">	
                                        <div class="pack-image selected-pack">
                                            @if(array_key_exists($item->current_product_id, $packImages))
                                            <img title="{{ $packClasses[$item->current_product_id] }}" data-toggle="tooltip" data-placement="top"  src="/assets/images/{{ $packImages[$item->current_product_id] }}" />             	
                                            @endif
                                        </div> 	
                                    </li>	
                                </th>
                                <th>{{ $item->sponsorid }}</th>
                                <th>{{ $item->sponser_name }}</th>
                                <th>{{ $item->created_dt }}</th>
                            </tr>
                        @empty
                            <tr role="row">
                                <th colspan="10"><strong>Data not available</strong></th>
                            </tr>
                        @endforelse


                    </tbody>
                    <tfoot>
                        <tr>
                            <th rowspan="1" colspan="1">Dist ID</th>
                            <th rowspan="1" colspan="1">First Name</th>
                            <th rowspan="1" colspan="1">Last Name</th>
                            <th rowspan="1" colspan="1">Username</th>
                            <th rowspan="1" colspan="1">Country</th>
                            <th rowspan="1" colspan="1">State/Province</th>
                            <th rowspan="1" colspan="1">Pack</th>
                            <th rowspan="1" colspan="1">Sponsor ID</th>
                            <th rowspan="1" colspan="1">Sponsor Name</th>
                            <th rowspan="1" colspan="1">Enrollment Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/reports/weekly_enrollment.js') }}"></script>
@endpush
