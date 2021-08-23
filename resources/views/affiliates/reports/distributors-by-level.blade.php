@extends('layouts.affiliates')
  @push('styles')
  <link href="{{ asset('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
  @endpush
@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row justify-content-center">
      <div class="col-lg-6">
      <div class="ibox">
          <div class="ibox-title">
              <h5>Organization</h5>
          </div>
          <div class="ibox-content">

              <table class="table text-center">
                  <thead>
                  <tr>
                      <th>Level</th>
                      <th>Distributors</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>1</td>
                      <td>9</td>
                      <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal5">
                          Detail
                        </button>
                      </td>
                  </tr>
                  </tbody>
              </table>

          </div>
      </div>
  </div>
  </div>
</div>
@endsection

@push('modals')
<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          </div>
          <div class="modal-body">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Level 1 Enrollments - #TSA8715163</h5>
                            </div>
                            <div class="ibox-content">
    
                                <table class="footable table table-stripped toggle-arrow-tiny">
                                    <thead>
                                    <tr>
    
                                        <th data-toggle="true">Dist ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th data-hide="all">Enrollment Pack</th>
                                        <th data-hide="all">Sponsor ID</th>
                                        <th data-hide="all">Enrollment Date</th>
                                        <th data-hide="all">Binary Leg</th>
                                        <th data-hide="all">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>TSA3259330</td>
                                        <td>Finn</td>
                                        <td>McMissile</td>
                                        <td>finnmcmissile@mailinator.com</td>
                                        <td>finnmcmissile</td>
                                        <td>Coach Class</td>
                                        <td>TSA8715163</td>
                                        <td>2020-01-17 21:53:13</td>
                                        <td>R</td>
                                        <td><a href="#" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="pagination float-right"></ul>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
  </div>
</div>
@endpush

@push('scripts')
  <!-- FooTable -->
  <script src="{{ asset('js/plugins/footable/footable.all.min.js') }}"></script>

  <script>
    $(document).ready(function() {
        $('.footable').footable();
    });
  </script>
@endpush