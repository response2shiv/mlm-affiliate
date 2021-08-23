@push('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@component('layouts.components.modal_white', ['id' => 'modalCommissionMonthly', 'modal_size' => 'modal-xl'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="col-lg-12">
        <div class="table-responsive mt-2" id="tableDetails">

        </div>
    </div>

@endcomponent

@push('scripts')

    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

@endpush