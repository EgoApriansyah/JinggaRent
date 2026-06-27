<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PakasirWebhookController;

Route::post('/pakasir/webhook', [PakasirWebhookController::class, 'handle']);
