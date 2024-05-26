<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        if (request()->isMethod('POST')) {
            return [
                'title' => 'required|string|unique:brands,title',
                'image' => 'required|image',
            ];
        }
        else {
            return [
                'title' => 'required|string|unique:brands,title,' . $this->brand->id,
//                'title' => "required|string|unique:brands,title,{$this->brand->id}",
//                'title' => ['required', 'string', Rule::unique('brands', 'title')->ignore($this->brand->id)],

                'image' => 'nullable|image',
//                'image' => ['nullable', 'image'],
            ];
        }
    }
}
