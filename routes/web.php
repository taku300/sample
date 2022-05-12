<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    
    // Route::get('/hello', [HelloController::class, 'index']);
    Route::get('/add_type/{id}', [RegistrationController::class, 'addTypeForm'])->name('add.type');
    Route::post('/add_type/{id}', [RegistrationController::class, 'addType'])->name('add.type');
    Route::get('/', [DisplayController::class, 'index']);
    Route::get('/{date}/{next}', [DisplayController::class, 'indexIink'])->name('index');
    Route::get('/create_income', [RegistrationController::class, 'createIncomeForm'])->name('create.income');
    Route::post('/create_income', [RegistrationController::class, 'createIncome'])->name('create.income');
    Route::get('/create_spend', [RegistrationController::class, 'createSpendForm'])->name('create.spend');
    Route::post('/create_spend', [RegistrationController::class, 'createSpend'])->name('create.spend');
    
    Route::group(['middleware' => 'can:view,spending'], function(){
        Route::get('/spend/{spending}/detail', [DisplayController::class, 'spendDetail'])->name('spend.detail');
        Route::get('/edit_form/spend/{spending}', [RegistrationController::class, 'editSpendForm'])->name('edit.spend');
        Route::post('/edit_form/spend/{spending}', [RegistrationController::class, 'editSpend'])->name('edit.spend');
        Route::get('/delete/spend/{spending}', [RegistrationController::class, 'deleteSpend'])->name('delete.spend');
        Route::get('/logical/spend/{spending}', [RegistrationController::class, 'logicalDeleteSpend'])->name('logical.delete.spend');
    });
    
    Route::group(['middleware' => 'can:view,income'], function(){
        Route::get('/income/{income}/detail', [DisplayController::class, 'incomeDetail'])->name('income.detail');
        Route::get('/edit_form/income/{income}', [RegistrationController::class, 'editIncomeForm'])->name('edit.income');
        Route::post('/edit_form/income/{income}', [RegistrationController::class, 'editIncome'])->name('edit.income');
        Route::get('/delete/income/{income}', [RegistrationController::class, 'deleteIncome'])->name('delete.income');
        Route::get('/logical/income/{income}', [RegistrationController::class, 'logicalDeleteIncome'])->name('logical.delete.income');
    });

    
});