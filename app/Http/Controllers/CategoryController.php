<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::active()->paginate(15);
        return view('category.list')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subCategories = SubCategory::active()->get();
        return view('category.create')->with(compact('subCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => ['required', 'string', 'max:255', 'unique:categories,title'],
            'tagline'      => ['nullable', 'string', 'max:255'],
            'description'  => ['nullable', 'string', 'max:255'],
            'document'     => ['required', 'max:5000']
        ]);

        $category = Category::create([
            'title'       => $request->title,
            'tagline'     => $request->tagline,
            'description' => $request->description
        ]);

        if ($request->has('document')) {
            $category->addMedia(storage_path('tmp/uploads/' . Auth::id() . '/' . $request->document))->toMediaCollection('category-images', 'category-images');
        }

        $category->subCategories()->attach($request->sub_categories);
        $this->deleteTempFolder();

        return redirect()->route('admin.categories.list')->with('success', 'Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return mixed
     */
    public function edit(Category $category)
    {
        $category->load('subCategories');
        $subCategories = SubCategory::active()->whereDoesntHave('categories', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })->get();

        return view('category.edit')->with(compact('subCategories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'tagline'      => ['nullable', 'string', 'max:255'],
            'description'  => ['nullable', 'string', 'max:255'],
            'document'     => ['nullable', 'max:5000']
        ]);


        $category->update($request->except('_token', '_method'));

        if ($request->has('document')) {
            $media = $category->getMedia('category-images');
            if (isset($media[0])) {
                $media[0]->delete();
            }

            $category->addMedia(storage_path('tmp/uploads/' . Auth::id() . '/' . $request->document))->toMediaCollection('category-images', 'category-images');
        }

        $category->subCategories()->sync($request->sub_categories);
        $this->deleteTempFolder();

        return redirect()->route('admin.categories.list')->with('success', 'Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * remove temp images.
     *
     */
    private function deleteTempFolder()
    {
        if (File::exists(storage_path('tmp/uploads/' . Auth::id()))) {
            File::deleteDirectory(storage_path('tmp/uploads/' . Auth::id()));
        }
    }
}
