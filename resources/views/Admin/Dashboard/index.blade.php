@extends('Admin.Layouts.master')
@section('title')
    Dashboard
@endsection
@section('breadcrumb_header')
    Dashboard
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/')}}/app-assets/fonts/simple-line-icons/style.min.css">

@endsection
@section('scripts')
@endsection
@section('content')
    <div class="row">
        welcome {{ \Illuminate\Support\Facades\Auth::user()->name }}
    </div>
@endsection
