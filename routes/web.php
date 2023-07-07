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
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    Route::get('/', 'Front\HomeController@index')->name('welcome');
    Route::get('/terms', 'TermsController@terms')->name('terms');
    Route::get('/faqs',  [App\Http\Controllers\Front\HomeController::class, 'faqs'])->name('faqs');
    Route::get('/about-us',  [App\Http\Controllers\Front\HomeController::class, 'about'])->name('about.us');
    Route::get('/contact-us', [App\Http\Controllers\Front\HomeController::class, 'contact'])->name('contact.us');
    Route::get('/shop', [\App\Http\Controllers\Front\HomeController::class, 'shop'])->name('shop');
    Route::get('/shop/{category}', [\App\Http\Controllers\Front\ProductController::class, 'index'])->name('shop.category.product');
    Route::get('/shop/{category}/{product}', [\App\Http\Controllers\Front\ProductController::class, 'show'])->name('shop.category.product.show');

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Front\CartController::class, 'cartList'])->name('list');
        Route::post('/', [\App\Http\Controllers\Front\CartController::class, 'addToCart'])->name('store');
        Route::post('/update-cart', [\App\Http\Controllers\Front\CartController::class, 'updateCart'])->name('update');
        Route::post('/remove', [\App\Http\Controllers\Front\CartController::class, 'removeCart'])->name('remove');
        Route::get('/clear', [\App\Http\Controllers\Front\CartController::class, 'clearAllCart'])->name('clear');
    });

    Route::prefix('order')->name('order.')->group(function () {
        Route::post('/store', [\App\Http\Controllers\Front\OrderController::class, 'store'])->name('store');
        Route::get('/checkout', [\App\Http\Controllers\Front\OrderController::class, 'checkout'])->name('checkout');
        Route::get('/thankyou/{order}', [\App\Http\Controllers\Front\OrderController::class, 'thankyou'])->name('thankyou');
        Route::get('/failed/{order}', [\App\Http\Controllers\Front\OrderController::class, 'failed'])->name('failed');
    });
});

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});

// Registered, activated, and is current logged in user routes.
include 'user.php';

// Registered, activated, and is admin routes.
include 'admin.php';

//ajax requests routes
include 'ajax.php';

Route::redirect('/php', '/phpinfo', 301);
