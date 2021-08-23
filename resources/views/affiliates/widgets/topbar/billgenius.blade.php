<div id="anchorBillGenius">
    <input type="hidden" id="BillGenius_user_id" value="{{ Auth::user()->id }}">
    <img class="top-logo" src="{{asset('assets/images/dashboard/billgenius_icon.png')}}" alt="">
</div>


@push('scripts')
    <script src="{{ asset('js/ibuumerang/billgenius.js') }}"></script>
@endpush