<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\ExpenseCategoryExpensesController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\WorkspaceController;
use App\Http\Controllers\Api\WorkspaceExpenseCategoriesController;
use App\Http\Controllers\Api\WorkspaceExpensesController;
use App\Http\Controllers\Api\WorkspaceUsersController;
use App\Http\Controllers\Api\WorkspaceWorkspaceUsersController;
use Illuminate\Http\Request;
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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('workspaces', WorkspaceController::class);

        // Workspace Expense Categories
        Route::get('/workspaces/{workspace}/expense-categories', [
            WorkspaceExpenseCategoriesController::class,
            'index',
        ])->name('workspaces.expense-categories.index');
        Route::post('/workspaces/{workspace}/expense-categories', [
            WorkspaceExpenseCategoriesController::class,
            'store',
        ])->name('workspaces.expense-categories.store');

        // Workspace Workspace Users
        Route::get('/workspaces/{workspace}/workspace-users', [
            WorkspaceWorkspaceUsersController::class,
            'index',
        ])->name('workspaces.workspace-users.index');
        Route::post('/workspaces/{workspace}/workspace-users', [
            WorkspaceWorkspaceUsersController::class,
            'store',
        ])->name('workspaces.workspace-users.store');

        // Workspace Expenses
        Route::get('/workspaces/{workspace}/expenses', [
            WorkspaceExpensesController::class,
            'index',
        ])->name('workspaces.expenses.index');
        Route::post('/workspaces/{workspace}/expenses', [
            WorkspaceExpensesController::class,
            'store',
        ])->name('workspaces.expenses.store');

        // Workspace Users
        Route::get('/workspaces/{workspace}/users', [
            WorkspaceUsersController::class,
            'index',
        ])->name('workspaces.users.index');
        Route::post('/workspaces/{workspace}/users', [
            WorkspaceUsersController::class,
            'store',
        ])->name('workspaces.users.store');

        Route::apiResource(
            'expense-categories',
            ExpenseCategoryController::class
        );

        // ExpenseCategory Expenses
        Route::get('/expense-categories/{expenseCategory}/expenses', [
            ExpenseCategoryExpensesController::class,
            'index',
        ])->name('expense-categories.expenses.index');
        Route::post('/expense-categories/{expenseCategory}/expenses', [
            ExpenseCategoryExpensesController::class,
            'store',
        ])->name('expense-categories.expenses.store');

        Route::apiResource('expenses', ExpenseController::class);
    });
