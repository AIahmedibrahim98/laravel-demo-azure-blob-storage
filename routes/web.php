<?php

use App\Http\Controllers\AzureBlobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/azure', [AzureBlobController::class, 'index'])->name('azure.index');
Route::post('/azure/upload', [AzureBlobController::class, 'upload'])->name('azure.upload');
Route::get('/azure/download/{file}', [AzureBlobController::class, 'download'])->name('azure.download');
Route::delete('/azure/delete/{file}', [AzureBlobController::class, 'delete'])->name('azure.delete');

