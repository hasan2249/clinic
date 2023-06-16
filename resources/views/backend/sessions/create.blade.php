@extends('backend.layouts.app')

@section('title', app_name() .' | ' . ' انشاء جلسة')

@section('breadcrumb-links')
@include('backend.sessions.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.sessions.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

<div class="card">
    @include('backend.sessions.form')
    @include('backend.components.footer-buttons', ['cancelRoute' => 'admin.sessions.index'])
</div><!--card-->

{{ Form::close() }}
@endsection