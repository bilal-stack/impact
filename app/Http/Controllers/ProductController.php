<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariations;
use App\Models\Variation;
use App\Models\VariationSize;
use App\Models\VariationStyle;
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
        $variations = $product->variations()->distinct('variations.id')->paginate(15);
        return view('product.variations.list')->with(compact('product', 'variations'));
    }

    /**
     * Attach product variation Sizes.
     *
     * @param  Product $product
     * @param  Variation $variation
     * @return \Illuminate\Http\Response
     */
    public function showProductVariationSizesStyles(Product $product, Variation $variation)
    {
       $childVariations = ProductVariations::where([['product_id', $product->id], ['variation_id', $variation->id]])->with('style', 'size')->paginate(15);
        return view('product.variations.sizes-styles.list')->with(compact('product', 'variation', 'childVariations'));
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
        return view('product.variations.sizes-styles.attach')->with(compact('product', 'variation'));
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
            'size'          => ['required', 'string', 'exists:variation_sizes,id'],
            'title'         => ['required_without:title_id'],
            'title_id'      => ['nullable','required_without:title', 'exists:variation_styles,id'],
            'description'   => ['nullable', 'string', 'max:9000'],
            'price'         => ['required', 'numeric', 'gt:0'],
            'option_image'  => ['required_without:title_id', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1028'],
            'old_image'     => ['nullable'],
            'product_image' => ['required_without:old_image', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1028'],
            'back_image'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1028'],
        ],
        [
            'title_id.required' => 'You need to select existing style or enter style title',
        ]);

        if (null != $request->title) {
            $style = $this->createStyle($request);
        } else {
            $style = $request->title_id;
        }

        ProductVariations::where([
            ['product_id', $product->id],
            ['variation_id', $variation->id],
            ['variation_size_id', null],
            ['variation_style_id', null]
        ])->delete();

        $exists = ProductVariations::where([
            ['product_id', $product->id],
            ['variation_id', $variation->id],
            ['variation_size_id', $request->size],
            ['variation_style_id', $style]
        ])->exists();

        if (!$exists) {

            if ($request->has('old_image')) {
                $imageName = $product->getFirstMediaUrl('product-images');
            } else {
                $imageName = str_slug($product->title) . '-' .time() . '.' . $request->product_image->extension();
                $request->product_image->move(storage_path('app/public/product-style-images/'), $imageName);
            }

            $backImageName = null;
            if ($request->has('back_image')) {
                $backImageName = str_slug($product->title) . '-' . time() . '-3d.' . $request->back_image->extension();
                $request->back_image->move(storage_path('app/public/product-style-images/'), $backImageName);
            }

            ProductVariations::create([
                'product_id'            => $product->id,
                'variation_id'          => $variation->id,
                'variation_size_id'     => $request->size,
                'variation_style_id'    => $style,
                'price'                 => $request->price,
                'image'                 => $imageName,
                'back_image'            => $backImageName
            ]);
        }

        $product->update(['active' => 1]);

        return redirect()->route('admin.products.variations.sizes.styles.list', [$product->slug, $variation->id])->with('success', 'Successfully attached');
    }

    private function createStyle($request)
    {
        $imageName = str_slug($request->title) . '-' .time() . '.' . $request->option_image->extension();
        $request->option_image->move(storage_path('app/public/variation-style-option-images/'), $imageName);

        $style =  VariationStyle::firstOrCreate([
            'title'         => $request->title,
        ], [
            'description'   => $request->description,
            'option_image'  => $imageName
        ]);

        return $style->id;
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
