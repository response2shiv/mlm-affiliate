    <!-- CASH COW -->
    <div class="ibox border-bottom">
        <div class="ibox-title">            
            <a class="widget-title text-dark"><h5>ADVANCED TRAINING</h5></a>
            <p class="widget-title-small">Requires prior level completion</p>
            <div class="ibox-tools">
                @if(!$order)
                    <i class="fa fa-lock fa-3x mr-2 text-dark"></i>
                @else
                    <a class="collapse-link">
                        <i class="fa fa-chevron-down fa-3x"></i>
                    </a>
                @endif
            </div>
        </div>
            @if($order)            
        <div class="ibox-content collapsed" style="display: none;">

            <div class="row">

            @foreach($videos['advanced'] as $video)
                    <div class="col-lg-4">                        
                            <div class="ibox-content p-0">
                            @if($order)
                                <figure>
                                    <iframe src="{{$video['url']}}" frameborder="0" allowfullscreen="" data-aspectratio="0.8211764705882353" class="embed-responsive"></iframe>
                                </figure>
                            @else
                                <img src="{{ asset('assets/images/lock.jpeg') }}" class="img-thumbnail no-borders">
                                <h3>You don't have access to this video.</h3>
                            @endif
                                <h3 class="mt-1 video-title">{{$video['title']}}</h3>
                            </div>
                    </div>
                @endforeach      
            </div>

        </div>
        @endif
    </div>