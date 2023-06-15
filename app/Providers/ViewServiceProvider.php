<?php

namespace App\Providers;

use App\View\Composers\NavCategoryComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //front categories on home & nav
        View::composer('front.layouts.partials.header', NavCategoryComposer::class);
    }
}
