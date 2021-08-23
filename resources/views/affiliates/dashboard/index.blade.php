@extends('layouts.affiliates')

@section('base-content')
<div class="row justify-content-center">
        {{--  @component('affiliates.widgets.top_banner',[
         'img'=> \Storage::url($promo->top_banner_img),
         'url'=> $promo->top_banner_url,
         'alt'=>'top-banner'])
        @endcomponent  --}}
        <div class="col-lg-12 my-3">
            <div class="header_image text-center">
                <img src="{{ asset('images/topbanner.jpg') }}" />
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        @include('affiliates.widgets.business_snapshot')
    </div>
    
    {{-- <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
        @include('affiliates.widgets.build_zone')
        
        <a href="{{url('/world-series')}}">
            @include('affiliates.widgets.world_series')
        </a>
        
    </div> --}}
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        @include('affiliates.widgets.bucket_details')
    </div>   
</div>

<div class="row">
    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
        @include('affiliates.widgets.social_mpact_meter')
    </div>
    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
        @include('affiliates.widgets.comissions')
    </div>
</div> 

{{-- <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        @include('affiliates.widgets.rank_insight')
    </div>
</div> --}}

{{--<div class="row mb-5">
    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
        @include('affiliates.widgets.projected_bucket_volume')
    </div>
</div>--}}

<input type="hidden" data-product-id>
@endsection

@push('scripts')
<!-- Flot -->
<script src="{{ asset('js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>

<!-- Peity -->
<script src="{{ asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('js/demo/peity-demo.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- GITTER -->
<script src="{{ asset('js/plugins/gritter/jquery.gritter.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sparkline demo data  -->
<script src="{{ asset('js/demo/sparkline-demo.js') }}"></script>

<!-- ChartJS-->
<script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>

<script>
    $(document).ready(function() {

        // let toast = $('.toast');

        // setTimeout(function() {
        //     toast.toast({
        //         delay: 5000,
        //         animation: true
        //     });
        //     toast.toast('show');

        // }, 2200);

        var data1 = [
            [0, 4],
            [1, 8],
            [2, 5],
            [3, 10],
            [4, 4],
            [5, 16],
            [6, 5],
            [7, 11],
            [8, 6],
            [9, 11],
            [10, 30],
            [11, 10],
            [12, 13],
            [13, 4],
            [14, 3],
            [15, 3],
            [16, 6]
        ];
        var data2 = [
            [0, 1],
            [1, 0],
            [2, 2],
            [3, 0],
            [4, 1],
            [5, 3],
            [6, 1],
            [7, 5],
            [8, 2],
            [9, 3],
            [10, 2],
            [11, 1],
            [12, 0],
            [13, 2],
            [14, 8],
            [15, 0],
            [16, 0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
            data1, data2
        ], {
            series: {
                lines: {
                    show: false,
                    fill: true
                },
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
                points: {
                    radius: 0,
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#d5d5d5",
                borderWidth: 1,
                color: '#d5d5d5'
            },
            colors: ["#1ab394", "#1C84C6"],
            xaxis: {},
            yaxis: {
                ticks: 4
            },
            tooltip: false
        });

        // var doughnutData = {
        //     labels: ["App", "Software", "Laptop"],
        //     datasets: [{
        //         data: [300, 50, 100],
        //         backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
        //     }]
        // };

        // var doughnutOptions = {
        //     responsive: false,
        //     legend: {
        //         display: false
        //     }
        // };

        //var ctx4 = document.getElementById("doughnutChart").getContext("2d");
        //new Chart(ctx4, {
        //    type: 'doughnut',
        //    data: doughnutData,
        //    options: doughnutOptions
        //});

        // var doughnutData = {
        //     labels: ["App", "Software", "Laptop"],
        //     datasets: [{
        //         data: [70, 27, 85],
        //         backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
        //     }]
        // };

        // var doughnutOptions = {
        //     responsive: false,
        //     legend: {
        //         display: false
        //     }
        // };

        // var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
        // new Chart(ctx4, {
        //     type: 'doughnut',
        //     data: doughnutData,
        //     options: doughnutOptions
        // });

    });

    $(window).bind("scroll", function() {
        let toast = $('.toast');
        toast.css("top", window.pageYOffset + 20);
    });

</script>
@endpush
