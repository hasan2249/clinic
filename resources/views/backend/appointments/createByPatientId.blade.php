@extends('backend.layouts.app')

@section('title', app_name() .' | ' . 'انشاء موعد')

@section('breadcrumb-links')
@include('backend.appointments.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.appointments.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    انشاء موعد جديدة للسيد/ة: {{$patient_name}}
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">

                <div class="form-group row">
                    {{ Form::label("start_date", "التاريخ البدء", ['class' => 'col-md-2 from-control-label required']) }}

                    <div class="col-md-10">
                        <input type="datetime-local" name="start_date" value="{{isset($appointment)?$appointment->start_date:''}}" \>

                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label("end_date", "المدة", ['class' => 'col-md-2 from-control-label required']) }}

                    <div class="col-md-10">
                        <input type="number" name="end_date" value="{{isset($appointment)?$appointment->end_date:''}}" \>

                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                {{ Form::text('patient_id', $patient_id, ['class' => 'form-control hidden', 'placeholder' => '']) }}

                <div class="form-group row">
                    {{ Form::label("note", "ملاحظة", ['class' => 'col-md-2 from-control-label required']) }}

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
    @include('backend.components.footer-buttons', ['cancelRoute' => 'admin.appointments.index'])
</div><!--card-->

{{ Form::close() }}
@endsection