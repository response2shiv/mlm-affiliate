@push('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

<div class="ibox float-e-margins projected-monthly-volume">
    <div class="ibox-title widget-rounded-border-top border-bottom">
        <div class="ibumm-widget-title ">PROJECTED BUCKET VOLUME</div>
    </div>
    <div class="ibox-content widget-rounded-border-bottom dashboard_block">
        <div class="row">
            <span class="hover-image">
                <img src="{{ asset('images/Projected_Bucket_Volume.png') }}" width="100%" />
                <span class="text">Coming soon</span>
            </span>
            {{--  <div class="mt-2 pmv_widget_col_left">
                <div class="row">
                    <div class="pmv_title_bold pmv_title_bold_subtitle" id="projectedVolume">{{ $dashboard['pmv']['volume']['projected_volume'] }}<span class="pmv_title_lighter">QV</span></div>
                    <div class="pmv_title_bold pmv_title_bold_subtitle d-none" id="projectedCredits">{{ $dashboard['pmv']['credits']['projected_volume'] }}<span class="pmv_title_lighter">QC</span></div>
                </div>
                <div class="row">
                    <div class="flex-row mt-4">
                        <div class="pmv_title_bold pmv_title_bold_total_processed" id="totalVolumeProcessed">
                            {{ $dashboard['pmv']['volume']['total_volume_processed'] }}<span class="pmv_title_lighter">%</span>
                            <div class="pmv_subtitle_widget">Total Processed</div>
                        </div>
                        <div class="pmv_title_bold pmv_title_bold_total_processed d-none" id="totalCreditsProcessed">
                            {{ $dashboard['pmv']['credits']['total_credits_processed'] }}<span class="pmv_title_lighter">%</span>
                            <div class="pmv_subtitle_widget">Total Processed</div>
                        </div>
                    </div>
                    <div class="flex-row nav-pills mt-4">
                        {{-- <ul class="nav mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-volume-tab" data-toggle="pill" href="#pills-volume" role="tab" aria-controls="pills-volume" aria-selected="true">Volume</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-credits-tab" data-toggle="pill" href="#pills-credits" role="tab" aria-controls="pills-credits" aria-selected="false">Credits</a>
                            </li>
                        </ul>           
                    </div>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-volume" role="tabpanel" aria-labelledby="pills-volume-tab">
                        Volume 
                        <div class="row ">
                            <div class="flex-row mt-4">
                                <div class="pmv_subtitle_widget"><span class="pmv_projected_box text-left"></span>Total Projected Subscriptions</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="flex-row mt-4">
                                <div class="pmv_subtitle_widget"><span class="pmv_processed_box text-left"></span>% Processed</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="btnDetailsProjectedMonthlyVolume">
                    <button type="button" class="pmv_button_details btn btn-primary rounded-pill">Details</button>
                </div>
            </div>
            {<div class="align-chart_projected_mothly_widget">
                <canvas id="chartVolume" width="250" height="250"></canvas>
                <canvas id="chartCredits" width="250" height="250" class="d-none"></canvas>
                <div id="projectedMonthlyVolume" class="d-none"></div>
            </div>  --}}
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>
    <script>
        var chartVolume = document.getElementById('chartVolume').getContext("2d");
        var chartCredits = document.getElementById('chartCredits').getContext("2d");

        var blue_gradient_volume = chartVolume.createLinearGradient(0, 0, 0, 600);
        var blue_gradient_credits = chartCredits.createLinearGradient(0, 0, 0, 600);

        blue_gradient_volume.addColorStop(0, '#e0c832');
        blue_gradient_volume.addColorStop(1, '#15cce4');

        blue_gradient_credits.addColorStop(0, '#e0c832');
        blue_gradient_credits.addColorStop(1, '#15cce4');

        var myChartVolume = new Chart(chartVolume, {
            type: 'pie',
            data: {
                labels: ['Projected Volume', 'Processed'],
                datasets: [{
                    data: [ '{{ $dashboard['pmv']['charts']['volume']['processed'] }}','{{ ( $dashboard['pmv']['charts']['volume']['projected_volume'] ? $dashboard['pmv']['charts']['volume']['projected_volume']-$dashboard['pmv']['charts']['volume']['processed'] : 1) }}'],
                    backgroundColor: [
                        blue_gradient_volume,
                        '#fefc53',
                    ]
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                tooltips: {
                    enabled: false,
                },
                'onClick': function (event, item) {
                    if (item[0]._model.label) {
                        $('#projectedMonthlyVolume').trigger('click');
                    }
                }
            }
        });

        var myChartCredits = new Chart(chartCredits, {
            type: 'pie',
            data: {
                labels: ['Projected Volume', 'Processed'],
                datasets: [{
                    data: [ '{{ $dashboard['pmv']['charts']['credits']['processed'] }}','{{ $dashboard['pmv']['charts']['credits']['projected_volume']-$dashboard['pmv']['charts']['credits']['processed'] }}'],
                    backgroundColor: [
                        blue_gradient_credits,
                        '#e0c832',
                    ]
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                tooltips: {
                    enabled: false,
                },
                'onClick': function (event, item) {
                    if (item[0]._model.label === 'Processed') {
                        // $('#modalProjectedMonthlyVolume').modal('show');
                        $('#projectedMonthlyVolume').trigger('click');
                    }
                }
            }
        });

        $('#pills-volume-tab').on('click', function (e) {
            e.preventDefault();

            $('#totalVolumeProcessed').removeClass('d-none');
            $('#totalCreditsProcessed').addClass('d-none');

            $('#chartVolume').removeClass('d-none');
            $('#chartCredits').addClass('d-none');

            $('#projectedVolume').removeClass('d-none');
            $('#projectedCredits').addClass('d-none');
            $(this).tab('show');
        });

        $('#pills-credits-tab').on('click', function (e) {
            e.preventDefault();

            $('#totalCreditsProcessed').removeClass('d-none');
            $('#totalVolumeProcessed').addClass('d-none');

            $('#chartCredits').removeClass('d-none');
            $('#chartVolume').addClass('d-none');

            $('#projectedCredits').removeClass('d-none');
            $('#projectedVolume').addClass('d-none');
            $(this).tab('show');
        });
    </script>

    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/ibuumerang/dashboard/projected_monthly_volume.js') }}"></script>
@endpush

@push('modals')
    @include('affiliates.partials.modals._projected_monthly_volume')
@endpush
