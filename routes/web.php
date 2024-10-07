<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\CcisController;
<<<<<<< HEAD
=======


>>>>>>> e10d5d9a037c4314d5c8a398cab2c44409d24ebf
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
Route::get('/ccis', [CcisController::class, 'index'])->name('ccis');

Route::get('/ocai', [CcisController::class, 'index'])->name('ccis');
Route::get('/kategori', [CcisController::class, 'indexkategori'])->name('kategori.index');
Route::post('/kategori', [CcisController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [CcisController::class, 'edit'])->name('kategori.edit'); 
Route::put('/kategori/{id}', [CcisController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [CcisController::class, 'destroy'])->name('kategori.destroy');
Route::get('/title', [CcisController::class, 'indextitle'])->name('title.index');
Route::post('/title', [CcisController::class, 'storetitle'])->name('title.store');
Route::get('/title/{id}/edit', [CcisController::class, 'edittitle'])->name('title.edit'); 
Route::put('/title/{id}', [CcisController::class, 'updatetitle'])->name('title.update');
Route::delete('/title/{id}', [CcisController::class, 'destroytitle'])->name('title.destroy');
Route::post('/ocai-store', [CcisController::class, 'ocaistore'])->name('ocai.store');
Route::get('/ocai-index', [CcisController::class, 'ocaiindex'])->name('ocai.index');


