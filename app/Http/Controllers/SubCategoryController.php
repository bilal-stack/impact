<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::paginate(15);

        return view('category.subcategory.list')->with(compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.subcategory.create');
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
            'title' => ['required', 'string', 'max:255', 'min:5', 'unique:sub_categories,title'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        $category = SubCategory::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        if ($request->has('document')) {
            $category->addMedia(storage_path('tmp/uploads/' . Auth::id() . '/' . $request->document))->toMediaCollection('category-images', 'category-images');
        }

        return redirect()->route('admin.sub.categories.list')->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  SubCategory $subCategory
     * @return mixed
     */
    public function show(SubCategory $subCategory)
    {
        dd($subCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SubCategory $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        return view('category.subcategory.edit')->with(compact('subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SubCategory $subCategory
     * @return mixed
     * @throws
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:255', 'min:5'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);


        $subCategory->update($request->except('_token', '_method'));

        if ($request->has('document')) {
            $media = $subCategory->getMedia('category-images');
            if (isset($media[0])){
                $media[0]->delete();
            }

            $subCategory->addMedia(storage_path('tmp/uploads/' . Auth::id() . '/' . $request->document))->toMediaCollection('category-images', 'category-images');
        }

        return redirect()->route('admin.sub.categories.list')->with('success', 'Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SubCategory $subCategory
     * @return mixed
     */
    public function destroy(SubCategory $subCategory)
    {
        if ($subCategory->active == 1) {
            $subCategory->active = 0;
        } else {
            $subCategory->active = 1;
        }

        $subCategory->update();
        return redirect('categories/subcategories/index')->with('success', 'Category Update Successfully');
    }
}
