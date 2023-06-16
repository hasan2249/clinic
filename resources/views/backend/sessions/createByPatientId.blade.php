@extends('backend.layouts.app')

@section('title', app_name() .' | ' . ' انشاء جلسة')

@section('breadcrumb-links')
@include('backend.sessions.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.sessions.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    انشاء جلسة جديدة للسيد/ة: {{$patient_name}}
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">

                {{ Form::text('patient_id', $patient_id, ['class' => 'form-control hidden', 'placeholder' => '']) }}

                <div class="form-group row">
                    {{ Form::label("treatment_area", "Treatment Area", ['class' => 'col-md-2 from-control-label required']) }}

                    <div class="col-md-2">
                        {{ Form::text('treatment_area', null, ['class' => 'form-control', 'placeholder' => '']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label("spot_size", "Spot Size", ['class' => 'col-md-2 from-control-label required']) }}

                    <div class="col-md-2">
                        {{ Form::number('spot_size', null, ['class' => 'form-control', 'placeholder' => '']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label("fluence", "Fluence", ['class' => 'col-md-2 from-control-label required']) }}

                    <div class="col-md-2">
                        {{ Form::number('fluence', null, ['class' => 'form-control', 'placeholder' => '']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label("pluse_width", "Pluse Width", ['class' => 'col-md-2 from-control-label required']) }}

                    <div class="col-md-2">
                        {{ Form::number('pluse_width', null, ['class' => 'form-control', 'placeholder' => '']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label("count", "Count", ['class' => 'col-md-2 from-control-label required']) }}

                    <div class="col-md-2">
                        {{ Form::number('count', null, ['class' => 'form-control', 'placeholder' => '']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label("price", "Price", ['class' => 'col-md-2 from-control-label required']) }}

                    <div class="col-md-2">
                        {{ Form::number('price', null, ['class' => 'form-control', 'placeholder' => '']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label("note", "Note", ['class' => 'col-md-2 from-control-label required']) }}

                    <div class="col-md-10">
                        {{ Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => '']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->

    @section('pagescript')
    <script type="text/javascript">
        FTX.Utils.documentReady(function() {
            FTX.Pages.edit.init("{{ config('locale.languages.' . app()->getLocale())[1] }}");
        });
    </script>
    @stop
    @include('backend.components.footer-buttons', ['cancelRoute' => 'admin.sessions.index'])
</div><!--card-->

{{ Form::close() }}
@endsection