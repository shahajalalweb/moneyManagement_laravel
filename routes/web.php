<?php

use App\Http\Controllers\budget;
use App\Http\Controllers\CostController;
use App\Http\Controllers\OverviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| OVERVIEW controling 
|--------------------------------------------------------------------------
*/

Route::get('/', [OverviewController::class,'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| budget controling 
|--------------------------------------------------------------------------
*/

Route::get('/budget', [budget::class,'index'])->name('budget');

Route::post('/budget/create', [budget::class,'store'])->name('createBudget');

Route::get('/budget/edit/{id}', [budget::class,'edit'])->name('budgetEdit');

Route::put('/budget/update/{id}', [budget::class,'update'])->name('budgetUpdate');

Route::get('/budget/delete/{id}', [budget::class,'destroy'])->name('budgetDel');

/*
|--------------------------------------------------------------------------
| COST controling 
|--------------------------------------------------------------------------
*/

Route::get('/cost', [CostController::class,'index'])->name('cost');

Route::post('/cost/create', [CostController::class,'store'])->name('costCreate');

Route::get('/cost/edit/{id}', [CostController::class,'edit'])->name('costEdit');

Route::put('/cost/update/{id}', [CostController::class,'update'])->name('costUpdate');

Route::get('/cost/delete/{id}', [CostController::class,'destroy'])->name('costDel');

 
