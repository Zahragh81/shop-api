<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:categories,title',
            'parent_id' => 'nullable|integer',
        ];
    }

//    public function failedValidation(Validator $validator)
//    {
//        throw new HttpResponseException(Response::json([
//            'success' => false,
//            'message' => 'validation errors',
//            'data' => $validator->errors(),
//        ]));
//    }

//    public function messages()
//    {
//        return [
//          'title.required' => 'عنوان دسته بندی خالی باشد'
//        ];
//
//    }
}
