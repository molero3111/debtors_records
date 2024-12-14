<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrationController;
use App\Models\Debtor;

Route::post('/migratedata', [MigrationController::class, 'migrate']);

Route::delete('/cleandb', [MigrationController::class, 'cleanDatabase']);

Route::get('/debtors', function (Request $request) {
    return response()->json(['debtors' => Debtor::all()]);
});

