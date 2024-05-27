<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        if (Gate::denies('read-product')){
            return  $this->errorResponse('not permission user!', 403);
        }
        $product = Product::paginate(10);
        return ProductResource::collection($product);
    }


    public function store(ProductRequest $request)
    {
        $inputs = $request->all();
        if ($request->hasFile('image'))
        {
            $path = 'images/product';
            $file_name = uniqid() . '.' . $request->file('image')->extension();
            Storage::drive('public')->putFileAs($path, $request->file('image'), $file_name);
            $inputs['image'] = "storage/$path/$file_name";
        }
        $product = Product::create($inputs);
        return $this->successResponse($product);


    }


    public function show(Product $product)
    {
        return $this->successResponse(new ProductResource($product));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $inputs = $request->all();

        if ($request->hasFile('image'))
        {
            $path = 'images/product';
            $file_name = uniqid() . '.' . $request->file('image')->extension();
            Storage::drive('public')->putFileAs($path, $request->file('image'), $file_name);
            $inputs['image'] = "storage/$path/$file_name";
        }

        $product->update($inputs);

        return new ProductResource($product);
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return $this->successResponse($product);
    }
}
