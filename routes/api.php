<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransWebhookController;

Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle']);
