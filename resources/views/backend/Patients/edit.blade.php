@extends('backend.layouts.app')

@section('title', app_name() .' | ' . ' تعديل مريض')

@section('breadcrumb-links')
@include('backend.Patients.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::model($patient, ['route' => ['admin.Patients.update', $patient], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

<div class="card">
    @include('backend.Patients.form')
    @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.Patients.index', 'id' => $patient->id ])
</div><!--card-->
{{ Form::close() }}
@endsection