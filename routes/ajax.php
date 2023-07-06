<?php

use Illuminate\Support\Facades\Route;

Route::prefix('ajax')->name('ajax.')->group(function () {
    //categories related routes
    Route::get('get-category/{category}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getCategories'])->name('get.category');
    Route::get('get-sub-categories/{category}', [\App\Http\Controllers\Ajax\AjaxController::class, 'getSubCategories'])->name('get.sub.category');

    //Cat related routes
    Route::post('cat-media-store/', [\App\Http\Controllers\Ajax\AjaxController::class, 'storeCatMedia'])->name('cat.media.store');
    Route::get('cat-media-delete/', [\App\Http\Controllers\Ajax\AjaxController::class, 'deleteCatMedia'])->name('cat.media.delete');
    Route::post('cat-media-remove/', [\App\Http\Controllers\Ajax\AjaxController::class, 'removeTmpCatMedia'])->name('cat.media.remove');

    //Variations related routes
    Route::post('var-media-store/', [\App\Http\Controllers\Ajax\AjaxController::class, 'storeVariationMedia'])->name('variation.media.store');
    Route::post('var-media-remove/', [\App\Http\Controllers\Ajax\AjaxController::class, 'removeVariationMedia'])->name('variation.media.remove');
    Route::get('get-variations', [\App\Http\Controllers\Ajax\AjaxController::class, 'getVariations'])->name('get.variations');

    //Product media related routes
    Route::post('product-media-store/', [\App\Http\Controllers\Ajax\AjaxController::class, 'storeProductMedia'])->name('product.media.store');
    Route::post('product-media-remove/', [\App\Http\Controllers\Ajax\AjaxController::class, 'removeTmpProductMedia'])->name('product.media.remove');

    //Variations Sizes related routes
    Route::get('get-sizes', [\App\Http\Controllers\Ajax\AjaxController::class, 'getVariationSizes'])->name('get.variation.sizes');

    //Variation Styles
    Route::get('get-variations-styles', [\App\Http\Controllers\Ajax\AjaxController::class, 'getVariationStyles'])->name('get.variations.style');

    // users settings
    Route::prefix('setting')->name('settings.')->group(function () {
        Route::post('update', [\App\Http\Controllers\Ajax\AjaxController::class, 'updateSettings'])->name('update');
    });

    //web ajax routes
    //get product & variation sizes & styles with image & price
    Route::get('get-product-variation-sizes-styles/{product}/{variation_id}', [\App\Http\Controllers\Front\ProductController::class, 'productVariationSizesStyles'])->name('get.product.variation.sizes.styles');
    Route::get('get-product-variation-styles/{product}/{variation_id}/{size_id}', [\App\Http\Controllers\Front\ProductController::class, 'productVariationStyles'])->name('get.product.variation.styles');
    Route::get('get-product-variation-styles-data/{product}/{variation_id}/{size_id}/{style_id}', [\App\Http\Controllers\Front\ProductController::class, 'productVariationStylesData'])->name('get.product.variation.styles.data');

});