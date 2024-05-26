<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    use ApiResponse;

    public function index()
    {
        $category = Category::paginate(10);
        return CategoryResource::collection($category);

    }


    public function store(CategoryRequest $request, Category $category)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')){
            $path = 'images/category';
            $file_name = uniqid() . '.' . $request->file('image')->extension();
            Storage::drive('public')->putFileAs($path, $request->file('image'), $file_name);
            $inputs['image'] = "storage/$path/$file_name";
        }
        $category = Category::create($inputs);
        return $this->successResponse($category);
    }


    public function show(Category $category)
    {
        return $this->successResponse(new CategoryResource($category));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $inputs = $request->all();

        $category->update($inputs);

        return new CategoryResource($category);
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return $this->successResponse($category);
    }

    public function parent(Category $category)
    {
        return $this->successResponse(new CategoryResource($category->load('parent')));
    }

    public function children(Category $category)
    {
        return $this->successResponse(new CategoryResource($category->load('children')));
    }

    public function getProducts(Category $category)
    {
        return $this->successResponse(new CategoryResource($category->load('products')));
    }



}
