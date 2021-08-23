@component('layouts.components.modal', ['id' => 'modalProjectedMonthlyVolume'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="text-center">
        <h3 class="font-weight-bold">Projected Monthly Volume</h3>

        <div class="row table-responsive">
            <div class="col-12">
                <table id="dt_projected_monthly_volume" class="table table-hover dataTables-example dataTable ib-table">
                    {{-- "id": 59081,
                    "firstname": "RowdyRoddy",
                    "lastname": "Piper",
                    "username": "rowdyroddypiper",
                    "distid": "TSA5559081",
                    "sponsorid": "TSA8715163",
                    "current_product_id": 2,
                    "usertype": 2,
                    "account_status": "APPROVED",
                    "is_active": 0,
                    "subscription_product": 26,
                    "original_subscription_date": "2020-04-15",
                    "cv": 35,
                    "qv": 100,
                    "qc": "1.00",
                    "order_id": null,
                    "order_item_id": null,
                    "created_date": null,
                    "product_id": null,
                    "oderded_qv": null,
                    "ordered_qc": null,
                    "ordered_cv": null,
                    "user_id": null --}}

                    <thead>
                        <tr role="row">                            
                            <th>Distid</th>                            
                            <th>Name</th>                            
                            <th>QV</th>
                            <th>CV</th>
                            <th>QC</th>
                            <th>Date Processed</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>

    @slot('actions')
        <button class="btn btn-dark text-uppercase" data-dismiss="modal">Close</button>
    @endslot
@endcomponent

