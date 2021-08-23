@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-10">
            <div class="ibox loading-state">
                <div class="ibox-title">
                    <h5>Thank You</h5>
                </div>

                <div class="ibox-content">
                    <h3 class="py-5">Thank you for you purchase.</h3>

                    <a href="{{ route('affiliates.dashboard.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection