@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-10">
            <div class="ibox loading-state">
                <div class="ibox-title">
                    <h5>Waiting payment...</h5>
                </div>

                <div class="ibox-content">
                    <h3 class="py-3">Your purchase is being processed and we are waiting for the payment confirmation. You will be redirected to the payment system.</h3>

                    <a href="{{ route('affiliates.dashboard.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    console.log(redirect_url)
</script>
@endpush