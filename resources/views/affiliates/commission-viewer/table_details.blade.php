<div class="table-responsive"> 
    <table class="table table-striped table-hover dataTables-example dataTable ib-table" id="table_details" aria-describedby="table-details" role="grid">
        <thead>
            <tr role="row">
                <th>Order ID</th>
                <th>Date</th>
                <th>Description</th>
                <th>Name</th>
                @if ($type != 'tsb')
                    <th>Level</th>
                    <th>Percent</th>
                @endif
                <th>CV</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($response->resume as $data)
                <tr>
                    <td>{{ $data->order_id }}</td>
                    <td>{{ $data->created_date }}</td>
                    <td>{{ $data->productdesc }}</td>
                    <td>{{ $data->user }}</td>
                    @if ($type != 'tsb')
                        <td>{{ $data->level }}</td>
                        <td>{{ $data->percent }}%</td>
                    @endif
                    <td>{{ $data->cv }} </td>
                    <td>${{ number_format($data->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th rowspan="1" colspan="1">Order ID </th>
                <th rowspan="1" colspan="1">Date </th>
                <th rowspan="1" colspan="1">Description</th>
                <th rowspan="1" colspan="1">Name</th>
                @if ($type != 'tsb')
                    <th rowspan="1" colspan="1">Level</th>
                    <th rowspan="1" colspan="1">Percent</th>
                @endif
                <th rowspan="1" colspan="1">CV</th>
                <th rowspan="1" colspan="1">Amount</th>
            </tr>
        </tfoot>
    </table>
</div>