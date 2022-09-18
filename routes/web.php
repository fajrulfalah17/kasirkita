<?php

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

// route home
Route::get('/', function() {
    return \Inertia\Inertia::render('Auth/Login');
})->middleware('guest');

// prefix "apps"
Route::prefix('apps')->group(function() {
    // midleware auth
    Route::group(['middleware' => ['auth']], function() {
        // route dashboard
        Route::get('dashboard', App\Http\Controllers\Apps\DashboardController::class)->name('apps.dashboard');

        // route permissions
        Route::get('/permissions', App\Http\Controllers\Apps\PermissionController::class)->name('apps.permissions.index')->middleware('permission:permissions.index');

        // route resource roles
        Route::resource('/roles', App\Http\Controllers\Apps\RoleController::class, ['as' => 'apps'])->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');

        // route resource users
        Route::resource('/users', App\Http\Controllers\Apps\UserController::class, ['as' => 'apps'])->middleware('permission:users.index|users.create|users.edit|users.delete');

         // route resource types
        Route::resource('/types', App\Http\Controllers\Apps\TypeController::class, ['as' => 'apps'])->middleware('permission:types.index|types.create|types.edit|types.delete');

        // route resource categories
        Route::resource('/categories', App\Http\Controllers\Apps\CategoryController::class, ['as' => 'apps'])->middleware('permission:categories.index|categories.create|categories.edit|categories.delete');

        // route resource products
        Route::resource('/products', App\Http\Controllers\Apps\ProductController::class, ['as' => 'apps'])->middleware('permission:products.index|products.create|products.edit|products.delete');

        // route resource customers
        Route::resource('/customers', App\Http\Controllers\Apps\CustomerController::class, ['as' => 'apps'])->middleware('permission:customers.index|customers.create|customers.edit|customers.delete');

        // route transaction
        Route::get('/transactions', [\App\Http\Controllers\Apps\TransactionController::class, 'index'])->name('apps.transactions.index');

        // route transaction searchProduct
        Route::post('/transactions/searchProduct', [\App\Http\Controllers\Apps\TransactionController::class, 'searchProduct'])->name('apps.transactions.searchProduct');

        // route transaction addToCart
        Route::post('/transactions/addToCart', [\App\Http\Controllers\Apps\TransactionController::class, 'addToCart'])->name('apps.transactions.addToCart');

        // route transaction destroyCart
        Route::post('/transactions/destroyCart', [\App\Http\Controllers\Apps\TransactionController::class, 'destroyCart'])->name('apps.transactions.destroyCart');

        // route transaction store
        Route::post('/transactions/store', [\App\Http\Controllers\Apps\TransactionController::class, 'store'])->name('apps.transactions.store');

        // route transaction print
        Route::get('/transactions/print', [\App\Http\Controllers\Apps\TransactionController::class, 'print'])->name('apps.transactions.print');

        Route::get('/sales', [\App\Http\Controllers\Apps\SaleController::class, 'index'])->middleware('permission:sales.index')->name('apps.sales.index');

        Route::delete('/transactions/{transaction}', [\App\Http\Controllers\Apps\SaleController::class, 'destroy'])->name('apps.transaction.delete');

        Route::get('/sales/filter', [\App\Http\Controllers\Apps\SaleController::class, 'filter'])->name('apps.sales.filter');
    
        Route::get('/sales/export', [\App\Http\Controllers\Apps\SaleController::class, 'export'])->name('apps.sales.export');

        Route::get('/sales/pdf', [\App\Http\Controllers\Apps\SaleController::class, 'pdf'])->name('apps.sales.pdf');
    });
});