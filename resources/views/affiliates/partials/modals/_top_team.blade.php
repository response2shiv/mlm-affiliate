@push('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@component('layouts.components.modal_white', ['id' => 'modalTopTeam', 'modal_size' => 'modal-xl'])
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
                        <div class="ibumm-widget-title">VIEW TOP 100</div>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive mt-2" id="dt_top_teams">
                    <div class="table-responsive"> 
                        <table class="table table-hover dataTables-example dataTable ib-table" id="dt_top_team" aria-describedby="dt_top_team" role="grid">
                            <thead>
                                <tr role="row">
                                    <th>Place</th>
                                    <th>Name</th>
                                    <th>Runs</th>
                                    <th>Hits</th>
                                    <th>Errors</th>
                                </tr>
                            </thead>
                            <tbody id="top_teams"></tbody>
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