<?php

namespace App\Http\Controllers\Variations;

use App\Http\Controllers\Controller;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VariationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variations = Variation::paginate(15);
        return view('variations.list')->with(compact('variations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('variations.create');
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
            'title'        => ['required', 'string', 'max:255', 'exists:variations,title'],
            'description'  => ['nullable', 'string', 'max:5000'],
            'document'     => ['required', 'max:5000']
        ]);

        Variation::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'option_image'  => 'variation-option-images/' . $request->document
        ]);

        return redirect()->route('admin.variations.list')->with('success', 'Successfully created');
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
     * @param  Variation $variation
     * @return \Illuminate\Http\Response
     */
    public function edit(Variation $variation)
    {
        return view('variations.edit')->with(compact( 'variation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Variation $variation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variation $variation)
    {
        $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string', 'max:5000'],
            'document'     => ['nullable', 'max:5000']
        ]);

        $variation->update($request->except('_token', '_method'));

        if ($request->has('document')) {
            $file = $variation->option_image;

            $variation->update([
                'option_image'  => 'variation-option-images/' . $request->document
            ]);

            deleteTempFolder('storage/'. $file, 'file');
        }

        return redirect()->route('admin.variations.list')->with('success', 'Edited Successfully');
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
