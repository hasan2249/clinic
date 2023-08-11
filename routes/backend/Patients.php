<?php

// Patients Management
Route::group(['namespace' => 'Patients'], function () {
    Route::resource('Patients', 'PatientsController', ['except' => ['show']]);
    Route::get('patient/search/{patient}', 'PatientsController@retrieveListByPatientName');

    //For DataTables
    Route::post('Patients/get', 'PatientsTableController')->name('Patients.get');
});
