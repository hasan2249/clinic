@extends('backend.layouts.app')

@section('title', app_name() . ' | ' .'جلسات السيد/ة: ' .$name)

@section('breadcrumb-links')
@include('backend.sessions.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    <small>جلسات السيد/ة:</small> {{$name}}
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="sessions-table" class="table" data-patient_id={{$patient_id}} data-ajax_url="{{ route("admin.sessions.patient.index") }}">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Treatment Area</th>
                                <th>Spot Size</th>
                                <th>Fluence</th>
                                <th>Pluse Width</th>
                                <th>Count</th>
                                <th>Price</th>
                                <th>Note</th>
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
        FTX.Sessions.list.init();
    });
</script>
@endsection