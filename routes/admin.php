<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');

    Route::name('admin.')->prefix('categories')->group(function () {
        Route::get('index', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.list');
        Route::get('create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::post('store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::get('category/{category}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('category/{category}/update', [\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');


        Route::get('subcategories/index', [\App\Http\Controllers\SubCategoryController::class, 'index'])->name('sub.categories.list');
        Route::get('subcategories/create', [\App\Http\Controllers\SubCategoryController::class, 'create'])->name('sub.categories.create');
        Route::post('subcategories/store', [\App\Http\Controllers\SubCategoryController::class, 'store'])->name('sub.categories.store');
        Route::get('subcategories/{subCategory}/edit', [\App\Http\Controllers\SubCategoryController::class, 'edit'])->name('sub.categories.edit');
        Route::put('subcategories/{subCategory}/update', [\App\Http\Controllers\SubCategoryController::class, 'update'])->name('sub.categories.update');
        Route::delete('subcategories/{subCategory}', [\App\Http\Controllers\SubCategoryController::class, 'destroy'])->name('sub.categories.destroy');

    });

    Route::name('admin.')->prefix('products')->group(function () {
        Route::get('index', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.list');
    });

});