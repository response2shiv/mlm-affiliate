<div class="col-sm-6 text-center">
    @if(isset($response->error2fa) && $response->error2fa == true)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

        </div>
    @endif
</div>
<div class="col-sm-12 text-center">

    @if($response->found1099)
        <div>
            <a href="#" id="openModalSendTypePDF"><img src="{{asset('/assets/images/pdf_icon.png')}}" alt=""></a>
        </div>
        <div class="col-sm-12 text-center">
            <div>
                <h5 class="font-weight-bold">2019 1099 Form B</h5>
                <div>Your 1099 form is available for download. Click the icon and verify your identity to access your file.</div>
            </div>
        </div>
    @endif
</div>

