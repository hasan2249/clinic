<?php

// Appointments Management
Route::group(['namespace' => 'Appointments'], function () {
    Route::resource('appointments', 'AppointmentsController', ['except' => ['show']]);

    //For DataTables
    Route::post('appointments/get', 'AppointmentsTableController')->name('appointments.get');
});