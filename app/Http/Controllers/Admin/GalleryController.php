<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Http\Resources\Admin\GalleryResource;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Product $product)
    {
        return GalleryResource::collection($product->galleries);
    }


    public function store(GalleryRequest $request, Product $product)
    {
        $product->newGallery($request);

        return $this->successResponse(true);
    }


    public function show(Gallery $gallery)
    {
        //
    }


    public function update(Request $request, Gallery $gallery)
    {
        //
    }


    public function destroy(Product $product, Gallery $gallery)
    {
        $product->deleteGallery($gallery);
        return $this->successResponse(true);
    }
}
