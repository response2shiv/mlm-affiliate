@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">    
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h1 style="color: #007bff; font-weight: bold">DOCUMENT LIBRARY</h1>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="text-center">
                                <a href="{{ route('affiliates.tools.presentations') }}">
                                    <img src="{{asset('assets/images/tools/presentations.jpg')}}" alt="">
                                </a>
                            </div>
                            <div class="content tool-item-document text-center">
                                <div class="">
                                    <a href="{{ route('affiliates.tools.presentations') }}" class="tool-link-document">    
                                        <h2 class="tool-card-title pt-3">PRESENTATIONS</h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="text-center">
                                <a href="{{ route('affiliates.tools.documents') }}">
                                    <img src="{{asset('assets/images/tools/docs.jpg')}}" alt="">
                                </a>
                            </div>
                            <div class="content tool-item-document text-center">
                                <div class="">    
                                    <a href="{{ route('affiliates.tools.documents') }}" class="tool-link-document">
                                        <h2 class="tool-card-title pt-3">DOCUMENTS</h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="text-center">
                                <a href="{{ route('affiliates.tools.social') }}">
                                    <img src="{{asset('assets/images/tools/social.jpg')}}" alt="">
                                </a>
                            </div>
                            <div class="content tool-item-document text-center">
                                <div class="">    
                                    <a href="{{ route('affiliates.tools.social') }}" class="tool-link-document">
                                        <h2 class="tool-card-title pt-3">SOCIAL</h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="text-center">
                                <a href="{{ route('affiliates.tools.medias') }}">
                                    <img src="{{asset('assets/images/tools/media.jpg')}}" alt="">
                                </a>
                            </div>
                            <div class="content tool-item-document text-center">
                                <div class="">    
                                    <a href="{{ route('affiliates.tools.medias') }}" class="tool-link-document">
                                        <h2 class="tool-card-title pt-3">MEDIA</h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    //SECOND ROW
                    /*
                        <div class="ibox-title">
                            <h1 style="color: #007bff; font-weight: bold">LATEST UPLOADS</h1>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-3 mt-3 text-center">
                                    <div class="">
                                        <img src="{{asset('assets/images/tools/social_templates.png')}}" alt="">
                                    </div>
                                    <div class="content tool-item-uploads">
                                        <div>    
                                            <h2 class="tool-card-title">SOCIAL TEMPLATES</h2>
                                            <hr>
                                        </div>
                                        <div class="tool-list-uploads">
                                            <ul class="unstyled">
                                                <li>TO BE USED DURING</li>
                                                <li>RECOGNITION &</li>
                                                <li>RANK PROMOTION</li>
                                            </ul>
                                        </div>
                                        <div class="tool-btn-download-uploads">
                                            <button type="button" class="btn btn-outline btn-success">DOWNLOAD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <div class="text-center">
                                        <img src="{{asset('assets/images/tools/good_party_presentations.png')}}" alt="">
                                    </div>
                                    <div class="content tool-item-uploads text-center">
                                        <div>    
                                            <h2 class="tool-card-title"># GOOD PARTY PRESENTATIONS</h2>
                                            <hr>
                                        </div>
                                        <div class="tool-list-uploads">
                                            <ul class="unstyled">
                                                <li>TO BE USED DURING</li>
                                                <li>RECOGNITION &</li>
                                                <li>RANK PROMOTION</li>
                                            </ul>
                                        </div>
                                        <div class="text-center tool-btn-download-uploads">
                                            <button type="button" class="btn btn-outline btn-success">DOWNLOAD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <div class="text-center">
                                       <img src="{{asset('assets/images/tools/recognition_slides.png')}}" alt="">
                                    </div>
                                    <div class="content tool-item-uploads text-center">
                                        <div class="tool-div-title">    
                                            <h2 class="tool-card-title">RECOGNITION SLIDES</h2>
                                            <hr>
                                        </div>
                                        <div class="tool-list-uploads">
                                            <ul class="unstyled">
                                                <li>TO BE USED DURING</li>
                                                <li>RECOGNITION &</li>
                                                <li>RANK PROMOTION</li>
                                            </ul>
                                        </div>
                                        <div class="text-center tool-btn-download-uploads">
                                            <button type="button" class="btn btn-outline btn-success">DOWNLOAD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <div class="text-center">
                                        <img src="{{asset('assets/images/tools/flightschool_recaaps.png')}}" alt="">
                                    </div>
                                    <div class="content tool-item-uploads text-center">
                                        <div>    
                                            <h2 class="tool-card-title">FLIGHTSCHOOL RECAPS</h2>
                                            <hr>
                                        </div>
                                        <div class="tool-list-uploads">
                                            <ul class="unstyled">
                                                <li>TO BE USED DURING</li>
                                                <li>RECOGNITION &</li>
                                                <li>RANK PROMOTION</li>
                                            </ul>
                                        </div>
                                        <div class="text-center tool-btn-download-uploads">
                                            <button type="button" class="btn btn-outline btn-success">DOWNLOAD</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    */
                @endphp
            </div>
        </div>      
    </div>
</div>
@endsection

@push('scripts')
@endpush