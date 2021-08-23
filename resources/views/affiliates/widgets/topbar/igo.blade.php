<div id="anchorIGo">
    <img src="{{asset('assets/images/dashboard/igo-logo.png')}}" alt="">
</div>

@push('scripts')
<script>
    $('#anchorIGo').on('click', function (event) {
        event.preventDefault();
        $.ajax({
            url: '{{ route('api-request') }}',
            method: 'POST',
            data: {
                endpoint: '/affiliate/dashboard/igo',
                method: 'GET'
            },
            success: function (res) {
                switch (res.error) {
                    case "0":
                        window.open(res.url);
                        break;
                    
                    case "1":
                        showPopupNotification('error', 'Igo Login Error', res.msg);
                        break;

                    case "2":
                        $('#modalIGoAgreement').modal('show');
                        break;
                }
            }
        });
    });
</script>
@endpush

@push('modals')
    @include('affiliates.partials.modals._igo_agreement')
@endpush
