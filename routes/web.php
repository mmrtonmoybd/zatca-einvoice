<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/invoice/pdf/{sale}', [InvoiceController::class, 'index'])->name('sale.invoice.pdf');

Route::get('/invoice/bannar/pdf/{sale}', [InvoiceController::class, 'index2'])->name('sale.invoice2.pdf');

Route::get('/test/translate', [InvoiceController::class, 'text']);

Route::get('/', function () {
    return view('welcome');
});


Route::get('/migration', function () {
    $exitCode = Artisan::call('migrate --force');
    // return what you want
});

Route::get('/catch', function () {
    $exitCode = Artisan::call('optimize');
    // return what you want
});

Route::get('/clear', function () {
    $exitCode = Artisan::call('optimize:clear');
    // return what you want
});