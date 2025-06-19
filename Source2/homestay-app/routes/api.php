<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\MidtransCallbackController;

Route::post('/midtrans/callback', [MidtransCallbackController::class, 'receive']);
