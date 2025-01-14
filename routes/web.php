<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CcisController;
use App\Exports\NilaiOcaiExport;
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('/', [CcisController::class, 'ocaiindex'])->name('ocai.index')->middleware('auth');
Route::get('/ccis', [CcisController::class, 'index'])->name('ccis');
Route::get('/ocai', [CcisController::class, 'index'])->name('ocai');
Route::get('/kategori', [CcisController::class, 'indexkategori'])->name('kategori.index');
Route::post('/kategori', [CcisController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [CcisController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [CcisController::class, 'update'])->name('kategori.update');
Route::delete('/deletekategori', [CcisController::class, 'destroy'])->name('kategori.destroy');
Route::get('/title', [CcisController::class, 'indextitle'])->name('title.index');
Route::post('/title', [CcisController::class, 'storetitle'])->name('title.store');
Route::get('/title/{id}/edit', [CcisController::class, 'edittitle'])->name('title.edit');
Route::put('/titleupdate', [CcisController::class, 'updatetitle'])->name('title.update');
Route::delete('/deletetitle', [CcisController::class, 'destroytitle'])->name('title.destroy');
Route::post('/ocai-store', [CcisController::class, 'ocaistore'])->name('ocai.store');
Route::delete('/nilai-ocai', [CcisController::class, 'ocaidestroy'])->name('ocai.destroy');
Route::get('/exportocai', [CcisController::class, 'exportocai'])->name('export.ocai');



