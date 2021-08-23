@extends('affiliates.profile.index')

@section('title','Replicated Site Preferences')

@section('child')

<div class="row">
    <div class="col-md-12">
        <form id="postForm" data-method="POST" data-endpoint="/affiliate/user/replicated-preferences">
            @csrf
            <div class="form-group row">
                <label class="col-md-4 col-form-label">Primary Name</label>
                <div class="col-md-8">
                    <input class="form-control" name="name" readonly placeholder="Primary Name" value="{{ $preferences->name ?? ''}}" readonly="">
                </div>
            </div>

            <div class="form-group row ">
                <label class="col-md-4 col-form-label">Display Name</label>
                <div class="col-md-8">
                    <input class="form-control" name="display_name" placeholder="Display Name" value="{{ $preferences->displayed_name ?? '' }}">
                </div>
            </div>

            <div class="form-group row ">
                <label class="col-md-4 col-form-label">Email</label>
                <div class="col-md-8">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $preferences->email ?? '' }}">

                    <fieldset id="show_email"> Display on site?
                        <input type="radio" value="1" name="show_email" id="email_yes" {{$preferences->show_email == true ? 'checked' : ''}}>
                                <label for="email_yes"> Yes</label>
                            <input type="radio" value="0" name="show_email" id="email_no" {{$preferences->show_email == false ? 'checked' : ''}}>
                                <label for="email_no"> No</label>
                    </fieldset>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label">Cell Phone</label>
                <div class="col-md-8">
                    <input class="form-control" name="phone" placeholder="Cell Phone" value="{{ $preferences->phone ?? '' }}">

                    <fieldset id="show_phone">Display on site?
                        <input type="radio" value="1" name="show_phone" {{$preferences->show_phone == true ? 'checked' : ''}}>
                                <label for="phone_yes"> Yes</label>
                            <input type="radio" value="0" name="show_phone" {{$preferences->show_phone == false ? 'checked' : ''}}>
                                <label for="phone_no"> No</label>
                    </fieldset>
                </div>
            </div>

            <div class="form-group row ">
                <label class="col-md-4 col-form-label">Co Applicant Name</label>
                <div class="col-md-8">
                    <input class="form-control" name="co_name" readonly placeholder="Co Applicant Name" value="{{ $preferences->co_name ?? '' }}" readonly="">
                </div>
            </div>

            <div class="form-group row ">
                <label class="col-md-4 col-form-label">Co App Display Name</label>
                <div class="col-md-8">
                    <input class="form-control" name="co_display_name" readonly placeholder="Co App Display Name" value="{{ $preferences->co_display_name ?? '' }}" readonly="">
                </div>
            </div>

            <div class="form-group row ">
                <label class="col-md-4 col-form-label">Business Name</label>
                <div class="col-md-8">
                    <input class="form-control" name="business_name" placeholder="Business Name" value="{{ $preferences->bussiness_name ?? '' }}">
                </div>
            </div>

            <div class="form-group row ">
                <label class="col-md-4 col-form-label">
                    Name displayed on the replicated website:
                </label>

                <div class="col-md-8">
                    <fieldset id="show_name">
                        <input type="radio" value="1" name="show_name" id="name" {{$preferences->show_name == 1 ? 'checked' : '' }}>
                            <label for="name">Display Name</label>
                        <input type="radio" value="3" name="show_name" id="business_name" {{ $preferences->show_name > 1 ? 'checked' : ''}}>
                        <label for="business_name">Business Name</label>
                    </fieldset>
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
