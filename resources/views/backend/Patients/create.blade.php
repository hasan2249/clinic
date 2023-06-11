@extends('backend.layouts.app')

@section('title', __('labels.backend.access.pages.management') . ' | ' . __('labels.backend.access.pages.create'))

@section('breadcrumb-links')
    @include('backend.Patients.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.Patients.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.Patients.form')
        @include('backend.components.footer-buttons', ['cancelRoute' => 'admin.Patients.index'])
    </div><!--card-->
    {{ Form::close() }}
@endsection
