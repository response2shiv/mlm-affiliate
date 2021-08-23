@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn pb-0 pb-md-0">
    <div class="row">
        <div class="col-lg-12">
            <img src="{{ asset('images/forex-training-banner.png') }}" width="100%" class="responsive">
        </div>
    </div>
    
    <!-- <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content text-center">
                        <p class="mt-4" style="font-size: 1.44em">&bull; 6 HOURS OF SOLID TRAINING TO START</p>
                        <p style="font-size: 1.44em">&bull; Mr. Holton Buggs and Mr. Edwin Haynes<br>and all of the Blue Diamonds from Xccelerate</p>
                        <p style="font-size: 1.44em">&bull; Hours of new trainings will be added every month</p>
                        <p style="font-size: 1.44em">&bull; Private Access to the CEO Secret Vault of Trainings</p>
                        <p style="font-size: 1.44em">&bull; Regular $99 per month - Special Price of $19.95 per month</p> <br />

                        <button id="btnPurchaseTraining" class="btn btn-outline btn-success">BUY NOW</button>
                        <h2 class="pt-4" style="font-size: 1.2em; color: red; font-weight: bold"><s>Reg $99/mo</s></h2>
                        <h2 class="shiny-new-price">NOW $19.95/mo</h2>
                        <p>First 6 months are Free</p>               
                </div>
            </div>
        </div>
    </div> -->
    
</div>

<div class="wrapper wrapper-content animated fadeIn pb-0 pb-md-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins widget-rank-insights">
                <div class="ibox-title widget-rounded-border-top">        
                    <div class="col-xl-12 border-bottom-title">
                        <div class="row">                            
                            <div class="ibumm-widget-title">LIVE SESSIONS</div>                            
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12 d-flex flex-row justify-space-around">
                            <a href="{{url('/tools/live-sessions/new-york') }}" class="btn btn-primary">New York Session (9AM)</a>
                            <a href="{{url('/tools/live-sessions/hfx') }}" class="btn btn-primary ml-2">HFX Session (9PM)</a>
                            <a href="{{url('/tools/live-sessions/sidney') }}" class="btn btn-primary ml-2">Sidney Session (8PM)</a>
                            <a href="{{url('/tools/live-sessions/london') }}" class="btn btn-primary ml-2">London Session (2AM)</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe src="{{$session['session']}}" 
                                    frameborder="0" 
                                    allow="autoplay; fullscreen" 
                                    allowfullscreen 
                                    style="width:100%;height:100%;">
                                </iframe>
                            </div>
                            
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <iframe src="{{ $session['chat'] }}" width="100%" height="100%" frameborder="0"></iframe>                            
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

