<div class="toast toast-bootstrap hide" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <i class="fa fa-newspaper-o"> </i>
        <strong class="mr-auto m-l-sm">{{ $title }}</strong>
        <small>2 seconds ago</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="toast-body">
        {{ $slot }}
    </div>
</div>
