<?php
Breadcrumbs::for('admin.sessions.index', function ($trail) {
    $trail->push('الجلسات', route('admin.sessions.index'));
});

Breadcrumbs::for('admin.sessions.create', function ($trail) {
    $trail->parent('admin.sessions.index');
    $trail->push('انشاء جلسة', route('admin.sessions.create'));
});

Breadcrumbs::for('admin.sessions.edit', function ($trail, $id) {
    $trail->parent('admin.sessions.index');
    $trail->push('تعديل جلسة', route('admin.sessions.edit', $id));
});

Breadcrumbs::for('admin.sessions.patient.view', function ($trail, $patient_id) {
    $trail->push('الجلسات', route('admin.sessions.patient.view', $patient_id));
});
