@extends('layouts.affiliates')
  @push('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/plugins/intTelInput/intlTelInput.css') }}">
  @endpush
@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>PLACEMENT LOUNGE</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <section>
                                <div class="container">

                                    <div class="row justify-content-md-center mb-4">
                                        <div class="col-lg-4 col-md-12">
                                            <p class="text-justify">
                                                Use the search feature to find the ISBO you would like to place your new enrollment under. 
                                                Select the bucket to the left of the search bar to determine which bucket you would like the enrollment to be place. 
                                                Then, double check to make sure this is the correct placement as all placements are final. 
                                                If this is correct, hit the Place Selected button and confirm. 
                                                Placement may take up to several minutes to place.
                                            </p>
                                            <div class="col-12">
                                                    <h3 class="font-italic" style="font-size: 11.7px;color: #f74827;">DOUBLE CHECK! ALL PLACEMENTS ARE FINAL!</h3>
                                                </div>
                                            {{--  <div class="ml-5 mb-4">
                                                <form action="{{ route('update-preference-placement') }}" method="POST">
                                                @csrf
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="preference_placement" id="left" value="left">
                                                    <label class="form-check-label" for="left">
                                                      Left
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="preference_placement" id="right" value="right">
                                                    <label class="form-check-label" for="right">
                                                      Right
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="preference_placement" id="greater" value="greater">
                                                    <label class="form-check-label" for="greater">
                                                      Greater Volume
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="preference_placement" id="lesser" value="lesser">
                                                    <label class="form-check-label" for="lesser">
                                                      Lesser Volume
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="preference_placement" id="auto" value="auto">
                                                    <label class="form-check-label" for="auto">
                                                      Alternating
                                                    </label>
                                                  </div>
                                                    <button class="btn btn-primary mt-2">Save Preference</button>
                                                </form>
                                            </div>  --}}
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                        <h5>ISBO Search</h5>
                                            <div class="row justify-content-md-center  mb-2 mt-2 inner-addon right-addon">
                                                <label>
                                                    <div class="input-group m-b align-items-center">
                                                        <input type="text" class="form-control" id="usern">
                                                        <div class="input-group-append">
                                                            <span class="input-group-addon" style="font-size: 18.7px;"><div class="glyphicon glyphicon-search"></div></span>
                                                        </div>
                                                        <a href="{{ url('/organization/binary-viewer') }}" target="_blank"><img src="{{asset("images/trinary_icon.png")}}" style='width: 35px;' class='ml-2 img-responsive'></a>
                                                    </div>
    
                                                    <button class="ml-2 btn btn-primary" id="placement-search" style="background-color: #1e92d0; border-color: #1e92d0;">Search</button><br/>
                                                    <div class="media-body ml-2 mb-2" id="user-selected">
                                                                                                       
                                                    </div>  
                                                    <button class="ml-2 btn btn-primary" id="place-selected" hidden>Place Selected</button>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <h5>Bucket Placement</h5>
                                            <div class="row justify-content-md-center">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="bucket">
                                                        <div class="form-check form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="bucket" id="placement_bucket" value="1">
                                                        </div>
                                                        <div class="bucket-circle" style="height: 60px; width: 60px;">
                                                            <span class="bucket-name" style="font-size: 25px;" >A</span>
                                                        </div>
                                                        <span class="small mt-2 font-weight-bold" id="volumn_bcuket_a">0</span>
                                                        <span class="small">4 Week Volume</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="bucket">
                                                        <div class="form-check form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio" name="bucket" id="placement_bucket" value="2">
                                                        </div>
                                                        <div class="bucket-circle" style="height: 60px; width: 60px;">
                                                            <span class="bucket-name" style="font-size: 25px;">B</span>
                                                        </div>
                                                        <span class="small mt-2 font-weight-bold" id="volumn_bcuket_b">0</span>
                                                        <span class="small">4 Week Volume</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="bucket">
                                                        <div class="form-check form-check-inline mb-2">
                                                            <input class="form-check-input" type="radio"                                      id="placement_bucket"
                                                            name="bucket"
                                                            value="3">
                                                        </div>
                                                        <div class="bucket-circle" style="height: 60px; width: 60px;">
                                                            <span class="bucket-name" style="font-size: 25px;">C</span>
                                                        </div>
                                                        <span class="small mt-2 font-weight-bold" id="volumn_bcuket_c">0</span>
                                                        <span class="small">4 Week Volume</span>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--  <div class="row justify-content-md-center">
                                                <div class="col-lg-12 col-md-10 text-center">
                                                    <p class="sponsor-l"><a id="url-left" style="white-space: pre-wrap; word-wrap: break-word;" href="https://join.ibuumerang.com/enrollment/sponsor/{{ Auth::user()->username }}/L">https://join.ibuumerang.com/enrollment/sponsor/{{ Auth::user()->username }}/L</a></p>
                                                    <p class="sponsor-r"><a id="url-right" style="white-space: pre-wrap; word-wrap: break-word;" href="https://join.ibuumerang.com/enrollment/sponsor/{{ Auth::user()->username }}/R">https://join.ibuumerang.com/enrollment/sponsor/{{ Auth::user()->username }}/R</a></p>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="text-sm-center">Choose a sending method</label>
                                                            <button class="btn btn-primary btn-block mb-1" id="btnSendSMS">Send as SMS</button>
                                                            <input type="text" class="form-control" id="txtSendSMS" placeholder="">

                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-primary btn-block mb-1" id="btnSendEmail">Send as Email</button>
                                                            <input type="text" class="form-control" id="email" placeholder="name@email.com">
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-primary btn-block mb-2" id="buttonClipboard" data-clipboard-target="#url">Copy To Clipboard</button>
                                                        </div>

                                                        <input type="text" id="url" name="url" value="https://join.ibuumerang.com/enrollment/sponsor/{{ Auth::user()->username }}/L" style="visibility: hidden;"> 
                                                    </form>
                                                </div>
                                            </div>--}}
                                            <div col="row justify-content-md-center"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <hr>
                            <div class="col-lg-12">
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="selectedUsers">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>ISBO NUMBER</th>
                                                    <th>First Name </th>
                                                    <th>Last Name </th>
                                                    <th>Username</th>
                                                    <th>Enrollment Date</th>
                                                    <th>Enrollment Pack</th>
                                                    <th>Country</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                            </div>
                            <hr>
                            <div class="ibox-content">
                            <div class="row align-items-center">
                                <div class="col-sm-3">
                                    <div class="input-group" data-children-count="1">
                                        <input placeholder="Search" type="text" class="form-control form-control-sm"> 
                                        <span class="input-group-append"> 
                                            <button type="button" class="btn btn-sm btn-primary">
                                                <div class="glyphicon glyphicon-search"></div>
                                            </button> 
                                        </span>
                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <h4> AVAILABLE TO PLACE</h4>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>ISBO NUMBER</th>
                                        <th>First Name </th>
                                        <th>Last Name </th>
                                        <th>Username</th>
                                        <th>Enrollment Date</th>
                                        <th>Enrollment Pack</th>
                                        <th>Country</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr id="tr{{$user->id}}">
                                            <td><input type="checkbox" id="{{$user->id}}" class="i-checks" name="input[]" value="{{$user->id}}"></td>
                                            <td>{{$user->distid}}</td>
                                            <td>{{$user->firstname}}</td>
                                            <td>{{$user->lastname}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->created_date}}</td>
                                            <td>{{\App\Models\Product::getProductName($user->current_product_id)}}</td>
                                            <td>{{$user->country_code}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                            {{--  <div class="table-responsive" id="div_direct_line">  
                                <label>
                                    <div class="input-group m-b">
                                        <input type="text" class="form-control" id="search">
                                        <div class="input-group-append">
                                            <span class="input-group-addon"><div class="glyphicon glyphicon-search"></div></span>
                                        </div>
                                    </div>
                                </label>
                                <table class="table table-hover dataTables-example dataTable ib-table"
                                    id="tb_direct_line" aria-describedby="tb_direct_line" role="grid" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>Dist ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Binary Leg</th>
                                        <th>Active Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body_direct_line"> </tbody>
                                </table>
                            </div>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

    <script src="{{ asset('js/plugins/intTelInput/intlTelInput-jquery.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/utils.js') }}"></script>
    <script src="{{ asset('js/plugins/clipboard/clipboard.min.js') }}"></script>

    <script src="{{ asset('js/ibuumerang/organization/lounge.js') }}"></script>

    <script type="text/javascript">

    

    </script>

@endpush

@push('modals')
    @include('affiliates.partials.modals._confirm_user_placement')
    @if($bucketIsNotAvaliable == true)
        @include('affiliates.partials.modals._bucket_not_avaliable')
    @endif
@endpush