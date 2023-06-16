<?php

// Sessions Management
Route::group(['namespace' => 'Sessions'], function () {
    Route::resource('sessions', 'SessionsController', ['except' => ['show']]);

    Route::get('sessions/patient/{patient_id}', 'SessionsController@getPatientSessionView')->name('sessions.patient.view');
    Route::post('sessions/patient', 'SessionsController@getPatientSessionById')->name('sessions.patient.index');
    Route::get('sessions/create/{patient_id}', 'SessionsController@createPatientSessionView')->name('patient.create.session');

    //For DataTables
    Route::post('sessions/get', 'SessionsTableController')->name('sessions.get');
});
