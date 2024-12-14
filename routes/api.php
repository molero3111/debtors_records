<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrationController;
use App\Models\Debtor;

Route::post('/migratedata', [MigrationController::class, 'migrate']);

Route::get('/debtors', function (Request $request) {
    $debtors = Debtor::all();
    return response()->json(['debtors' => $debtors]);
});
