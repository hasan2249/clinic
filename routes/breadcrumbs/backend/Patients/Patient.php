<?php
Breadcrumbs::for('admin.Patients.index', function ($trail) {
    $trail->push('المرضى', route('admin.Patients.index'));
});

Breadcrumbs::for('admin.Patients.create', function ($trail) {
    $trail->parent('admin.Patients.index');
    $trail->push('انشاء سجل لمريض جديد', route('admin.Patients.create'));
});

Breadcrumbs::for('admin.Patients.edit', function ($trail, $id) {
    $trail->parent('admin.Patients.index');
    $trail->push('تعديل معلومات المريض', route('admin.Patients.edit', $id));
});

Breadcrumbs::for('admin.patient.create.session', function ($trail, $patient_id) {
    $trail->push('انشاء جلسة', route('admin.patient.create.session', $patient_id));
});
