<div class="d-flex justify-content-between bd-highlight mb-3">
    @if(!Request::segment(2)=='confirmation')
    <div>
        <a href="{{ route('affiliates.dashboard.index') }}" class="btn btn-sm btn-white"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>
    @endif
    <div>
        <div class="alert alert-danger">{{$stop_cart_message}}</div>
    </div>
</div>

