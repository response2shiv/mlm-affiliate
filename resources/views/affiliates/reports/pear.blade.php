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
                  <h5>Personally Enrolled Activity Report</h5>
                  <div class="row">
                    <div class="col-lg-3 mb-2">
                        <h6 class="pear-report-label header-pear-report">Name</h6>
                        <span class="header-pear-report">{{ $user->firstname }} {{ $user->lastname }}</span>
                    </div>
                    <div class="col-lg-2 mb-2">
                        <h6 class="pear-report-label header-pear-report">Total Qualified Volume</h6>
                        <span id="monthly_qv"></span>
                        <span id="monthly_qv_user" class="header-pear-report">{{ number_format($user->current_month_qv) }}</span>
                    </div>
                    <div class="col-lg-2 mb-2">
                        <h6 class="pear-report-label header-pear-report">Rank Qualified Volume</h6>
                        <span id="rank_qv"></span>
                        <span id="rank_qv_user" class="header-pear-report">{{ number_format(\App\Models\UserRankHistory::getQV($user->distid, $user->current_month_rank)) }}</span>
                    </div>
                    <div class="col-lg-3 mb-2">
                      <h6 class="pear-report-label header-pear-report">Month Rank</h6>
                      <span id="monthly_rank_desc"></span>
                      <span id="monthly_rank_desc_user" class="header-pear-report">{{ $user->rank()->rankdesc }}</span>
                    </div>
                    <div class="col-lg-2 mb-2">
                      <h6 class="pear-report-label header-pear-report">Month PQV</h6>
                      <span id="monthly_pqv"></span>
                      <span id="monthly_pqv_user" class="header-pear-report">{{ $user_pqv }}</span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-lg-6">
                      <h3>Current View: {{ $user->firstname }} {{ $user->lastname }}</h3>
                    </div>
                    <div class="col-lg-6">
                      @if (Request::url() != url('/report/pear'))
                        <a href="{{route('pear-report')}}" class="btn btn-primary">Back To Top</a>
                      @endif
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-2 col-md-2 col-sm-2">
                        <form action="{{Request::url()}}" method="POST" id="formHistory">
                          @csrf
                        <div class="form-group">
                            <select class="form-control form-control-sm" name="history" id="selectHistory">
                                <option value="" disabled selected>History</option>
                                @foreach ($months as $key => $value)
                                    <option value="{{ $key }}" {{ Session::get('history') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                      </form>
                    </div>
                  </div>
              </div>
              <div class="ibox-content">
                  <div class="table-responsive">
                      <table
                          class="table table-striped table-hover dataTables-example dataTable ib-table"
                          id="pearData" aria-describedby="pearData" role="grid">
                          <thead>
                          <tr role="row">
                              <th>Distid</th>
                              <th>Name</th>
                              <th>Total Qualified Volume</th>
                              <th>Rank Qualified Volume</th>
                              <th>Total Monthly CV</th>
                              <th>Personal Volume</th>
                              <th>Highest Rank</th>
                          </tr>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                          <tr>
                              <th rowspan="1" colspan="1">Distid </th>
                              <th rowspan="1" colspan="1">Name </th>
                              <th rowspan="1" colspan="1">Total Qualified Volume</th>
                              <th rowspan="1" colspan="1">Rank Qualified Volume</th>
                              <th rowspan="1" colspan="1">Total Monthly CV</th>
                              <th rowspan="1" colspan="1">Personal Volume</th>
                              <th rowspan="1" colspan="1">Highest Rank</th>
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
  <script src="{{ asset('js/ibuumerang/reports/report_pear.js') }}"></script>

@endpush
