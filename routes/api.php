<?php

use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;

Route::post('/get-quote', [DeliveryController::class, 'getQuote'])->name('api.get-quote');
