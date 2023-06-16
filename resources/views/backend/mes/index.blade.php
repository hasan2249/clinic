@extends('backend.layouts.app')

@section('title', app_name() .' | ' . ' البيانات الشخصية')

@section('breadcrumb-links')
@include('backend.mes.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h3 class="card-title mb-0">بياناتي
                </h3>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="mes-table" class="table" data-ajax_url="{{ route("admin.mes.get") }}">
                        <thead>
                            <tr>

                                <th>name</th>
                                <th>phone</th>
                                <th>logo</th>
                                <th>address</th>
                                <th>{{ trans('labels.backend.access.pages.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->

    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection

@section('pagescript')
<script>
    FTX.Utils.documentReady(function() {
        FTX.Mes.list.init();
    });
</script>
@endsection