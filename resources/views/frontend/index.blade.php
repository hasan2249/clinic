@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<div class="text-center">
    <h1>{{app_name()}}</h1>
</div>
@endsection