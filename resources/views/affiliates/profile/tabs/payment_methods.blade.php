@extends('affiliates.profile.index')

@section('title','Payment Methods')

@section('child')
<div class="row">
    <div class="col-12">
        <a class="btn btn-primary text-white pull-right" id="btnAddAddNewCard" /> Add Payment Method<a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table class="table table-reponsive table-striped">
            <thead>
                <tr>
                    <th>Primary</th>
                    <th>Name</th>
                    <th>Card Number </th>
                    <th>Expiration</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payment_methods as $pm)
                <tr>
                    <td>
                        <label> <input type="radio" {{ $pm->is_primary ? 'checked' : '' }} value="{{$pm->id}}" id="{{$pm->id}}" name="set_primary" class="setPrimary" data-id="{{$pm->id}}"></label>
                    </td>
                    <td>{{ $pm->first_name }} {{ $pm->last_name }}</td>
                    <td>{{ \App\Models\PaymentMethod::getFormatedCardNo($pm->card_token)}}</td>
                    <td>{{ $pm->expiration_month}} / {{$pm->expiration_year}}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" id="btnEditPaymentMethod" data-payment="{{ $pm->id }}" data-method="POST" data-endpoint="/affiliate/user/get-payment-method">
                            <i class="fa fa-edit text-dark"></i>
                        </button>

                        <button class="ml-1 btn btn-danger btn-sm deletePaymentMethodButton" data-payment="{{ $pm->id }}" data-method="POST" data-endpoint="/affiliate/user/delete-payment-method">
                            <i class="fa fa-trash text-white"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

@push('scripts')
<script src="{{asset('js/ibuumerang/jquery.payment.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('.cc-number').formatCardNumber();
        $('.cc-expires').formatCardExpiry();
    });
</script>
@endpush