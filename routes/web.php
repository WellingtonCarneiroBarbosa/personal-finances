<?php

use App\Http\Controllers\App\Expenses\ExpenseCategoryController;
use App\Http\Controllers\App\Expenses\ExpenseController;
use App\Http\Controllers\App\Incomes\IncomeController;
use App\Http\Controllers\App\Workspaces\WorkspaceController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\User\Settings;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', Dashboard::class)->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::get('/user/settings', Settings::class)->name('settings.show');

        Route::resource('workspaces', WorkspaceController::class);
        Route::put('workspaces/current/{workspace}', [WorkspaceController::class, 'updateCurrent'])->name('workspaces.update-current');

        Route::resource('expense-categories', ExpenseCategoryController::class);
        Route::resource('expenses', ExpenseController::class);
        Route::resource('incomes', IncomeController::class);
    });
