<?php

// Costs Management
Route::group(['namespace' => 'Costs'], function () {
    Route::resource('costs', 'CostsController', ['except' => ['show']]);

    //For DataTables
    Route::post('costs/get', 'CostsTableController')->name('costs.get');
});