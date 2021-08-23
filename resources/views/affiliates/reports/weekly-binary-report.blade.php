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
                <div class="ibox-title">
                    <h5>Weekly Binary Report</h5>
                    <div class="ibox-tools">

                         <form style="display: flex;">

                                <input type="hidden" id="from" name="from" value="{{ app('request')->input('from') ?? '' }}">
                                <input type="hidden" id="to" name="to" value="{{ app('request')->input('to') ?? '' }}">

                                <div id="weekly-reportrange" class="form-group-inline" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; margin-right: 5px;">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                </div>

                                <button class="btn btn-primary btn-sm m-btn--air" style="width: 80px;" id="binaryViewDateRangeReportFiterBtn" type="submit">View</button>&nbsp;
                        </form>

                    </div>
                </div>

                <div class="ibox-content">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover no-footer table-striped ib-table"
                                    id="dt_weekly_binary_view" aria-describedby="myTable" role="grid" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>Dist ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>QV</th>
                                        <th>CV</th>
                                        <th>Created Date</th>
                                        <th>Enrollment Pack</th>
                                        <th>Binary Leg</th>
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
@endsection

@push('scripts')

    <script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/plugins/daterangepicker/daterangepicker.min.js') }}"></script>

    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/reports/weekly_binary.js') }}"></script>

    <script type="text/javascript">
    $(function() {

        var start = $('#from').val() != '' ? moment($('#from').val()) : moment().startOf('isoWeek');
        var end   = $('#to').val() != '' ? moment($('#to').val()) : moment().endOf('isoWeek');

        function cb(start, end) {
            $('#weekly-reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#weekly-reportrange').daterangepicker({
            alwaysShowCalendars: true,
            startDate: start,
            endDate: end,
            linkedCalendars: false,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        $('#weekly-reportrange').on('apply.daterangepicker', function(ev, picker) {
            $('#from').val(picker.startDate.format('YYYY-MM-DD'));
            $('#to').val(picker.endDate.format('YYYY-MM-DD'));
        });

        cb(start, end);

    });
    </script>

@endpush
