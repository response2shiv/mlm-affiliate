@extends('affiliates.profile.index')

@section('title','Basic Information')
@section('child')
<div class="row">
    <div class="col-md-12">
        <form id="postForm" data-method="POST" data-endpoint="/affiliate/user/save-profile">
            @csrf
            <div class="form-group row">
                <label class="col-md-4 col-form-label">First Name</label>
                <div class="col-md-8">
                    <input class="form-control" name="firstname" readonly value="{{ $profile->firstname ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Last Name</label>
                <div class="col-md-8">
                    <input class="form-control" name="lastname" readonly value="{{ $profile->lastname ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Username</label>
                <div class="col-md-8">
                    <input class="form-control" readonly value="{{ $profile->username ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Recognition Name</label>
                <div class="col-md-8">
                    <input class="form-control" name="recognition_name" value="{{ $profile->recognition_name ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Business Name</label>
                <div class="col-md-8">
                    <input class="form-control" name="business_name" value="{{ $profile->business_name ?? '' }}">
                </div>
            </div>
            {{-- <div class="form-group row">
                <label class="col-md-4 col-form-label">Beneficiary</label>
                <div class="col-md-8">
                    <input class="form-control" name="beneficiary" value="{{ $profile->beneficiary ?? ''  }}">
                </div>
            </div> --}}
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Email</label>
                <div class="col-md-8">
                    <input class="form-control" readonly value="{{ $profile->email ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Phone</label>
                <div class="col-md-8">
                    <input class="form-control" readonly name="phonenumber" value="{{ $profile->phonenumber ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Mobile</label>
                <div class="col-md-8">
                    <input class="form-control" readonly name="mobilenumber" value="{{ $profile->mobilenumber ?? ''}}">
                </div>
            </div>
            <div class="form-group row" style="margin-top:10px;">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button type="submit" id="btnSaveForm" class="btn btn-primary btn-sm">Update Basic information</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
