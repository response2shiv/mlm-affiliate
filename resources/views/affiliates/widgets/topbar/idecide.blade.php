<div id="anchorIDecide">
    <img class="top-logo" src="{{asset('assets/images/dashboard/iDECIDE_SSO.png')}}" alt="">
</div>

@push('scripts')
<script>
    $('#anchorIDecide').on('click', function (event) {
        event.preventDefault();
        $.ajax({
            url: '{{ route('api-request') }}',
            method: 'POST',
            data: {
                endpoint: '/affiliate/dashboard/idecide',
                method: 'GET'
            },
            success: function (res) {
                switch (res.error) {
                    case "0":
                        window.open(res.url);
                        break;
                    case "1": // error message
                        showPopupNotification('error', 'iDecide Error', res.msg);
                        break;            
                    case "2":
                        $('#modalIDecideAgreement').modal('show');
                        break;
                }
            }
        });
    });
</script>
@endpush

@push('modals')
    @include('affiliates.partials.modals._idecide_agreement')
@endpush
