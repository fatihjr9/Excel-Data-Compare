<?php

use App\Http\Controllers\DataCompareController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DataCompareController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/preview', [DataCompareController::class, 'preview'])->name('dashboard.preview');
    Route::post('/dashboard/download/{fileName}', [DataCompareController::class, 'downloadMergedData'])->name('dashboard.download');
});
