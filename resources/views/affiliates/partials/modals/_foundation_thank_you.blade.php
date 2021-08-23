@component('layouts.components.modal', [
    'id' => 'modalFoundationThankYou',
    'header' => [
        'image' => asset('assets/images/ibuum-foundation-logo.png'),
        'width' => '150px'
    ],
    'modal_size' => 'modal-sm'
    ])

    <div class="row">
        <div class="col-12 text-center">
            <h3 class="thank-you">Thank you! Your order is complete</h3>
        </div>
    </div>

    @slot('actions')
        <button class="btn btn-yellow" id="btnFoundationReturnToDashboard">Return to Dashboard</button>
    @endslot
@endcomponent
