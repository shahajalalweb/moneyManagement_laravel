<?php

use App\Http\Controllers\Account;
use App\Http\Controllers\budget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CostCategoryController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SettingsController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| OVERVIEW controling 
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/', [OverviewController::class, 'index'])
        ->name('dashboard');

    Route::post('logout', function (Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    })->name('logout');

    // account controlling 

    Route::get('/account', [Account::class, 'account'])->name('account');
    Route::get('/account/changePassword', [Account::class, 'changePassword'])->name('changePassword');
    Route::post('/account/changePass', [PasswordController::class, 'changePassword'])->name('changePass');

    Route::get('/account/editProfile', [Account::class, 'editProfile'])->name('editProfile');
    Route::post('/account/updateProfile', [Account::class, 'updateProfile'])->name('updateProfile');




    /*
    |--------------------------------------------------------------------------
    | budget controling 
    |--------------------------------------------------------------------------
    */

    Route::get('/budget', [BudgetController::class, 'index'])->name('budget');

    Route::post('/budget/create', [BudgetController::class, 'store'])->name('createBudget');

    Route::get('/budget/edit/{id}', [BudgetController::class, 'edit'])->name('budgetEdit');

    Route::put('/budget/update/{id}', [BudgetController::class, 'update'])->name('budgetUpdate');

    Route::get('/budget/delete/{id}', [BudgetController::class, 'destroy'])->name('budgetDel');

    /*
    |--------------------------------------------------------------------------
    | COST controling 
    |--------------------------------------------------------------------------
    */

    Route::get('/category', [CostCategoryController::class, 'index'])->name('category');
    Route::post('/cost-category/create', [CostCategoryController::class, 'store'])->name('cost-category.create');
    Route::get('/cost-category/delete/{id}', [CostCategoryController::class, 'destroy'])->name('cost-category.delete');


    /*
    |--------------------------------------------------------------------------
    | COST controling 
    |--------------------------------------------------------------------------
    */

    Route::get('/cost', [CostController::class, 'index'])->name('cost');

    Route::post('/cost/create', [CostController::class, 'store'])->name('costCreate');

    Route::get('/cost/edit/{id}', [CostController::class, 'edit'])->name('costEdit');

    Route::put('/cost/update/{id}', [CostController::class, 'update'])->name('costUpdate');

    Route::get('/cost/delete/{id}', [CostController::class, 'destroy'])->name('costDel');



    /*
    |--------------------------------------------------------------------------
    | Settings controling 
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'store'])->name('settingsStore');
    // Route::get('/settings/{id}', [SettingsController::class, 'destroy'])->name('settingsDel');

    
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'loginStore'])->name('loginStore');
    Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('/register', [AuthenticationController::class, 'registerStore'])->name('registerStore');
});
