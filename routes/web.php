<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/invoice/pdf/{sale}', [InvoiceController::class, 'index'])->name('sale.invoice.pdf');

Route::get('/test/translate', [InvoiceController::class, 'text']);

Route::get('/', function () {
    return view('welcome');
});
