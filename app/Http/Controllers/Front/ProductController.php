<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $products = $category->products()->active()->paginate(15);
        return view('front.product.index')->with(compact('products', 'category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        dd($product);
        return view('product.list')->with(compact('products'));
    }

}
