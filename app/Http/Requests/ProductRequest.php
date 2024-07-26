<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ProductRequest extends FormRequest
{
    // To merge route param id in request for validation
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }

    public function rules(): array
    {
        return [
            'id' => 'integer|exists:products',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => 'Product not found',
            'required' => ':attribute is required',
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
