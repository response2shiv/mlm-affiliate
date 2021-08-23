@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn">
  <div class="row">
    <div class="col-lg-6">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Weekly Commission</h5>
            </div>
            <div class="ibox-content">
              <div class="form-group row">
                <div class="col-sm-10"><select class="form-control m-b" name="week_ending">
                  <option value="2020-02-16 23:59:59">
                    Commission Summary for Week Ending 2020-02-16
                  </option>                    
                </select>
                <div class="col-sm-4 col-sm-offset-2">
                  <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                </div>

                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Monthly Commission</h5>
            </div>
            <div class="ibox-content">
              <div class="form-group row">
                <div class="col-sm-10">
                  <select class="form-control m-b" name="unilevel_date">                 
                  </select>
                <div class="col-sm-4 col-sm-offset-2">
                  <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
@endpush