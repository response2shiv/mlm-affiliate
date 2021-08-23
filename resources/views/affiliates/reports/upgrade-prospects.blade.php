@extends('layouts.affiliates')

@push('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@php
   $packClasses = [
    \App\Models\Product::ID_STANDBY_CLASS => 'standby_class.png',
    \App\Models\Product::ID_COACH_CLASS => 'coach_class.png',
    \App\Models\Product::ID_BUSINESS_CLASS => 'business_class.png',
    \App\Models\Product::ID_FIRST_CLASS => 'first_class_icon.png',
    \App\Models\Product::ID_EB_FIRST_CLASS => 'first_class_icon.png',
    \App\Models\Product::ID_Traverus_Grandfathering => 'business_class.png',
    \App\Models\Product::ID_PREMIUM_FIRST_CLASS => 'elite_class.png',
    \App\Models\Product::ID_VIBE_OVERDRIVE_USER => 'vibe_overdrive_class.png',

]
@endphp


@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox ">
        <div class="ibox-title">
            <h5>Upgrade Propspects</h5>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table  class="table table-striped table-hover dataTables-example dataTable ib-table"
                        id="upgrade-prospects" aria-describedby="upgrade-prospects" role="grid">
                    <thead>
                        <tr role="row">
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Class</th>
                            <th>Enrollment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($response as $item)
                            <tr role="row">
                                <th>{{ $item->firstname }}</th>
                                <th>{{ $item->lastname }}</th>
                                <th>
                                    <img src="{{asset('/assets/images/')}}<?php echo array_key_exists($item->current_product_id, $packClasses) ? '/'.$packClasses[$item->current_product_id] : 'No Product' ?>" /></div>
                                </th>
                                <th>{{ $item->created_dt }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th rowspan="1" colspan="1">First Name</th>
                            <th rowspan="1" colspan="1">Last Name</th>
                            <th rowspan="1" colspan="1">Class</th>
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
    <script src="{{ asset('js/ibuumerang/reports/upgrade-prospects.js') }}"></script>
@endpush

