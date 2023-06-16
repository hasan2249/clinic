<?php
Breadcrumbs::for('admin.Patients.index', function ($trail) {
    $trail->push(__('labels.backend.access.pages.management'), route('admin.Patients.index'));
});

Breadcrumbs::for('admin.Patients.create', function ($trail) {
    $trail->parent('admin.Patients.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.Patients.create'));
});

Breadcrumbs::for('admin.Patients.edit', function ($trail, $id) {
    $trail->parent('admin.Patients.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.Patients.edit', $id));
});

Breadcrumbs::for('admin.patient.create.session', function ($trail, $patient_id) {
    $trail->push('Title Here', route('admin.patient.create.session', $patient_id));
});
