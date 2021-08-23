@component('layouts.components.modal', [
    'id' => 'modalSubscriptionReactivatedSuspendedThankYou',
    'header' => [
        'image' => asset('assets/images/iBuumerangLogo.png'),
        'width' => '150px'
    ],
    'modal_size' => 'modal-sm'
    ])
    
    <div class="row">
        <div class="col-12 text-center">
            <h4 class="thank-you">Reactivated!</h4>
        </div>
    </div>

    @slot('actions')
        <button id="redirectDashboard" class="btn btn-yellow">RETURN TO DASHBOARD</button>
    @endslot 
@endcomponent