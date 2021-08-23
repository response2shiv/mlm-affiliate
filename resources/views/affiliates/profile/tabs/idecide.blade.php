@extends('affiliates.profile.index')

@section('title','IDecide')

@section('child')
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label for="" class="col-sm-12 form-control-label">New IDecide Email</label>
            <div class="col-md-8">
                <input type="email" name="idecide_email" class="form-control" id="idecide_email">
            </div>
            <button type="submit" class="btn btn-primary btnIdecideSaveEmail"
            data-method="POST"
            data-endpoint="/affiliate/idecide/reset-mail"
            >Save new Email</button>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label for="" class="col-sm-12 form-control-label">New IDecide Password</label>
            <div class="col-md-8">
                <input type="password" name="idecide_new_pass" class="form-control" id="idecide_new_pass">
            </div>
            <button type="submit" class="btn btn-primary btn-sm btnIdecideSavePassword"
             data-method="POST"
             data-endpoint="/affiliate/idecide/reset-password"
            >Save new Password</button>
        </div>
    </div>
</div>

@endsection
