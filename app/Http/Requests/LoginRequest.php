<?php

namespace App\Http\Requests;

use App\Rules\ValidatePassword;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users',
            'password' => ['required', new ValidatePassword], // Custom rule to validate password
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute is required',
            'email.email' => 'Invalid email',
            'email.exists' => 'Email not found',
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
