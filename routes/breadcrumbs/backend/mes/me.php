<?php
Breadcrumbs::for('admin.mes.index', function ($trail) {
    $trail->push(__('labels.backend.access.pages.management'), route('admin.mes.index'));
});

Breadcrumbs::for('admin.mes.create', function ($trail) {
    $trail->parent('admin.mes.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.mes.create'));
});

Breadcrumbs::for('admin.mes.edit', function ($trail, $id) {
    $trail->parent('admin.mes.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.mes.edit', $id));
});
