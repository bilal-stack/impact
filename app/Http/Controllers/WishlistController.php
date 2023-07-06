<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishlist()
    {
        $user = Auth::user();
        $products = $user->wishlists();

        if (isset($products['default'])){
            $products = $products['default'][0];
        } else {
            $products = [];
        }

        return view('pages.user.wishlist.index',compact('products'));
    }

    public function favoriteAdd(Product $product)
    {
        $user = Auth::user();
        $user->wish($product);
        session()->flash('success', 'Product is Added to Favorite Successfully !');

        return redirect()->back();
    }

    public function favoriteRemove(Product $product)
    {
        $user = Auth::user();
        $user->unwish($product);
        session()->flash('success', 'Product is Remove to Favorite Successfully !');

        return redirect()->route('wishlist');
    }
}
