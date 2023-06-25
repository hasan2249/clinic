@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'سجل الجلسات')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row light-green">
            <div class="col-sm-5">
                <h3 class="card-title m-2">
                    سجل الجلسات
                </h3>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="sessions-table" class="table" data-ajax_url="{{ route("admin.sessions.get") }}">
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