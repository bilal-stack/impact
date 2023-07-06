<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Variation;
use App\Models\VariationSize;
use App\Models\VariationStyle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        $price = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation->id]])->pluck('price')->first();

        return view('front.product.detail')->with(compact('product', 'category', 'variations', 'sizes', 'styles', 'price'));
    }

    /**
     * Getting the specified resource details.
     * Ajax request
     *
     * @param  Product $product
     * @param  $variation
     * @return JsonResponse
     */
    public function productVariationSizesStyles(Product $product, $variation)
    {
        $size = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation]])->pluck('variation_size_id')->first();
        //getting styles for selected variation
        $styles = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation], ['variation_size_id', $size]])->pluck('variation_style_id');
        $styles = VariationStyle::whereIn('id', $styles)->get();
        //getting sizes
        $sizes = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation]])->distinct('variation_size_id')->pluck('variation_size_id');
        $sizes = VariationSize::whereIn('id', $sizes)->get();

        $data = ProductVariations::select('price', 'image')->where([['product_id', $product->id], ['variation_id', $variation], ['variation_size_id', $size]])->first();
        $price = $data->price;


        if (strpos($data->image, "https") !== false) {
            $image = $data->image;
        } else {
            $image = asset('storage/product-style-images/' . $data->image);
        }

        return Response::json([
                'success'   => true,
                'sizes'     => $sizes->toArray(),
                'styles'    => $styles->toArray(),
                'price'     => $price,
                'image'     => $image,
            ]);
    }

    /**
     * Getting the specified resource details.
     * Ajax request
     *
     * @param  Product $product
     * @param  $variation
     * @return JsonResponse
     */
    public function productVariationStyles(Product $product, $variation, $size)
    {
        //getting styles for selected variation and size
        $styles = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation], ['variation_size_id', $size]])->pluck('variation_style_id');
        $styles = VariationStyle::whereIn('id', $styles)->get();

        $data = ProductVariations::select('price', 'image')->where([['product_id', $product->id], ['variation_id', $variation], ['variation_size_id', $size]])->first();
        $price = $data->price;

        if (strpos($data->image, "https") !== false) {
            $image = $data->image;
        } else {
            $image = asset('storage/product-style-images/' . $data->image);
        }

        return Response::json(
            [
                'success'   => true,
                'styles'    => $styles->toArray(),
                'price'     => $price,
                'image'     => $image,
            ]);
    }

    /**
     * Getting the specified resource details.
     * Ajax request
     *
     * @param  Product $product
     * @param  $variation
     * @param $size
     * @param $style
     * @return JsonResponse
     */
    public function productVariationStylesData(Product $product, $variation, $size, $style)
    {
        //getting styles for selected variation and size
        $styles = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation], ['variation_size_id', $size], ['variation_style_id', $style]])->first();

        if (empty($styles)){
            return $this->returnErrorResponse();
        }

        $price = $styles->price;

        if (strpos($styles->image, "https") !== false) {
            $image = $styles->image;
        } else {
            $image = asset('storage/product-style-images/' . $styles->image);
        }

        return Response::json(
            [
                'success'   => true,
                'styles'    => $styles->toArray(),
                'price'     => $price,
                'image'     => $image,
            ]);
    }

    public function returnErrorResponse()
    {
        return Response::json([
                'success'   => false,
                'styles'    => null,
                'price'     => null,
                'image'     => null,
            ]);
    }

}
