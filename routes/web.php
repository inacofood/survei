<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;

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

// Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('/register', 'Auth\RegisterController@register');



Route::get('/login', 'AuthController@showLoginForm')->name('login');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout')->name('logout');


Route::get('/', [ListController::class, 'index'])->name('list.index')->middleware('auth');
Route::get('/subcategory-options', [ListController::class, 'getOptions']);
Route::post('/update-data', 'ListController@updateData')->name('update');
Route::post('/add-new-module', 'InputController@addNewModule')->name('add');
Route::post('/import-from-excel', 'InputController@importFromExcel')->name('import');
Route::get('/export-list-links', 'ListController@export')->name('export');
Route::get('/get-modal-data', 'ListController@getModalData');
Route::delete('/delete/{id}', 'ListController@deleteData')->name('delete');
Route::get('/download', 'InputController@Download');

