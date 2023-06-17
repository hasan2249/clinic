@extends('backend.layouts.app')

@section('title', app_name() .' | ' . ' سجل المصروف')

@section('breadcrumb-links')
@include('backend.costs.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row light-blue">
            <div class="col-sm-5">
                <h3 class="card-title m-2">
                    سجل المصاريف
                </h3>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="costs-table" class="table" data-ajax_url="{{ route("admin.costs.get") }}">
                        <thead>
                            <tr>

                                <th>value</th>
                                <th>name</th>
                                <th>note</th>
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
        FTX.Costs.list.init();
    });
</script>
@endsection