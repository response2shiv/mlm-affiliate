@extends('affiliates.profile.index')

@section('title','Billing Address')

@section('child')
<div class="row">
    <div class="col-md-12">
        <form id="postForm" data-method="POST" data-endpoint="/affiliate/user/save-billing-address">
            @csrf
            <div class="form-group row">
                <label class="col-md-2" id="primary-address"> 
                    <div class="icheckbox_square-green">
                        <label>Same as primary</label>
                        <input type="checkbox" id="primary-address">
                    </div> 
                </label>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Address 1</label>
                <div class="col-md-8">
                    <input class="form-control" name="address1" id="address1" value="{{ $billing_address->address1 ?? ''}} ">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Address 2</label>
                <div class="col-md-8">
                    <input class="form-control" name="address2" id="address2" value="{{ $billing_address->address2 ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Apt / Suite</label>
                <div class="col-md-8">
                    <input class="form-control" name="apt" id="apt" value="{{ $billing_address->apt ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">City</label>
                <div class="col-md-8">
                    <input class="form-control" name="city" id="city" value="{{ $billing_address->city ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">State / Province</label>
                <div class="col-md-8">
                    <input class="form-control" name="stateprov" id="stateprov" value="{{ $billing_address->stateprov ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Postal Code</label>
                <div class="col-md-8">
                    <input class="form-control" name="postalcode" id="postalcode" value="{{ $billing_address->postalcode ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Country Code</label>
                <div class="col-md-8">
                    <select class="form-control" name="countrycode" id="countrycode">
                        @foreach($countries as $c)
                            <option value="{{$c->countrycode}}" {{ $c->countrycode == $billing_address->countrycode ? 'selected' : '' }}>{{$c->country}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row" style="margin-top:10px;">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button type="submit" id="btnSaveForm" class="btn btn-primary btn-sm">Update Billing Address</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
