<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[\App\Http\Controllers\OriginalController::class,'index'])->name('/');
Route::get('app_config',[\App\Http\Controllers\OriginalController::class,'appConfig'])->name('app_config');
Route::get('app_config2',[\App\Http\Controllers\OriginalController::class,'appConfig2'])->name('app_config2');
Route::any('opcion',[\App\Http\Controllers\OriginalController::class,'opcion'])->name('opcion');

Route::any('pdf_sueldos_y_salarios',[\App\Http\Controllers\PdfController::class,'pdfSueldosSalarios'])->name('pdf_sueldos_y_salarios');
Route::any('pdf_tablas_sueldos_y_salarios',[\App\Http\Controllers\PdfController::class,'pdfTablaSueldosSalarios'])->name('pdf_tablas_sueldos_y_salarios');
Route::any('pdf_ptu',[\App\Http\Controllers\PdfController::class,'pdfPtu'])->name('pdf_ptu');
Route::any('pdf_tablas_otras_r',[\App\Http\Controllers\PdfController::class,'pdfTablasOtrasR'])->name('pdf_tablas_otras_r');
Route::any('pdf_asimilados_salarios',[\App\Http\Controllers\PdfController::class,'pdfAsimiladosSalarios'])->name('pdf_asimilados_salarios');
Route::any('pdf_honorarios',[\App\Http\Controllers\PdfController::class,'pdfHonorarios'])->name('pdf_honorarios');
Route::any('pdf_impuesto_anual',[\App\Http\Controllers\PdfController::class,'pdfImpuestoAnual'])->name('pdf_impuesto_anual');
Route::any('pdf_tablas_ia',[\App\Http\Controllers\PdfController::class,'pdfTablasIa'])->name('pdf_tablas_ia');
Route::any('pdf_pdi_completo_p',[\App\Http\Controllers\PdfController::class,'pdfPdiCompletoP'])->name('pdf_pdi_completo_p');
Route::any('pdf_pdi_proyeccion_p',[\App\Http\Controllers\PdfController::class,'pdfPdiProyeccionP'])->name('pdf_pdi_proyeccion_p');
Route::any('pdf_pdi_prestadores_p',[\App\Http\Controllers\PdfController::class,'pdfPdiPrestadoresP'])->name('pdf_pdi_prestadores_p');

Route::any('contacto',[\App\Http\Controllers\OriginalController::class,'contacto'])->name('contacto');
Route::any('recomienda',[\App\Http\Controllers\OriginalController::class,'recomienda'])->name('recomienda');
//Finiquitos
Route::post('calcular_finiquito',[App\Http\Controllers\FiniquitoController::class,'calcularFiniquito'])->name('calcular_finiquito');
Route::post('pdf_calculo_finiquito',[App\Http\Controllers\FiniquitoController::class,'pdfCalculoFiniquito'])->name('pdf_calculo_finiquito');
