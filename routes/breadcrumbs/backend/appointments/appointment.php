<?php
Breadcrumbs::for('admin.appointments.index', function ($trail) {
    $trail->push(__('labels.backend.access.pages.management'), route('admin.appointments.index'));
});

Breadcrumbs::for('admin.appointments.create', function ($trail) {
    $trail->parent('admin.appointments.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.appointments.create'));
});

Breadcrumbs::for('admin.appointments.edit', function ($trail, $id) {
    $trail->parent('admin.appointments.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.appointments.edit', $id));
});
