<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.index');
    }

    /**
     * Show the application shop page.
     *
     * @return \Illuminate\Http\Response
     */
    public function shop()
    {
        $categories = Category::active()->get();
        return view('front.shop')->with(compact('categories'));
    }
}
