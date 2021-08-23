@extends('layouts.affiliates')

@section('base-content')
<div class="row">
  <div class="col-lg-6">
    <div class="wrapper wrapper-content animated fadeIn">
      <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><i class="fa fa-file-video-o"></i> Vídeos</h5>
                </div>
                <div class="ibox-content">
                  @foreach ($response->videos as $video)
                  <div class="row">
                    <div class="col-1">
                      <img src="{{asset('assets/images/media_file_ext/doc.svg')}}" alt="" width="200%">
                    </div>
                    <div class="col-10">
                      {{$video->display_name}}
                    </div>
                    <div class="col-1">
                      <a target="_blank" href="{{url('assets/media_files/'.$video->file_name)}}"><i class="fa fa-download"></i></a>
                    </div>
                  </div>
                  <hr>
                @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-12">
          <div class="ibox">
              <div class="ibox-title">
                  <h5><i class="fa fa-file-image-o"></i> Images</h5>
              </div>
              {{-- <div class="ibox-tools mr-3">
                <input type="text" class="form-control" placeholder="Search">
              </div> --}}
              <div class="ibox-content">
                <div class="row">
                  @foreach ($response->images as $image)
                    <div class="col-4">
                      {{$image->display_name}}
                      <div class="col-1">
                        <a target="_blank" href="{{url('assets/media_files/'.$image->file_name)}}"><i class="fa fa-download"></i></a>
                      </div>
                    </div> 
                  @endforeach
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="wrapper wrapper-content animated fadeIn">
      <div class="row">
        <div class="col-lg-12">
          <div class="ibox">
              <div class="ibox-title">
                  <h5><i class="fa fa-file-word-o"></i> Documents</h5>
              </div>
              {{-- <div class="ibox-tools mr-3">
                <input type="text" class="form-control" placeholder="Search">
              </div> --}}
              <div class="ibox-content">
                @foreach ($response->documents as $document)
                  <div class="row">
                    <div class="col-1">
                      <img src="{{asset('assets/images/media_file_ext/doc.svg')}}" alt="" width="200%">
                    </div>
                    <div class="col-10">
                      {{$document->display_name}}
                    </div>
                    <div class="col-1">
                      <a target="_blank" href="{{url('assets/media_files/'.$document->file_name)}}"><i class="fa fa-download"></i></a>
                    </div>
                  </div>
                  <hr>
                @endforeach
              </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="ibox">
              <div class="ibox-title">
                  <h5><i class="fa fa-file-powerpoint-o"></i> Presentations</h5>
              </div>
              <div class="ibox-content">
                @foreach ($response->presentations as $presentation)
                  <div class="row">
                    <div class="col-1">
                      <img src="{{asset('assets/images/media_file_ext/ppt.png')}}" alt="" width="200%">
                    </div>
                    <div class="col-10">
                      {{$presentation->display_name}}
                    </div>
                    <div class="col-1">
                      <a target="_blank" href="{{url('assets/media_files/'.$presentation->file_name)}}"><i class="fa fa-download"></i></a>
                    </div>
                  </div>
                  <hr>
                @endforeach
              </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
@endpush