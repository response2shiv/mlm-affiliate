@extends('layouts.affiliates')
  @push('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
  @endpush
@section('base-content')
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
      <div class="col-lg-12">
          <div class="ibox ">
              <div class="ibox-title">
                  <h5>Individual Ncrease</h5>
                  <div class="ibox-tools">
                  </div>
              </div>
              <div class="ibox-content">
                  <div class="table-responsive" style="width: 100%;">
                      <table
                          class="table table-striped table-hover dataTables-example dataTable ib-table"
                          id="boom_ind" aria-describedby="boom_ind" role="grid" width="100%">
                          <thead>
                          <tr role="row">
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Code</th>
                              <th>Date Created</th>
                              <th>Expiration date</th>
                              <th>Used</th>
                          </tr>
                          </thead>
                          <tbody>                          
                          </tbody>
                          <tfoot>
                          <tr>
                              <th rowspan="1" colspan="1">First Name</th>
                              <th rowspan="1" colspan="1">Last Name</th>
                              <th rowspan="1" colspan="1">Email</th>
                              <th rowspan="1" colspan="1">Mobile</th>
                              <th rowspan="1" colspan="1">Code</th>
                              <th rowspan="1" colspan="1">Date Created</th>
                              <th rowspan="1" colspan="1">Expiration date</th>
                              <th rowspan="1" colspan="1">Used</th>
                          </tr>
                          </tfoot>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
  <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('js/ibuumerang/boomerang/individual.js') }}"></script>
@endpush