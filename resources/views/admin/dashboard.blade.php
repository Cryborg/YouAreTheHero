@extends('layout')

@section('title', 'Stories list')

@section('content')

    {{ $header ?: trans('admin.title') }}
    {{ $description ?: trans('admin.title') }}
@endsection

