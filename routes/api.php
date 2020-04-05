<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ResourceController;
use App\Http\Controllers\API\DepartmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('App\\Http\\Controllers\\API\\')->group(function () {
    Route::get('users/{user}/calendar', 'CalendarController@userCal')
        ->name('calendar.user')->middleware('auth.basic.once');
    Route::get('groups/{group}/calendar', 'CalendarController@groupCal')
        ->name('calendar.group')->middleware('auth.basic.once');
    Route::get('{resource}/{id}', 'ResourceController@show')
        ->name('resources.show')->middleware('auth.basic.once');
});
