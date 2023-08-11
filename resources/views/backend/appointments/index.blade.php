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
                <div class="row">
                    <div class="col-1">
                        <input type="radio" id="all" value="0" name="date" checked />
                        <label for="all">الكل</label>
                    </div>
                    <div class="col-1">
                        <input type="radio" id="today" value="1" name="date" />
                        <label for="today">اليوم</label>
                    </div>
                    <div class="col-1">
                        <input type="radio" id="tomorrow" value="2" name="date" />
                        <label for="tomorrow">غدا</label>
                    </div>
                </div>
                <br />
                <div class="table-responsive">
                    <table id="appointments-table" class="table" data-ajax_url="{{ route("admin.appointments.get") }}">
                        <thead>
                            <tr>
                                <th>وقت الموعد</th>
                                <th>المدة (دقيقة)</th>
                                <th>المريض</th>
                                <th>ملاحظة</th>
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

        $('input[name="date"]').on('change', function(e) {
            let com = $('input[name="date"]:checked').val();
            console.log(com);
            $("#appointments-table").dataTable().fnDestroy();
            FTX.Appointments.list.init(com);
        });

    });
</script>
@endsection