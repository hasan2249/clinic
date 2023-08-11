<?php
Breadcrumbs::for('admin.appointments.index', function ($trail) {
    $trail->push('ادارة المواعيد', route('admin.appointments.index'));
});

Breadcrumbs::for('admin.appointments.create', function ($trail) {
    $trail->parent('admin.appointments.index');
    $trail->push('انشاء موعد جديد', route('admin.appointments.create'));
});

Breadcrumbs::for('admin.appointments.edit', function ($trail, $id) {
    $trail->parent('admin.appointments.index');
    $trail->push('تعديل الموعد', route('admin.appointments.edit', $id));
});

Breadcrumbs::for('admin.appointments.patient.view', function ($trail, $patient_id) {
    $trail->push('الجلسات', route('admin.appointments.patient.view', $patient_id));
});

Breadcrumbs::for('admin.appointments.calander.view', function ($trail) {
    $trail->push('روزنامة المواعيد', route('admin.appointments.calander.view'));
});
