<div class="card-body">
<div class="row">
    <div class="col-sm-5">
        <h4 class="card-title mb-0">
            {{ __('labels.backend.access.pages.management') }}
            <small class="text-muted">{{ (isset($page)) ? __('labels.backend.access.pages.edit') : __('labels.backend.access.pages.create') }}</small>
        </h4>
    </div>
    <!--col-->
</div>
<!--row-->

<hr>

<div class="row mt-4 mb-4">
    <div class="col">
        
<div class="form-group row">
        {{ Form::label("date", "date", ['class' => 'col-md-2 from-control-label required']) }}

        <div class="col-md-10">
<input type="datetime"  name="date" value="{{isset($session)?$session->date:''}}" \>

        </div>
        <!--col-->
        </div>
        <!--form-group-->

<div class="form-group row">
        {{ Form::label("treatment_area", "treatment_area", ['class' => 'col-md-2 from-control-label required']) }}

        <div class="col-md-10">
            {{ Form::text('treatment_area', null, ['class' => 'form-control', 'placeholder' => '']) }}
        </div>
        <!--col-->
        </div>
        <!--form-group-->

<div class="form-group row">
        {{ Form::label("spot_size", "spot_size", ['class' => 'col-md-2 from-control-label required']) }}

        <div class="col-md-10">
            {{ Form::number('spot_size', null, ['class' => 'form-control', 'placeholder' => '']) }}
        </div>
        <!--col-->
        </div>
        <!--form-group-->

<div class="form-group row">
        {{ Form::label("fluence", "fluence", ['class' => 'col-md-2 from-control-label required']) }}

        <div class="col-md-10">
            {{ Form::number('fluence', null, ['class' => 'form-control', 'placeholder' => '']) }}
        </div>
        <!--col-->
        </div>
        <!--form-group-->

<div class="form-group row">
        {{ Form::label("pluse_width", "pluse_width", ['class' => 'col-md-2 from-control-label required']) }}

        <div class="col-md-10">
            {{ Form::number('pluse_width', null, ['class' => 'form-control', 'placeholder' => '']) }}
        </div>
        <!--col-->
        </div>
        <!--form-group-->

<div class="form-group row">
        {{ Form::label("count", "count", ['class' => 'col-md-2 from-control-label required']) }}

        <div class="col-md-10">
            {{ Form::number('count', null, ['class' => 'form-control', 'placeholder' => '']) }}
        </div>
        <!--col-->
        </div>
        <!--form-group-->

<div class="form-group row">
        {{ Form::label("price", "price", ['class' => 'col-md-2 from-control-label required']) }}

        <div class="col-md-10">
            {{ Form::number('price', null, ['class' => 'form-control', 'placeholder' => '']) }}
        </div>
        <!--col-->
        </div>
        <!--form-group-->

<div class="form-group row">
            {{ Form::label("note", "note", ['class' => 'col-md-2 from-control-label required']) }}

            <div class="col-md-10">
                {{ Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => '']) }}
            </div>
            <!--col-->
            </div>
            <!--form-group-->
<div class="form-group row">
        {{ Form::label("patient_id", "patient_id", ['class' => 'col-md-2 from-control-label required']) }}

        <div class="col-md-10">
            {{ Form::text('patient_id', null, ['class' => 'form-control', 'placeholder' => '']) }}
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
