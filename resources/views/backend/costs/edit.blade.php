@extends('backend.layouts.app')

@section('title', __('labels.backend.access.pages.management') . ' | ' . __('labels.backend.access.pages.edit'))

@section('breadcrumb-links')
    @include('backend.costs.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($cost, ['route' => ['admin.costs.update', $cost], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.costs.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.costs.index', 'id' => $cost->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
