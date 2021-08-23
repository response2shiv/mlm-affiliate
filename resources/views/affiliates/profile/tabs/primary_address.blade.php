@extends('affiliates.profile.index')


@section('title','Primary Address')

@section('child')
<div class="row">
    <div class="col-md-12">
        <form id="postForm" data-method="POST" data-endpoint="/affiliate/user/save-primary-address">
            @csrf
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Address 1</label>
                <div class="col-md-8">
                    <input class="form-control" name="address1" readonly value="{{$primary_address->address1 ?? ''}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Address 2</label>
                <div class="col-md-8">
                    <input class="form-control" name="address2" readonly value="{{ $primary_address->address2 ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Apt / Suite</label>
                <div class="col-md-8">
                    <input class="form-control" name="apt" readonly value="{{ $primary_address->apt ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">City</label>
                <div class="col-md-8">
                    <input class="form-control" name="city" readonly value="{{$primary_address->city ?? ''}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">State / Province</label>
                <div class="col-md-8">
                    <input class="form-control" name="stateprov" readonly value="{{$primary_address->stateprov ?? ''}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Postal Code</label>
                <div class="col-md-8">
                    <input class="form-control" name="postalcode" readonly value="{{ $primary_address->postalcode ?? ''}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Country Code</label>
                <div class="col-md-8">

                    <select class="form-control" readonly name="countrycode">
                        @foreach($countries as $c)
                            <option value="{{$c->countrycode}}" {{ $c->countrycode == ($primary_address->countrycode??null) ? 'selected' : '' }}>{{$c->country}}</option>
                        @endforeach
                    </select>
                </div> 
            </div>
            <!-- <div class="form-group row" style="margin-top:10px;">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button type="submit" id="btnSaveForm" class="btn btn-primary btn-sm">Update Primary Address</button>
                    </div>
                </div>
            </div> -->
        </form>
    </div>
</div>
@endsection
