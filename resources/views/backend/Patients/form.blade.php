<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h3 class="card-title mb-0">

                {{ (isset($patient)) ? 'تعديل بيانات المريض' : 'انشاء مريض جديد' }}
            </h3>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">

            <div class="form-group row">
                {{ Form::label("name", "الاسم", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-2">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label("phone", "الهاتف", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-2">
                    {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => '']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label("birthday", "مواليد", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-2">
                    {{ Form::number('birthday', null, ['class' => 'form-control', 'placeholder' => '']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label("address", "العنوان", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-6">
                    {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => '']) }}
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