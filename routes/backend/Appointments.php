<?php

// Appointments Management
Route::group(['namespace' => 'Appointments'], function () {
    Route::resource('appointments', 'AppointmentsController', ['except' => ['show']]);

    Route::get('appointments/patient/{patient_id}', 'AppointmentsController@getPatientAppointmentView')->name('appointments.patient.view');
    Route::post('appointments/patient', 'AppointmentsController@getPatientAppointmentById')->name('appointments.patient.index');
    Route::get('appointments/create/{patient_id}', 'AppointmentsController@createPatientAppointmentView')->name('patient.create.appointment');

    Route::get('appointments/calander', 'AppointmentsController@getAppointmentCalanderView')->name('appointments.calander.view');
    Route::get('getApponinmtmentForCalander', 'AppointmentsController@getApponinmtmentForCalander');
    Route::patch('appointments/updateAppointmentFromCalander/{appointment}', 'AppointmentsController@updateFromCalander');
    Route::post('appointments/storeFromCalander', 'AppointmentsController@storeFromCalander');

    //For DataTables
    Route::post('appointments/get', 'AppointmentsTableController')->name('appointments.get');
});
