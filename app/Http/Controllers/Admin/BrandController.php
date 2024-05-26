<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Http\Resources\Admin\BrandResource;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::all();
        return $this->successResponse(BrandResource::collection($brand));

    }


    public function store(BrandRequest $request)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')) {
            $path = 'images/brand';
            $file_name = uniqid() . '.' . $request->file('image')->extension();
            Storage::drive('public')->putFileAs($path, $request->file('image'), $file_name);
            $inputs['image'] = "storage/$path/$file_name";
        }

        $brand = Brand::create($inputs);

        return new BrandResource($brand);
    }

    public function show(Brand $brand)
    {
       return $this->successResponse(new BrandResource($brand));
    }


    public function update(BrandRequest $request, Brand $brand)
    {
        $inputs = $request->all();

        if ($request->hasFile('image')) {
            $path = 'images/brand';
            $file_name = uniqid() . '.' . $request->file('image')->extension();
            Storage::drive('public')->putFileAs($path, $request->file('image'), $file_name);
            $inputs['image'] = "storage/$path/$file_name";
        }

        $brand->update($inputs);

        return new BrandResource($brand);
    }


    public function destroy(Brand $brand)
    {
        if ($brand->image)
            Storage::drive('public')->delete(Str::remove('storage/', $brand->image));

        $brand->delete();

        return $this->successResponse($brand);
    }

    public function getProducts(Brand $brand)
    {
        return $this->successResponse(new BrandResource($brand->load('products')));
    }
}
