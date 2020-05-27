@extends('errors.illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
{{-- @section('message', __($exception->getMessage() ?: 'Service Unavailable')) --}}
@section('message', __('Maintenance mode, be right back!'))
