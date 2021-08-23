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

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <section>
                                <h4>BUCKET PLACEMENT</h4>
                                <div class="ml-3 mt-3">
                                    <div class="row mb-4">
                                        <div class="col-lg-6 col-md-12">
                                            <h5>Placement Preference</h5>
                                            <p>The placement preference you choose below will determine where those distributors who register through your business
                                                site will be placed in your matrix.
                                            </p>
                                            <div class="mb-4">
                                                <form action="{{ route('update-preference-placement') }}" method="POST">
                                                @csrf
                                                 <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="preference_placement" id="lounge" value="lounge" {{$response->binary_placement == 'lounge' ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="lounge">
                                                      Placement Lounge
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="preference_placement" id="auto" value="auto" {{$response->binary_placement == 'auto' ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="auto">
                                                     Auto-Place
                                                    </label>
                                                  </div>                                                  
                                                    <button class="btn btn-primary mt-2">Save Preference</button>
                                                </form>
                                            </div>
                                            <div col="row">                                                
                                                <!-- <h3 class="font-bold">DOUBLE CHECK!</h3> -->
                                                <h3 class="font-italic" style="color: #f74827;">DOUBLE CHECK! NOTE: ALL PLACEMENTS ARE FINAL.</h3>                                                
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </section>
                            <hr>
                            <h4>PERSONALLY ENROLLED PLACEMENT</h4>                               
                            <div class="ml-3 mt-3">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-3">
                                        <table class="justify-content-right align-items-right">
                                            <tr>
                                                <td  width="50%">TOTAL ENROLLED</td>
                                                <td><span class="ml-3"><strong>0</strong></span></td>
                                            </tr>
                                            <tr>
                                                <td  width="50%">Bucket A</td>
                                                <td><span class="ml-3"><strong>0</strong></span></td>
                                            </tr>
                                            <tr>
                                                <td  width="50%">Bucket B</td>
                                                <td><span class="ml-3"><strong>0</strong></span></td>
                                            </tr>
                                            <tr>
                                                <td  width="50%">Bucket C</td>
                                                <td><span class="ml-3"><strong>0</strong></span></td>
                                            </tr>
                                        </table>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- <div class="row justify-content-md-center mb-2 mt-2 inner-addon right-addon" id="placement-search">
                                <label>
                                    <div class="input-group m-b">
                                        <input type="text" class="form-control" id="search">
                                        <div class="input-group-append">
                                            <span class="input-group-addon"><div class="glyphicon glyphicon-search"></div></span>
                                        </div>
                                        <button class="ml-2 btn btn-primary" id="placement-search">Submit</button>
                                        <a href="{{ url('/organization/binary-viewer') }}" target="_blank"><img src="{{asset("images/trinary_icon.png")}}" style='width: 35px;' class='ml-2 img-responsive'></a>
                                    </div>
                                </label>

                            </div> -->

                            <!-- <div class="table-responsive" id="div_direct_line">  
                                <table class="table table-hover dataTables-example dataTable ib-table"
                                    id="tb_direct_line" aria-describedby="tb_direct_line" role="grid" width="100%">
                                    <thead>
                                    <tr role="row">
                                        <th>Dist ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Bucket</th>
                                        <th>Active Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body_direct_line"> </tbody>
                                </table>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

    <script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/plugins/daterangepicker/daterangepicker.min.js') }}"></script>

    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

  
    <script src="{{ asset('js/plugins/intTelInput/intlTelInput-jquery.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/utils.js') }}"></script>
    <script src="{{ asset('js/plugins/clipboard/clipboard.min.js') }}"></script>

    {{--<script src="{{ asset('js/ibuumerang/organization/placement.js') }}"></script>--}}

    <script type="text/javascript">

    $(document).ready(function() {

        drawList('{{asset('images/tree-icon.png')}}');

        // check the preference of placement
        $('#{{ $response->binary_placement }}').prop( "checked", true );

        $('.sponsor-r').hide();

        $('#bottom-right').click(function(){
            $('.sponsor-r').show();
            $('.sponsor-l').hide();

            setUrlToSend($('#url-right').html());
        });

        $('#bottom-left').click(function(){
            $('.sponsor-r').hide();
            $('.sponsor-l').show();

            setUrlToSend($('#url-left').html());
        });
    });


    $(function() {

        var start = $('#from').val() != '' ? moment($('#from').val()) : moment().startOf('week');
        var end   = $('#to').val() != '' ? moment($('#to').val()) : moment().endOf('week');

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            alwaysShowCalendars: true,
            startDate: start,
            endDate: end,
            linkedCalendars: false,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        // $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        //     $('#from').val(picker.startDate.format('YYYY-MM-DD'));
        //     $('#to').val(picker.endDate.format('YYYY-MM-DD'));
        // });

        cb(start, end);
        
    });

    </script>

@endpush
