@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5><i class="fa fa-file-word-o"></i> Documents</h5>
                </div>
                <div class="ibox-content">
                    @foreach ($response->documents as $document)
                        <div class="row">
                            <div class="col-lg-1">
                                <img src="{{asset('assets/images/media_file_ext/doc.svg')}}" alt="">
                            </div>
                            <div class="col-lg-10">
                                <span class="tools-file-text">{{$document->display_name}}</span>
                            </div>
                            <div class="col-lg-1">
                                <a target="_blank" href="{{Storage::url('media_files/'.$document->file_name)}}"><i class="fa fa-download"></i></a>
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
