@component('layouts.components.modal', ['id' => 'modalAddNewCardShoppingCart'])
@slot('title')
<div class="text-center">
    <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
</div>
@endslot

<div class="col-12 alert alert-danger d-none" id="errorMessage"></div>
<form id="cardForm">
    <div id="user">
        <div class="row">
            <div class="form-group col-6">
                <label for="first_name" class="control-label">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name">
            </div>

            <div class="form-group col-6">
                <label for="last_name" class="control-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name">
            </div>
        </div>
    </div>

    <div id="creditCard">
        <div class="row">
            <div class="form-group col-6">
                <label for="number" class="control-label">Card Number</label>
                <input type="text" class="form-control cc-number" name="number" id="number">
            </div>
            <div class="form-group col-6">
                <label for="expiry_date" class="control-label">Expiration Date</label>
                <input type="text" class="form-control cc-expires" name="expiry_date" id="expiry_date" data-mask="99/9999" placeholder="MM/YYYY">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <input type="checkbox" name="primary_address" id="primary_address" value="1">
            <label for="primary_address">Use my primary address as billing address</label>
        </div>
    </div>
    <div id="address">
        <div class="row">
            <div class="form-group col-4">
                <label for="address1" class="control-label">Address</label>
                <input type="text" class="form-control address" name="address1" id="address1">
            </div>

            <div class="form-group col-4">
                <label for="apt" class="control-label">Apt/Suite</label>
                <input type="text" class="form-control address" name="apt" id="apt">
            </div>

            <div class="form-group col-4">
                <label for="countrycode" class="control-label">Country</label>
                <select class="form-control address" name="countrycode" id="countrycode"></select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-4">
                <label for="city" class="control-label">City/Town</label>
                <input type="text" class="form-control address" name="city" id="city">
            </div>

            <div class="form-group col-4">
                <label for="stateprov" class="control-label">State/Province</label>
                <select class="form-control" name="stateprov" id="stateprov"></select>
            </div>

            <div class="form-group col-4">
                <label for="postal_code" class="control-label">Postal Code</label>
                <input type="text" class="form-control address" name="postal_code" id="postal_code">
            </div>
        </div>
    </div>
    <input type="hidden" class="form-control" name="update_payment_method_id" id="update_payment_method_id">
</form>


@slot('actions')
<button class="btn btn-default" id="btnCancelAddNewCard">Cancel</button>
<button class="ladda-button btn btn-yellow" type="submit" id="btnSubmitNewCard" data-style="expand-right">
    <span class="ladda-label">Continue</span>
    <span class="ladda-spinner"></span>
    <div class="ladda-progress" style="width: 0;"></div>
</button>
@endslot

@endComponent