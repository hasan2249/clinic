@extends('backend.layouts.app')

@section('title', app_name() .' | ' . ' سجل المرضى')

@section('breadcrumb-links')
@include('backend.Patients.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row light-blue">
            <div class="col-sm-5">
                <h3 class="card-title m-2">
                    سجل المرضى
                </h3>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="Patients-table" class="table" data-ajax_url="{{ route("admin.Patients.get") }}">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الموبايل</th>
                                <th>العمر</th>
                                <th>العنوان</th>
                                <th>تاريخ</th>
                                <th>الاجراءات</th>
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
        FTX.Patients.list.init();
    });
</script>
@endsection