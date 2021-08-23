@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5><i class="fa fa-file-video-o"></i> Videos</h5>
                </div>
                <div class="ibox-content">
                    @foreach ($response->videos as $video)
                        <div class="row">
                            <div class="col-lg-1">
                                <img src="{{asset('assets/images/media_file_ext/doc.svg')}}" alt="">
                            </div>
                            <div class="col-lg-10">
                                <span class="tools-file-text">{{$video->display_name}}</span>
                            </div>
                            <div class="col-lg-1">
                                <a target="_blank" href="{{Storage::url('media_files/'.$video->file_name)}}"><i class="fa fa-download"></i></a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
