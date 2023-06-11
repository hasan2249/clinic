@extends('backend.layouts.app')

@section('title', __('labels.backend.access.pages.management') . ' | ' . __('labels.backend.access.pages.edit'))

@section('breadcrumb-links')
    @include('backend.sessions.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($session, ['route' => ['admin.sessions.update', $session], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.sessions.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.sessions.index', 'id' => $session->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
