<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Artisan;

/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    include_route_files(__DIR__ . '/frontend/');
});


/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     * These routes can not be hit if the password is expired
     */

    include_route_files(__DIR__ . '/backend/');

    Route::get('/backup/db', function () {

        try {
            // cd.. : to back one step from public folder to root 
            $out = shell_exec('cd .. && php artisan backup:run --only-db --disable-notifications');
            $errorMsg = ' ';
        } catch (Exception $e) {
            $errorMsg = 'Caught exception: ' .  $e->getMessage();
            return Redirect::back()->with('flash_success', $errorMsg);
        }
        return Redirect::back()->with('flash_success', 'تم اخذ النسخة الاحتياطية بنجاح' . '<br/>' . $out);
    })->name('take.db.backup');

    Route::get('/upgrade', function () {

        try {
            // cd.. : to back one step from public folder to root 
            $out = shell_exec('cd .. && git fetch --all && git pull');
            $errorMsg = ' ';
        } catch (Exception $e) {
            $errorMsg = 'Caught exception: ' .  $e->getMessage();
            return Redirect::back()->with('flash_success', $errorMsg);
        }
        return Redirect::back()->with('flash_success', 'تم التحديث بنجاح' . '<br/>' . $out);
    })->name('upgrade');

    Route::get('/backup', function () {
        return view('backend.backup.index');
    })->name('backup.db');
});
