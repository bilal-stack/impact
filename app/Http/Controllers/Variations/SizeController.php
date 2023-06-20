<?php

namespace App\Http\Controllers\Variations;

use App\Http\Controllers\Controller;
use App\Models\Variation;
use App\Models\VariationSize;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variations = VariationSize::paginate(15);
        return view('variations.sizes.list')->with(compact('variations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('variations.sizes.create');
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
            'title'        => ['required', 'string', 'max:255', 'unique:variation_sizes,title'],
            'description'  => ['nullable', 'string', 'max:5000']
        ]);

        VariationSize::create([
            'title'         => $request->title,
            'description'   => $request->description
        ]);

        return redirect()->route('admin.variations.sizes.list')->with('success', 'Successfully created');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $variation = VariationSize::findOrFail($id);
        return view('variations.sizes.edit')->with(compact('variation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $variation = VariationSize::findOrFail($id);

        $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string', 'max:5000']
        ]);

        $variation->update($request->except('_token', '_method'));

        return redirect()->route('admin.variations.sizes.list')->with('success', 'Created Successfully');
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
}
