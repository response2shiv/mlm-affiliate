@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">    
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <div class="text-center mb-5">
                                <img src="{{asset('assets/images/tools/DYIR_dlbanner.jpg')}}" width="100%" class="responsive" alt="">
                            </div>
                            <div class="content tool-item-document text-center mt-4">
                                <div class="text-center mt-4">
                                    <h4>Use the button to download your file(s). If you purchased <br> more than one copy, the button will remain active until all <br> of your copies have been downloaded.</h4>
                                </div>
                            </div>
                            <div class="content tool-item-document text-center justify-content-center">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    @include('components.affiliates.spinners.wave')
                                </div>
                                <div class="mt-4">
                                    <p>Please only click once per download. Download speed will depend on your connection and may take a few minutes</p>
                                     
                                    <a href="#" id="downloadPerformed" class="btn btn-primary col-xl-2 col-lg-3 col-md-4 col-sm-6  {{$remaining < 1 ? 'disabled' : ''}}">Download Files</a>
                                    <h4 class="mt-3 mb-5" id="remaining">Downloads remaining: {{$remaining}}</h4>

                                    <h4 class="mt-3 mb-5" id="new_remaining">Downloads remaining: </h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // alert("Ready");
            hideLoading();
            $('#new_remaining').hide();

        });
        $('#downloadPerformed').click(function() {

            $.ajax({
                url : '{{route('affiliates.tools.downloadPerformed')}}',
                type : 'GET',
                beforeSend : function(){
                    showLoading();
                    $('#downloadPerformed').addClass('disabled');
                }
            })
            .done(function(res){

                $('#remaining').hide();
                $('#new_remaining').show().html(`Downloads remaining: ${res.remaining}`);
                setTimeout(function(){ 
                    window.open(res.route);
                }, 3000);

                if(res.remaining > 0){
                    console.log(true);
                    $('#downloadPerformed').removeClass('disabled');
                }

                hideLoading();

            })
            .fail(function(jqXHR, textStatus, res){
                alert(res);
                hideLoading();
            });      
        })
    </script>
@endpush