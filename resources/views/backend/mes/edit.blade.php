@extends('backend.layouts.app')

@section('title', app_name() .' | ' . ' تعديل البيانات الشخصية')

@section('breadcrumb-links')
@include('backend.mes.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::model($me, ['route' => ['admin.mes.update', $me], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

<div class="card">
    @include('backend.mes.form')
    @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.mes.index', 'id' => $me->id ])
</div><!--card-->
{{ Form::close() }}
@endsection