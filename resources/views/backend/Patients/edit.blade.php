@extends('backend.layouts.app')

@section('title', __('labels.backend.access.pages.management') . ' | ' . __('labels.backend.access.pages.edit'))

@section('breadcrumb-links')
    @include('backend.Patients.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($Patient, ['route' => ['admin.Patients.update', $Patient], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.Patients.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.Patients.index', 'id' => $Patient->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
