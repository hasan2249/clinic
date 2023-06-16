<div class="card-body">
    <div class="row light-yellow">
        <div class="col-sm-5">
            <h3 class="card-title m-2">
                حسابي
            </h3>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <div class="row mt-4 mb-4">
        <div class="col">

            <div class="form-group row">
                {{ Form::label("name", "name", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => '']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label("phone", "phone", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => '']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label("logo", "logo", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('logo', null, ['class' => 'form-control', 'placeholder' => '']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
            <div class="form-group row">
                {{ Form::label("address", "address", ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => '']) }}
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