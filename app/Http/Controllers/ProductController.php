<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Variation;
use App\Models\VariationSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(15);
        return view('product.list')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'exists:categories,id'],
            'sub_category' => ['nullable', 'string', 'exists:sub_categories,id'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'document' => ['required', 'max:5000']
        ]);

        $product = Product::create([
            'title' => $request->title,
            'tagline' => $request->tagline,
            'description' => $request->description,
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'active' => 0
        ]);

        if ($request->has('document')) {
            $product->addMedia(storage_path('tmp/uploads/' . Auth::id() . '/' . $request->document))->toMediaCollection('product-images', 'product-images');
        }

        deleteTempFolder('tmp/uploads/' . Auth::id());

        return redirect()->route('admin.products.variations.attach', $product->slug)->with('success', 'Successfully created');
    }

    /**
     * Attach product variations.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function attachVariations(Product $product)
    {
        $product->load('variations');

        $variations = Variation::whereDoesntHave('product', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();

        return view('product.variations.attach-variation')->with(compact('product', 'variations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function storeVariations(Request $request, Product $product)
    {
        $request->validate([
            'variations' => ['required', 'array']
        ]);

        $product->variations()->sync($request->variations);

        return redirect()->route('admin.products.variations.list', $product->slug)->with('success', 'Successfully created');
    }

    /**
     * Display a listing of the variations.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function productVariations(Product $product)
    {
        $variations = $product->variations()->paginate(15);
        return view('product.variations.list')->with(compact('product', 'variations'));
    }

    /**
     * Attach product variation Sizes.
     *
     * @param  Product $product
     * @param  Variation $variation
     * @return \Illuminate\Http\Response
     */
    public function attachVariationSizes(Product $product, Variation $variation)
    {
        return view('product.variations.attach-variation-sizes')->with(compact('product', 'variation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Product $product
     * @param Variation $variation
     * @return \Illuminate\Http\Response
     */
    public function storeVariationsSizes(Request $request, Product $product, Variation $variation)
    {
        $request->validate([
            'sizes' => ['required', 'array']
        ]);

        ProductVariations::where([
            ['product_id', $product->id],
            ['variation_id', $variation->id],
            ['variation_size_id', null]
        ])->delete();

        foreach ($request->sizes as $size) {

            $exists = ProductVariations::where([
                ['product_id', $product->id],
                ['variation_id', $variation->id],
                ['variation_size_id', $size]
            ])->exists();

            if (!$exists) {
                ProductVariations::create([
                    'product_id' => $product->id,
                    'variation_id' => $variation->id,
                    'variation_size_id' => $size
                ]);
            }
        }

        return redirect()->route('admin.products.variations.list', $product->slug)->with('success', 'Successfully attached');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
