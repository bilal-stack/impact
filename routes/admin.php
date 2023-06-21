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
            'index' => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index' => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');

    Route::name('admin.')->prefix('admin/categories')->group(function () {
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

    Route::name('admin.')->prefix('admin/variations')->group(function () {
        Route::get('create', [\App\Http\Controllers\Variations\VariationsController::class, 'create'])->name('variations.create');
        Route::post('store', [\App\Http\Controllers\Variations\VariationsController::class, 'store'])->name('variations.store');
        Route::get('index', [\App\Http\Controllers\Variations\VariationsController::class, 'index'])->name('variations.list');
        Route::get('/{variation}/edit', [\App\Http\Controllers\Variations\VariationsController::class, 'edit'])->name('variations.edit');
        Route::put('/{variation}/update', [\App\Http\Controllers\Variations\VariationsController::class, 'update'])->name('variations.update');

        Route::name('variations.sizes.')->prefix('sizes')->group(function () {
            Route::get('create', [\App\Http\Controllers\Variations\SizeController::class, 'create'])->name('create');
            Route::post('store', [\App\Http\Controllers\Variations\SizeController::class, 'store'])->name('store');
            Route::get('index', [\App\Http\Controllers\Variations\SizeController::class, 'index'])->name('list');
            Route::get('/{id}/edit', [\App\Http\Controllers\Variations\SizeController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [\App\Http\Controllers\Variations\SizeController::class, 'update'])->name('update');
        });
    });

    Route::name('admin.')->prefix('admin/products')->group(function () {
        Route::get('index', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.list');
        Route::get('create', [\App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
        Route::post('store', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');

//        Variations
        Route::get('attach-variations/{product}', [\App\Http\Controllers\ProductController::class, 'attachVariations'])->name('products.variations.attach');
        Route::post('store-variations/{product}', [\App\Http\Controllers\ProductController::class, 'storeVariations'])->name('products.variations.store');
        Route::get('variations/{product}', [\App\Http\Controllers\ProductController::class, 'productVariations'])->name('products.variations.list');
        Route::get('attach-variations-sizes/{product}/{variation}', [\App\Http\Controllers\ProductController::class, 'attachVariationSizes'])->name('products.variations.sizes.attach');
        Route::post('store-variations-sizes/{product}/{variation}', [\App\Http\Controllers\ProductController::class, 'storeVariationsSizes'])->name('products.variations.sizes.store');
    });

});