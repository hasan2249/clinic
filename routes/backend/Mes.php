<?php

// Mes Management
Route::group(['namespace' => 'Mes'], function () {
    Route::resource('mes', 'MesController', ['except' => ['show']]);

    //For DataTables
    Route::post('mes/get', 'MesTableController')->name('mes.get');
});