<div class="card-body">
    <div class="row light-blue">
        <div class="col-sm-5">
            <h3 class="card-title m-2">
                اضافة مصروف
            </h3>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">

            <div class="form-group row">
                {{ Form::label("value", "القيمة", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-2">
                    {{ Form::number('value', null, ['class' => 'form-control', 'placeholder' => '']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label("name", "اسم المصروف", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-2">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) }}
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