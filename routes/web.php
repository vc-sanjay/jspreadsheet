<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CsvFileUploadController;


Route::get('/csv/{fileName?}', function($fileName) {

    return view('csv', compact('fileName'));
});

Route::get('/json/{fileName?}', function($fileName) {

    return view('json', compact('fileName'));
});


Route::get('/', [CsvFileUploadController::class, 'csvFileUpload'])->name('spreadsheet.csv');
Route::post('store', [CsvFileUploadController::class, 'store'])->name('spreadsheet.csv.store');
Route::post('test-store', [CsvFileUploadController::class, 'testStore'])->name('test.store');

