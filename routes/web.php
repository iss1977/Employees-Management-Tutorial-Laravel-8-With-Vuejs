<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Ajax\StatesAjaxController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\ChangePasswordController;
use App\Http\Controllers\Backend\DepartmentController;
use Illuminate\Support\Facades\Auth; // used to hide vscode error. Not necesarry



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    /** Users */
    Route::resource('users',UserController::class);
    Route::post('users/{user}/change-password', [ChangePasswordController::class,'changePassword'])->name('users.change.password');

    /** Countries */
    Route::resource('countries', CountryController::class);

    /** States */
    Route::resource('states', StateController::class);

    /** Cities */
    Route::resource('cities', CityController::class);

    /** Departments */
    Route::resource('departments', DepartmentController::class);

});

    /** Ajax Requests */
    /** State list of country */
    Route::post('statesofcountry', [StatesAjaxController::class, 'ajaxGetStatesOfCountry'])->name('statesofcountry');



    /** Api Routes */
    Route::get('{any}', function(){
        return view('employees.index');
    })->where('{any}','.*');
