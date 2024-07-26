<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute is required',
            'email.email' => 'Invalid email',
            'email.unique' => 'Email already exists',
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
