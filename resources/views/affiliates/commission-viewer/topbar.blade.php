<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-5 col-xl-3">
                        <a href="{{route('commission')}}">
                            <h3 class="title-bar-item-{{ Request::url() == url('/commission') ? 'active' : 'disabled' }}">
                                <i class="fa fa-line-chart fa-2x"></i> 
                                <span class="ml-2 commissions-icon-label">COMMISSIONS</span>
                            </h3>
                        </a>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3">
                        <a href="{{route('commission-historical')}}">
                            <h3 class="title-bar-item-{{ Request::url() == url('/commission/historical') ? 'active' : 'disabled' }}">
                                <i class="fa fa-dashboard fa-2x"></i> 
                                <span class="ml-2 commissions-icon-label">VOLUME</span>
                            </h3> 
                        </a>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
                        <a href="#" {{$found1099 == true ? 'id=pdfButton' : ''}} >
                            <h3 class="title-bar-item-{{$found1099 == true ? 'active' : 'disabled'}}">
                                <i class="fa fa-files-o fa-2x"></i> 
                                <span class="ml-2 commissions-icon-label">TAX DOCS</span>
                            </h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>