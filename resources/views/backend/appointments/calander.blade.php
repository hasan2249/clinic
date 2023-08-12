@extends('backend.layouts.app')

@section('title', app_name() .' | ' . ' سجل المواعيد')

@section('breadcrumb-links')
@include('backend.appointments.includes.breadcrumb-links')
@endsection

<script>
    var SITEURL = "{{ url('/') }}";
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            slotMinTime: '8:00:00', //first time
            slotMaxTime: '20:00:00', //last time
            firstDay: 6, // start from saturday
            allDaySlot: false, // remove all day slot
            selectable: true,
            editable: true,
            droppable: true,
            hiddenDays: [5], // remove friday from calander
            slotDuration: "00:10", // minimal interval is 10 minutes
            direction: "rtl",
            locale: "ar",
            headerToolbar: {
                left: "prev,next",
                center: "title",
                right: "timeGridWeek,timeGridDay", // user can switch between the two
            },
            events: SITEURL + "/admin/getApponinmtmentForCalander",
            drop: function(event) {
                toastr.warning('<h3>العملية قيد الانجاز', '', {
                    timeOut: 2000,
                    progressBar: true,
                    positionClass: "toast-top-left"
                });
                let patient_id = $("#draggable-el").attr("data-id");
                var url = SITEURL + '/admin/appointments/storeFromCalander';
                console.log(url);
                $.ajax({
                    method: "POST",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        start_date: event.dateStr,
                        patient_id: patient_id
                    },
                    success: function(msg) {
                        toastr.success('<h3>تم اضافة موعد بنجاح</h3>', '<h1>اضافة الموعد</h1>', {
                            timeOut: 4000,
                            progressBar: true,
                            positionClass: "toast-top-left"
                        });
                        console.log(event);
                        var event = calendar.getEventById(patient_id + "_");
                        event.setProp('id', msg.id);
                    },
                    error: function(msg) {
                        toastr.error('<h3>لم يتم اضافة موعد</h3>', '<h1>حدثت مشكلة</h1>', {
                            timeOut: 4000,
                            progressBar: true,
                            positionClass: "toast-top-left"
                        });
                    },
                });
            },
            eventResize: function(event) {
                toastr.warning('<h3>العملية قيد الانجاز</h3>', '', {
                    timeOut: 2000,
                    progressBar: true,
                    positionClass: "toast-top-left"
                });
                console.log(event.event.start.toLocaleString());
                var ID = event.event.id;
                var url = SITEURL + '/admin/appointments/updateAppointmentFromCalander/' + ID;
                console.log(url);

                $.ajax({
                    method: "POST",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        start_date: event.event.start.toLocaleString(),
                        end_date: event.event.end.toLocaleString(),
                        _method: "PATCH"
                    },
                    success: function(msg) {
                        toastr.success('<h3>تم تعديل الموعد بنجاح</h3>', '<h1>تعديل الموعد</h1>', {
                            timeOut: 4000,
                            progressBar: true,
                            positionClass: "toast-top-left"
                        });
                    },
                    error: function(msg) {
                        toastr.error('<h3>لم يتم تعديل الموعد</h3>', '<h1>حدثت مشكلة</h1>', {
                            timeOut: 4000,
                            progressBar: true,
                            positionClass: "toast-top-left"
                        });
                    },
                });
            },
            eventDrop: function(event) {
                toastr.warning('العملية قيد الانجاز', '', {
                    timeOut: 2000,
                    progressBar: true,
                    positionClass: "toast-top-left"
                });
                console.log(event.event.start.toLocaleString());
                var ID = event.event.id;
                var url = SITEURL + '/admin/appointments/updateAppointmentFromCalander/' + ID;
                console.log(url);
                $.ajax({
                    method: "POST",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        start_date: event.event.start.toLocaleString(),
                        end_date: event.event.end.toLocaleString(),
                        _method: "PATCH"
                    },
                    success: function(msg) {
                        toastr.success('<h3>تم تعديل الموعد بنجاح</h3>', '<h1>تعديل الموعد</h1>', {
                            timeOut: 4000,
                            progressBar: true,
                            positionClass: "toast-top-left"
                        });
                    },
                    error: function(msg) {
                        toastr.error('<h3>لم يتم تعديل الموعد</h3>', '<h1>حدثت مشكلة</h1>', {
                            timeOut: 4000,
                            progressBar: true,
                            positionClass: "toast-top-left"
                        });
                    },
                });
            },
            eventClick: function(event) {
                var deleteMsg = confirm("هل تريد حذف الموعد؟");
                toastr.warning('العملية قيد الانجاز', '', {
                    timeOut: 2000,
                    progressBar: true,
                    positionClass: "toast-top-left"
                });
                if (deleteMsg) {
                    event.event.remove();
                    var ID = event.event.id;
                    var url = SITEURL + '/admin/appointments/' + ID;
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            id: event.id,
                            _method: "delete"
                        },
                        success: function(msg) {
                            toastr.success('<h3>تم الحذف بنجاح</h3>', '<h1>الحذف</h1>', {
                                timeOut: 4000,
                                progressBar: true,
                                positionClass: "toast-top-left"
                            });
                        },
                        error: function(msg) {
                            toastr.error('<h3>لم يتم حذف الموعد</h3>', '<h1>حدثت مشكلة</h1>', {
                                timeOut: 4000,
                                progressBar: true,
                                positionClass: "toast-top-left"
                            });
                        },
                    });
                }
            }
        });
        calendar.render();

        var draggableEl = document.getElementById("draggable-el");
        new FullCalendar.Draggable(draggableEl);
    });
</script>

@section('content')
<div class="row">
    <div class="col-2">
        <div class="form-group">
            <div class="col mb-2 mx-auto hand fixedElement">
                <div id="draggable-el" data-id="" data-event='{ "id":"o", "title": "my event", "duration": "00:15" }'>
                </div>
            </div>
            <input type="text" class="form-control" name="search" id="search" placeholder="الموبايل او الاسم">
            <div id="loading" class="spinner-border hidden" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div id="patient"></div>
        </div>
    </div>
    <div class="col-10">
        <div style="background-color: white;" id="calendar"></div>
    </div>
</div>
@endsection