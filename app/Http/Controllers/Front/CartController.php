<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Variation;
use App\Models\VariationSize;
use App\Models\VariationStyle;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Cart Products
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws
     */
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        //dd($cartItems);
        return view('front.cart.index', compact('cartItems'));
    }


    /**
     * Cart Products
     *
     * @param AddToCartRequest $request
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws
     */
    public function addToCart(AddToCartRequest $request)
    {
        $product = Product::where('slug', $request->product)->with('category')->first();

        $variation = Variation::findOrFail($request->variation);
        $size = VariationSize::findOrFail($request->size);
        $style = VariationStyle::findOrFail($request->style);

        $data = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation->id],
            ['variation_size_id', $size->id], ['variation_style_id', $style->id]])->first();


        if (strpos($data->image, "https") !== false) {
            $image = $data->image;
        } else {
            $image = asset('storage/product-style-images/' . $data->image);
        }

        \Cart::add([
            'id'                        => $product->id,
            'name'                      => $product->title,
            'price'                     => $request->price,
            'quantity'                  => $request->qty,
            'attributes' => array(
                'category'              => $product->category->slug,
                'product_slug'          => $request->product,
                'image'                 => $image,
                'variation_title'       => $variation->title,
                'variation_size'        => $size->title,
                'variation_style'       => $style->title,
                'variation'             => $request->variation,
                'size'                  => $request->size,
                'style'                 => $request->style,
            )
        ]);

        session()->flash('success', 'Product is Added to Cart Successfully !');
        return redirect()->route('cart.list');
    }

    /**
     * Cart Products
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws
     */
    public function updateCart(Request $request)
    {
        $this->validate($request, [
            'id' => ['required'],
            'quantity' => ['required']
        ]);

        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');
        return redirect()->route('cart.list');
    }

    /**
     * Cart Products
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws
     */
    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);

        session()->flash('success', 'Item Cart Remove Successfully !');
        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');
        return redirect()->route('cart.list');
    }
}
