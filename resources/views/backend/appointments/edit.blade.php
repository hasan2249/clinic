@extends('backend.layouts.app')

@section('title', __('labels.backend.access.pages.management') . ' | ' . __('labels.backend.access.pages.edit'))

@section('breadcrumb-links')
    @include('backend.appointments.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($appointment, ['route' => ['admin.appointments.update', $appointment], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.appointments.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.appointments.index', 'id' => $appointment->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
