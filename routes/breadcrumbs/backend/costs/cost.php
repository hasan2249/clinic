<?php
Breadcrumbs::for('admin.costs.index', function ($trail) {
    $trail->push(__('labels.backend.access.pages.management'), route('admin.costs.index'));
});

Breadcrumbs::for('admin.costs.create', function ($trail) {
    $trail->parent('admin.costs.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.costs.create'));
});

Breadcrumbs::for('admin.costs.edit', function ($trail, $id) {
    $trail->parent('admin.costs.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.costs.edit', $id));
});
