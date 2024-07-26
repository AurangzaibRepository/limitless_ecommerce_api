<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ProductAddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|decimal:2',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute is required',
            'category_id.exists' => 'Category not found',
        ];
    }

    protected function failedValidation(Validator $validator): JsonResponse
    {
        $response = generateResponse(
            'Error',
            null,
            $validator->errors()->toArray(),
            null,
            403
        );

        throw new HttpResponseException($response);
    }
}
