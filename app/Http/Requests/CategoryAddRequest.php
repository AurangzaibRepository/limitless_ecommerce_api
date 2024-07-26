<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CategoryAddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
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
