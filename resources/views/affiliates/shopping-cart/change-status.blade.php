@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-10">
            <div class="ibox loading-state">
                <div class="ibox-title">
                    <h5>CHANGE UNICRYPT INVOICE STATUS (FOR TEST PURPOSES ONLY)</h5>
                </div>

                <div class="ibox-content">

                    <form role="form">
                        <div class="form-group"><label>Order Hash</label>
                            <input type="text" id="orderhash" name="orderhash" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label class="font-normal">Force Invoice Status</label>
                            <div>
                                <select class="form-control m-b" name="status" id="status">
                                    <option value="paid">Paid</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-warning float-left m-t-n-xs" type="button" id="get-status"><strong>Get Invoice data</strong></button>
                            <button class="btn btn-sm btn-alert float-left m-t-n-xs" type="button" id="clear-data"><strong>Clear data</strong></button>
                            <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="button" id="send-status"><strong>Override Order Status</strong></button>
                        </div>
                    </form>

                    <div class="ibox-content" id="result">

                        <div class="alert alert-danger" id="result-alert" style="display: none;">
                            ERROR - ORDER HASH NOT FOUND
                        </div>

                        <table style="width: 100%; display: none;" class="table table-bordered" id="result-table">
                            <thead>
                                <tr>
                                    <th>Column</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('affiliates.dashboard.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#clear-data').click(function() {
        $('#orderhash').val('');
        $('#result-alert').css('display', 'none');
        $('#result-table').css('display', 'none');
    });

    $('#send-status').click(function() {

        orderhash = $('#orderhash').val();

        if (orderhash != '') {
            $.ajax({
                url: "/api-request",
                method: 'POST',
                data: {
                    endpoint: '/affiliate/shopping-cart/test-send-status',
                    orderhash: $('#orderhash').val(),
                    status: $('#status').val(),
                    method: 'POST'
                },
                success: function(res) {

                    console.table(res);

                    if (res.exception) {
                        alert('Error on submit');
                    } else {
                        $('#result-table').css('display', 'inline');

                        $.each(res.data, function(index, item) {
                            var eachrow = "<tr>" +
                                "<td>" + index + "</td>" +
                                "<td>" + item + "</td>" +
                                "</tr>";
                            $('#tbody').append(eachrow);
                        });
                    }
                }
            });
        } else {
            alert('Please type a valid order hash');
        }
    });

    $('#get-status').click(function() {
        event.preventDefault();

        orderhash = $('#orderhash').val();

        if (orderhash != '') {
            $.ajax({
                url: "/api-request",
                method: 'POST',
                data: {
                    endpoint: '/affiliate/shopping-cart/get-status/' + orderhash,
                    method: 'GET'
                },
                success: function(res) {
                    if (res.exception) {
                        $('#result-alert').css('display', 'block');
                        $('#result-table').css('display', 'none');
                    } else {
                        $('#result-table').css('display', 'inline');

                        $.each(res, function(index, item) {
                            var eachrow = "<tr>" +
                                "<td>" + index + "</td>" +
                                "<td>" + item + "</td>" +
                                "</tr>";
                            $('#tbody').append(eachrow);
                        });
                    }
                }
            });
        } else {
            alert('Please type a valid order hash');
        }
    });
</script>
@endpush
