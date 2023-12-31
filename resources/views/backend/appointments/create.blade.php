@extends('backend.layouts.app')

@section('title', app_name() .' | ' . 'انشاء موعد')

@section('breadcrumb-links')
@include('backend.appointments.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.appointments.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

<div class="card">
    @include('backend.appointments.form')
    @include('backend.components.footer-buttons', ['cancelRoute' => 'admin.appointments.index'])
</div><!--card-->
{{ Form::close() }}
@endsection