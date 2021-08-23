@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-10">
            <div class="ibox loading-state">
                <div class="ibox-title">
                    <h5>Sorry!</h5>
                </div>

                <div class="ibox-content">
                    <h3 class="py-2">Your purchase cannot be made.</h3>
                    <h4 class="">Message: {{ $message ? $message : ''  }}</h4> <br />
                    <a href="{{ route('affiliates.dashboard.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
