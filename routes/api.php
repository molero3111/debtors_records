<?php

use App\Models\TestModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::get('/helloapi', function (Request $request) {
    return response()->json(['message' => 'Hello, World!']);
});

