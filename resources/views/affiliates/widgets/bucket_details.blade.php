<div class="ibox float-e-margins widget-rank-insights">
    <div class="ibox-title widget-rounded-border-top">

        <div class="col-xl-12 border-bottom-title">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="ibumm-widget-title">BUCKET DETAILS</div>
                </div>
            </div>
        </div>


    </div>
    <div class="ibox-content widget-rounded-border-bottom">
        <div class="d-flex flex-column mb-4">
            <h4 class="font-weight-bold">Paid as Rank: ISBO</h4>
            <div class="d-flex flex-row align-items-center">
                <h4 class="font-weight-bold">Level up: ncreaser 500</h4>
                <button class="btn btn-link" onclick="showTooltip()" onmouseout="hideTooltip()">
                    <span class="font-weight-light"><i class="fa fa-info-circle ml-1"></i></span>
                </button>
            </div>
            <div class="tootiptext" style="display:none;">
                <p class="font-weight-bold ml-2 mb-1">Ncreaser 1000</p>
                <table class="table table-requirements">
                    <thead>
                        <tr>
                            <td>Requirements:</td>
                            <td>A</td>
                            <td>B</td>
                            <td>C</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Distributors</td>
                            <td>{{ $dashboard['bucket_volumes'][0]->bv_a }}</td>
                            <td>0</td>
                            <td>0</td>

                        </tr>
                        <tr>
                            <td>Current Week Vol</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>

                        </tr>
                        <tr>
                            <td>4 Week Vol</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>

                        </tr>
                        <tr>
                            <td>Personally Enrolled</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>4 Week PEV</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row d-flex text-center">
            <div class="col-md-12 col-sm-12">
                <div class="row justify-content-around">
                    <div class="col-md-4 col-sm-12">
                        <div class="bucket">
                            <div class="bucket-circle">
                                <span class="bucket-name">A</span>
                            </div>
                            <span class="bucket-volume">{{$dashboard['bucket_volumes'][0]->bv_a}}</span>
                            <span class="bucket-text">4 Week Volume</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="bucket">
                            <div class="bucket-circle">
                                <span class="bucket-name">B</span>
                            </div>
                            <span class="bucket-volume">{{$dashboard['bucket_volumes'][0]->bv_b}}</span>
                            <span class="bucket-text">4 Week Volume</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="bucket">
                            <div class="bucket-circle">
                                <span class="bucket-name">C</span>
                            </div>
                            <span class="bucket-volume">{{$dashboard['bucket_volumes'][0]->bv_c}}</span>
                            <span class="bucket-text">4 Week Volume</span>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-xl-12 border-bottom-title mt-5">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="ibumm-widget-title">BREAKDOWN</div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12">
                <a href="#" class="btn btn-primary">PEV Report</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <table class="table breakdown-table table-responsive-sm">
                    <thead>
                        <tr>
                            <td></td>
                            <td>A</td>
                            <td>B</td>
                            <td>C</td>
                            <td>TOTAL</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Distributors</td>
                            <td>{{ $dashboard['distributor_counts']->aISBO}}</td>
                            <td>{{ $dashboard['distributor_counts']->bISBO}}</td>
                            <td>{{ $dashboard['distributor_counts']->cISBO}}</td>
                            <td>{{ $dashboard['distributor_counts']->aISBO + $dashboard['distributor_counts']->bISBO + $dashboard['distributor_counts']->cISBO  }}</td>
                        </tr>
                        <tr>
                            <td>Current Week Vol</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->aCV }}</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->bCV }}</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->cCV }}</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->aCV + $dashboard['distributor_counts']->volumes->bCV + $dashboard['distributor_counts']->volumes->cCV }}</td>
                        </tr>
                        <tr>
                            <td>4 Week Vol</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->aFourWV }}</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->bFourWV }}</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->cFourWV }}</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->aFourWV + $dashboard['distributor_counts']->volumes->bFourWV + $dashboard['distributor_counts']->volumes->cFourWV }}</td>
                        </tr>
                        <tr>
                            <td>Personally Enrolled</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->aFourWV }}</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->bFourWV }}</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->cFourWV }}</td>
                            <td>{{ $dashboard['distributor_counts']->volumes->aFourWV + $dashboard['distributor_counts']->volumes->bFourWV + $dashboard['distributor_counts']->volumes->cFourWV }}</td>
                        </tr>
                        <tr>
                            <td>4 Week PEV</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $dashboard['distributor_counts']->volumes->fourWeekPEV }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="pull-left">
            <span class="cancelled-text">Cancelled ISBO's are not included in the Distributor calculations.</span>
        </div>

    </div>
</div>
@push('scripts')
<script>
    function showTooltip() {
        $(".tootiptext").show();
    }

    function hideTooltip() {
        console.log('fechar')
        $(".tootiptext").hide();
    }
</script>
@endpush