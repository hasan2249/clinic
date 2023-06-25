<?php
Breadcrumbs::for('admin.mes.index', function ($trail) {
    $trail->push("حسابي", route('admin.mes.index'));
});

Breadcrumbs::for('admin.mes.create', function ($trail) {
    $trail->parent('admin.mes.index');
    $trail->push("انشاء حساب", route('admin.mes.create'));
});

Breadcrumbs::for('admin.mes.edit', function ($trail, $id) {
    $trail->parent('admin.mes.index');
    $trail->push("تعديل بيانات حسابي", route('admin.mes.edit', $id));
});
