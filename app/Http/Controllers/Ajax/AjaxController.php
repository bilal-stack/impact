<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Settings;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get Main Category.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function getCategories(Category $category)
    {
        return Response::json(
            [
                'success' => true,
                'data' => $category->toArray()
            ]);
    }

    /**
     * Get Sub Categories of Main Category
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function getSubCategories(Category $category)
    {
        return Response::json(
            [
                'success' => true,
                'data' => $category->subCategories()->get()->toArray()
            ]);
    }

    /**
     * Get Sub Categories of Multiple Categories
     *
     * @throws
     * @param Request $request
     * @return JsonResponse
     */
    public function getMultipleSubSubCategories(Request $request)
    {
        $this->validate($request, [
            'sub_categories' => ['required', 'array'],
            'sub_categories.*' => ['required', 'exists:sub_categories,slug']
        ]);

        $subCategories = SubCategory::whereIn('slug', $request->sub_categories)->get();

        $subSubCategories = [];
        foreach ($subCategories as $category) {
            $subSubCategories = array_merge($subSubCategories, $category->subSubCategories()->get()->toArray());
        }

        return Response::json(
            [
                'success' => true,
                'data' => $subSubCategories
            ]);
    }

    /**
     * Store Variation Option Image
     *
     * @throws
     * @param Request $request
     * @return JsonResponse
     */
    public function storeVariationMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000']
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $validator->errors()
                ]);
        }

        $path = storage_path('app/public/variation-option-images/');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return Response::json(
            [
                'success' => true,
                'name' => $name,
                'original_name' => $file->getClientOriginalName(),
            ]);
    }

    /**
     * Remove Temporary Variation Media
     *
     * @throws
     * @param Request $request
     * @return JsonResponse
     */
    public function removeVariationMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $validator->errors()
                ]);
        }

        $path = storage_path('app/public/variation-option-images');

        if (File::exists($path . '/' . $request->file)) {
            File::delete($path . '/' . $request->file);
        }

        return Response::json(
            [
                'success' => true,
                'data' => null
            ]);

    }

    /**
     * Store Cat Media Temporary
     *
     * @throws
     * @param Request $request
     * @return JsonResponse
     */
    public function storeCatMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000']
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $validator->errors()
                ]);
        }

        $path = storage_path('tmp/uploads/' . Auth::id());
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return Response::json(
            [
                'success' => true,
                'name' => $name,
                'original_name' => $file->getClientOriginalName(),
            ]);
    }

    /**
     * Store Cat Media Temporary
     *
     * @throws
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteCatMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'exists:media,name']
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $validator->errors()
                ]);
        }

        $media = Media::whereName($request->name)->first();
        $media->delete();

        return Response::json(
            [
                'success' => true,
                'media' => $request->name
            ]);
    }

    /**
     * Remove Temporary Cat Media
     *
     * @throws
     * @param Request $request
     * @return JsonResponse
     */
    public function removeTmpCatMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $validator->errors()
                ]);
        }

        $path = storage_path('tmp/uploads');

        if (File::exists($path . '/' . $request->file)) {
            File::delete($path . '/' . $request->file);
        }

        return Response::json(
            [
                'success' => true,
                'data' => null
            ]);

    }

    /**
     * Store Product Media Temporary
     *
     * @throws
     * @param Request $request
     * @return JsonResponse
     */
    public function storeProductMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5000']
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $validator->errors()
                ]);
        }

        $path = storage_path('tmp/uploads/' . Auth::id());
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return Response::json(
            [
                'success' => true,
                'name' => $name,
                'original_name' => $file->getClientOriginalName(),
            ]);
    }

    /**
     * Remove Temporary Product Media
     *
     * @throws
     * @param Request $request
     * @return JsonResponse
     */
    public function removeTmpProductMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $validator->errors()
                ]);
        }

        $path = storage_path('tmp/uploads');

        if (File::exists($path . '/' . $request->file)) {
            File::delete($path . '/' . $request->file);
        }

        return Response::json(
            [
                'success' => true,
                'data' => null
            ]);

    }
}
