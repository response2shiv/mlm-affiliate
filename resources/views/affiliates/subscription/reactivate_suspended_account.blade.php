@extends('layouts.affiliates')

@push('scripts')
    <script src="{{ asset('js/ibuumerang/suspended_user.js') }}"></script>
@endpush

@section('base-content')
@endsection

@push('modals')
    @include('affiliates.partials.modals._reactivate_suspended_account')    
    @include('affiliates.partials.modals._subscription_reactive_success') 
    @include('affiliates.partials.modals._add_new_card')
@endpush






