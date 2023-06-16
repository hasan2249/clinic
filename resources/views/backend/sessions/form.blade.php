<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                انشاء جلسة جديدة
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">

            <div class="form-group row">
                {{ Form::label("patient_id", "patient_id", ['class' => 'col-md-2 from-control-label hidden required']) }}

                <div class="col-md-2">
                    {{ Form::text('patient_id', null, ['class' => 'form-control hidden', 'placeholder' => '']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label("date", "Date", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-2">
                    <input type="datetime-local" name="date" value="{{isset($session)?$session->date:''}}" \>

                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label("Treatment Area", "treatment_area", ['class' => 'col-md-2 from-control-label required']) }}

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