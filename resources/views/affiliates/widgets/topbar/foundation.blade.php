<div id="anchorFoundation">
    <img class="top-logo" src="{{asset('assets/images/dashboard/ibuum-donation.png')}}" alt="">
</div>

@push('scripts')
    <script src="{{ asset('js/ibuumerang/foundation.js') }}"></script>
@endpush

@push('modals')
    @include('affiliates.partials.modals._foundation')
    @include('affiliates.partials.modals._foundation_thank_you')
@endpush
