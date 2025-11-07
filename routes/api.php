<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('calcular_finiquito_api',[App\Http\Controllers\FiniquitoController::class,'calcularFiniquito'])->name('calcular_finiquito_api');
Route::get('/pdf_calculo_finiquito_api/{finiquito_id}', [App\Http\Controllers\FiniquitoController::class, 'pdfCalculoFiniquito']);
