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
