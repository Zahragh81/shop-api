<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        if (request()->isMethod('POST'))
        {
            return [
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'integer|exists:brands,id',
                'name' => 'required|string',
                'image' => 'required|image|mimes:png,jpg,jpeg,svg',
                'slug' => 'required|unique:products,slug',
                'price' => 'required|integer',
                'description' => 'required|string',
                'quantity' => 'required|integer',
            ];
        }
        else
        {
            return [
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'integer|exists:brands,id',
                'name' => 'required|string',
                'image' => 'image|mimes:png,jpg,jpeg,svg',
                'slug' => 'required|unique:products,slug,' . $this->product->id,
                'price' => 'required|integer',
                'description' => 'required|string',
                'quantity' => 'required|integer',
            ];
        }

    }
}
