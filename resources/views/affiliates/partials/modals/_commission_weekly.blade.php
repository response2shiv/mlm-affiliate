@push('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@component('layouts.components.modal_white', ['id' => 'modalCommissionWeekly', 'modal_size' => 'modal-xl'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title border-bottom">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="ibumm-widget-title">BINARY COMMISSION DETAILS</div>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive mt-2" id="table_binary_details">
                    <div class="table-responsive"> 
                        <table class="table table-hover dataTables-example dataTable ib-table" id="table_binary_details" aria-describedby="table-details" role="grid">
                            <thead>
                                <tr role="row">
                                    <th>Carryover Left</th>
                                    <th>Carryover Right</th>
                                    <th>Total Volume Left</th>
                                    <th>Total Volume Right</th>
                                    <th>Gross Volume Left/Right</th>
                                    <th>Commission Percent</th>
                                    <th>Amount Earned</th>
                                </tr>
                            </thead>
                            <tbody id="binary_commission"></tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Carryover Left </th>
                                    <th rowspan="1" colspan="1">Carryover Right</th>
                                    <th rowspan="1" colspan="1">Total Volume Left</th>
                                    <th rowspan="1" colspan="1">Total Volume Right</th>
                                    <th rowspan="1" colspan="1">Gross Volume Left/Right</th>
                                    <th rowspan="1" colspan="1">Commission Percent</th>
                                    <th rowspan="1" colspan="1">Amount Earned</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endcomponent

@push('scripts')

    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

@endpush