<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => 'required',
            'permissions' => 'nullable|array|exists:permissions,id'
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::json([
            'success' => false,
            'message' => 'validation errors',
            'data' => $validator->errors(),
        ]));
    }
}
