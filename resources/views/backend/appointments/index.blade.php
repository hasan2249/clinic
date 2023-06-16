@extends('backend.layouts.app')

@section('title', app_name() .' | ' . ' سجل المواعيد')

@section('breadcrumb-links')
@include('backend.appointments.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row light-red">
            <div class="col-sm-5">
                <h3 class="card-title m-2">
                    سجل المواعيد
                </h3>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="appointments-table" class="table" data-ajax_url="{{ route("admin.appointments.get") }}">
                        <thead>
                            <tr>

                                <th>date</th>
                                <th>patient_id</th>
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
        FTX.Appointments.list.init();
    });
</script>
@endsection