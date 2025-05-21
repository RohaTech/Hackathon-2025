<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\AllowanceValueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\InvoiceController;
 
use App\Http\Controllers\PayrollVariableController;
 
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/employees', EmployeeController::class);
Route::apiResource('/accounts', AccountController::class);
Route::apiResource('/payrollvariable', PayrollVariableController::class);
Route::apiResource('/allowances', AllowanceController::class);
Route::apiResource('/allowancesValue', AllowanceValueController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/users/export', [UsersController::class, 'export']);
 
Route::get('/invoice', [InvoiceController::class, 'showinvoice'])->name('invoice');
Route::get('/browsepdf', [InvoiceController::class, 'pdfinbrowser'])->name('browsepdf');
Route::get('/downloadepdf', [InvoiceController::class, 'downloadpdf'])->name('downloadpdf');


 
