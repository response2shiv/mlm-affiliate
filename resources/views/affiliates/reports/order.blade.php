@extends('layouts.affiliates')
  @push('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
  @endpush
@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed"
                                        aria-selected="true">Completed Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending"
                                        aria-selected="false">Pending Orders</a>
                                </li>                               
                            </ul>
                            <br>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="completed" role="tabpanel" aria-labelledby="completed-tab">  
                                    <div class="table-responsive">                              
                                        <table class="table table-hover no-footer table-striped ib-table"
                                            id="dt_order_completed" aria-describedby="myTable1" role="grid" width="100%">
                                            <thead>
                                            <tr role="row">
                                                <th>Order ID</th>
                                                <th>Transaction Id</th>
                                                <th>Status</th>
                                                <th>date</th>
                                                <th>Amount</th>
                                                <th></th>                                     
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover no-footer table-striped ib-table"
                                            id="dt_order_pending" aria-describedby="myTable2" role="grid" width="100%">
                                            <thead>
                                            <tr role="row">
                                                <th>Order ID</th>
                                                <th>Transaction Id</th>
                                                <th>Status</th>
                                                <th>date</th>
                                                <th>Amount</th>
                                                <th></th>                                      
                                            </tr>
                                            </thead>
                                            <tbody>
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
    </div>
</div>
@endsection

@push('scripts')  
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/reports/order.js') }}"></script>  
@endpush
