<?php

use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('finance-entry')->group(function () {
    Route::get('testreturn', [FinanceController::class, 'testReturn']);
    Route::post('', [FinanceController::class, 'createEntry']);
    Route::get('/', [FinanceController::class, 'getAllEntries']);
    Route::get('/calculate-balance', [FinanceController::class, 'calculateBalance']);
    Route::get('/expenses-summary', [FinanceController::class, 'expensesSummary']);
    Route::get('/{id}', [FinanceController::class, 'readEntry']);
    Route::patch('/{id}', [FinanceController::class, 'updateEntry']);
    Route::delete('/{id}', [FinanceController::class, 'deleteEntry']);
});
