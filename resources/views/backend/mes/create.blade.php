@extends('backend.layouts.app')

@section('title', app_name() .' | ' . ' البيانات الشخصية')

@section('breadcrumb-links')
@include('backend.mes.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.mes.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

<div class="card">
    @include('backend.mes.form')
    @include('backend.components.footer-buttons', ['cancelRoute' => 'admin.mes.index'])
</div><!--card-->
{{ Form::close() }}
@endsection