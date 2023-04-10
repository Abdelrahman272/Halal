@extends('admin.layouts.master')

@section('title')
    Location
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endsection

@section('title_page1')
    Location
@endsection

@section('title_page2')
    Location
@endsection


@section('content')
    {{-- <iframe src="https://www.google.com/maps/embed/v1/view?key=API_KEY{{$locationsString}} width="640" height="480"></iframe> --}}


    <iframe width="600" height="450" frameborder="0" style="border:0"
        src="https://www.google.com/maps/embed/v1/place?q={{urlencode($locationsString)}}" allowfullscreen>
    </iframe>
@endsection

@section('scripts')
@endsection
