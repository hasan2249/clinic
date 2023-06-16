<?php
Breadcrumbs::for('admin.sessions.index', function ($trail) {
    $trail->push(__('labels.backend.access.pages.management'), route('admin.sessions.index'));
});

Breadcrumbs::for('admin.sessions.patient.view', function ($trail, $patient_id) {
    $trail->push(__('labels.backend.access.pages.management'), route('admin.sessions.patient.view', $patient_id));
});

Breadcrumbs::for('admin.sessions.create', function ($trail) {
    $trail->parent('admin.sessions.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.sessions.create'));
});

Breadcrumbs::for('admin.sessions.edit', function ($trail, $id) {
    $trail->parent('admin.sessions.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.sessions.edit', $id));
});
