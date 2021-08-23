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
                  <h5>Group ncrease</h5>
                  <div class="ibox-tools">
                  </div>
              </div>
              <div class="ibox-content">
                  <div class="table-responsive" style="width: 100%;">
                      <table
                          class="table table-striped table-hover dataTables-example dataTable ib-table"
                          id="dt_boomerangs_group" aria-describedby="dt_boomerangs_group" role="grid" width="100%">
                          <thead>
                          <tr role="row">
                              <th>Campaign Name</th>
                              <th>Number of uses</th>
                              <th>Avaliable</th>
                              <th>Boomerang Code</th>
                              <th>Date Created</th>
                              <th>Expiration date</th>
                          </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                          <tr>
                              <th rowspan="1" colspan="1">Campaign Name</th>
                              <th rowspan="1" colspan="1">Number of uses</th>
                              <th rowspan="1" colspan="1">Avaliable</th>
                              <th rowspan="1" colspan="1">Boomerang Code</th>
                              <th rowspan="1" colspan="1">Date Created</th>
                              <th rowspan="1" colspan="1">Expiration date</th>
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
  <script src="{{ asset('js/ibuumerang/boomerang/group.js') }}"></script>
@endpush
