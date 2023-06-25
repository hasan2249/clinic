<?php
Breadcrumbs::for('admin.costs.index', function ($trail) {
    $trail->push('ادارة المصاريف', route('admin.costs.index'));
});

Breadcrumbs::for('admin.costs.create', function ($trail) {
    $trail->parent('admin.costs.index');
    $trail->push('اضافة مصروف', route('admin.costs.create'));
});

Breadcrumbs::for('admin.costs.edit', function ($trail, $id) {
    $trail->parent('admin.costs.index');
    $trail->push("تعديل مصروف", route('admin.costs.edit', $id));
});
