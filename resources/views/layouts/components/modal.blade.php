<div class="modal fade ib-modal" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}" aria-hidden="true">
    <div class="modal-dialog {{ $modal_size ?? 'modal-lg' }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}">
                    <div class="text-center">
                        <img src="{{ $header['image'] ?? asset('assets/images/iBuumerangLogo.png') }}" width="{{ $header['width'] ?? '180px' }}">
                    </div>
                </h5>
            </div>

            <div class="modal-body">
                {{ $slot }}
            </div>

            <div class="modal-footer">
                {{ $actions }}
            </div>
        </div>
    </div>
</div>
