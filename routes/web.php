<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn() => view('welcome'))->name('home');

Route::resource('master-data', MasterDataController::class);
Route::get('/instock', [MasterDataController::class, 'instock'])->name('master-data.instock');

Route::get('/car-filter', [MasterDataController::class, 'filter'])->name('car.filter.results');
Route::post('/import', [MasterDataController::class, 'import'])->name('master-data.import');
Route::get('/export', [MasterDataController::class, 'export'])->name('master-data.export');
Route::post('/destroy-all', [MasterDataController::class, 'destroyAll'])->name('master-data.destroyAll');
Route::get('/master-Data', [MasterDataController::class, 'indexfilter'])->name('indexfilter');