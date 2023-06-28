<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\VariationSize;
use App\Models\VariationStyle;

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
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Product $product)
    {
        $variation = $product->variations()->first();
        $size = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation->id]])->pluck('variation_size_id')->first();
        //getting styles for first variation and size
        $styles = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation->id], ['variation_size_id', $size]])->pluck('variation_style_id');
        $styles = VariationStyle::whereIn('id', $styles)->get();
        //getting sizes
        $sizes = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation->id]])->distinct('variation_size_id')->pluck('variation_size_id');
        $sizes = VariationSize::whereIn('id', $sizes)->get();

        $variations = $product->variations()->distinct('id')->get();
        return view('front.product.detail')->with(compact('product', 'category', 'variations', 'sizes', 'styles'));
    }

}
