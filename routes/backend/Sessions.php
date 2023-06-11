<?php

// Sessions Management
Route::group(['namespace' => 'Sessions'], function () {
    Route::resource('sessions', 'SessionsController', ['except' => ['show']]);

    //For DataTables
    Route::post('sessions/get', 'SessionsTableController')->name('sessions.get');
});