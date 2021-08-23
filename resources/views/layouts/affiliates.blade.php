@extends('layouts.main')

@push('styles')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/affiliates.css') }}" rel="stylesheet">
@endpush

@include('affiliates.topbar')

@include('affiliates.sidebar')

@include('affiliates.footer')
