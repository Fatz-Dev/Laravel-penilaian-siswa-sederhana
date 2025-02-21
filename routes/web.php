<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\NilaiController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/siswa', [SiswaController::class, 'index'])->middleware('auth');


//menampilkan form tambah data siswa
Route::get('/siswa/create', [SiswaController::class, 'create'])->middleware('auth');
Route::post('/siswa', [SiswaController::class, 'store'])->middleware('auth');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->middleware('auth');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->middleware('auth');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->middleware('auth');


//untuk
Route::get('nilai', [NilaiController::class, 'index'])->middleware('auth');
Route::post('nilai', [NilaiController::class, 'store'])->middleware('auth');


