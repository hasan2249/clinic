<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h3 class="card-title mb-0">{{ (isset($appointment)) ?  'تعديل موعد':'انشاء موعد جديد'}}
            </h3>
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

            <div class="form-group row">
                {{ Form::label("patient_id", "المريض", ['class' => 'col-md-2 from-control-label hidden required']) }}

                <div class="col-md-10">
                    {{ Form::text('patient_id', null, ['class' => 'form-control hidden', 'placeholder' => '']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

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