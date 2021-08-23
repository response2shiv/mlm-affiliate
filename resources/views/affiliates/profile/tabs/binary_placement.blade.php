@extends('affiliates.profile.index')

@section('title','Binary Placement')

@section('child')


<div class="row">

<div class="col-md-12">
    <p>
    The placement preference you choose below will determine where those distributors who register through your business site will be placed in your Binary Downline.
    </p>
</div>
<div class="col-md-12 d-flex justify-content-center">
    <form id="postForm" data-method="POST" data-endpoint="/affiliate/user/save-placements">
        @csrf
        <div class="form-group">
                <div class="col-12">
                    <label class="m-radio">
                        <input type="radio" name="binary_placement" value="left" {{$binary_placement == 'left' ? 'checked' : ''}}> Left
                        <span></span>
                    </label>
                </div>
                <div class="col-12">
                    <label class="m-radio">
                        <input type="radio" name="binary_placement" value="right" {{$binary_placement == 'right' ? 'checked' : ''}}> Right
                        <span></span>
                    </label>
                </div>
                <div class="col-12">
                    <label class="m-radio">
                        <input type="radio" name="binary_placement" value="auto" {{$binary_placement == 'auto' ? 'checked' : ''}}> Alternating
                        <span></span>
                    </label>
                </div>
        </div>
        <div class="text-center">
        <button type="submit" id="btnSaveForm" class="btn btn-primary btn-sm">Update Binary Placement</button>
        </div>
    </form>
</div>

@endsection
