@extends('backend.layouts.app')

@section('title', __('labels.backend.access.pages.management') . ' | ' . __('labels.backend.access.pages.create'))

@section('breadcrumb-links')
    @include('backend.costs.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.costs.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.costs.form')
        @include('backend.components.footer-buttons', ['cancelRoute' => 'admin.costs.index'])
    </div><!--card-->
    {{ Form::close() }}
@endsection
