<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.mybox.charge.show', function ($trail) {
    $trail->push('شحن الصندوق', route('admin.mybox.charge.show'));
});

Breadcrumbs::for('admin.backup.db', function ($trail) {
    $trail->push('النسخ الاحتياطي', route('admin.backup.db'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
require __DIR__.'/auth/permission.php';
require __DIR__.'/Patients/Patient.php';
require __DIR__.'/Appointments/appointment.php';
require __DIR__.'/Sessions/session.php';
