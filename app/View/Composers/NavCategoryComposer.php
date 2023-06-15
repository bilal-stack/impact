<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class NavCategoryComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('navCat', Category::active()->limit(5)->get());
    }
}