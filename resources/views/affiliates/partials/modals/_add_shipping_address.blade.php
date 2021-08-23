@component('layouts.components.modal', ['id' => 'modalAddShippingAddress'])
    @slot('title')
        <div class="text-center">
            <img src="https://dev3.ibuumerang.com/assets/images/iBuumerangLogo.png" width="180px;">
        </div>
    @endslot

    <div class="col-12 alert alert-danger d-none" id="errorMessage"></div>
    <div class="row">
        <div class="form-group col-12">
            <input type="checkbox" name="primary_address" id="primary_address" value="1">
            <label for="primary_address">Use my primary address as shipping address</label>
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
                <select class="form-control address" name="countrycode" id="countrycode">
                    <option disabled selected>-- Choose a country --</option>
                </select>
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


    @slot('actions')
        <button class="btn btn-default" id="btnCancelAddShippingAddress">Cancel</button>
        <button class="ladda-button btn btn-yellow" type="submit" id="btnSubmitShippingAddress" data-style="expand-right">
            <span class="ladda-label">Save</span>
            <span class="ladda-spinner"></span>
            <div class="ladda-progress" style="width: 0;"></div>
        </button>

        <button class="ladda-button btn btn-yellow" type="submit" id="btnEditSubmitShippingAddress" data-style="expand-right">
            <span class="ladda-label">Save</span>
            <span class="ladda-spinner"></span>
            <div class="ladda-progress" style="width: 0;"></div>
        </button>
    @endslot

@endcomponent
