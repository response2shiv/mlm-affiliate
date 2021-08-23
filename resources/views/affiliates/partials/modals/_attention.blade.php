@component('layouts.components.modal', ['id' => 'modalAttention'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="text-center">
        <h3 class="font-weight-bold mb-4">ATTENTION CHAMPIONS</h3>
        <p>We are in the process of updating our processing technology and subscription platform.
            This requires us to temporarily disable all transactions while we make the shift. We apologize for the inconvenience.
            Until we process subscriptions, we are granting you temporary active status.
            Your commission payments will not be affected.<br>
            Our site will be updated soon.<br><br>
            Thank you for your patience as we make ncrease better!.
        </p>
    </div>

    @slot('actions')
        <button id=btCloseAttention class="btn btn-dark text-uppercase" data-dismiss="modal">Ok</button>        
    @endslot
@endcomponent

@prepend('scripts')
    <script>
        $(document).ready(function() {
            var ls = localStorage.getItem("modalAttention");
            if(!ls){
                $('#modalAttention').modal('show');
            }
        })

        $('#modalAttention').on('shown.bs.modal', function(){
            localStorage.setItem("modalAttention", false);
        });
        
    </script>
@endprepend

