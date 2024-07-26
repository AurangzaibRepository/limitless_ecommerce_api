<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class ValidatePassword implements DataAwareRule, ValidationRule
{
    protected $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::firstWhere('email', $this->data['email']);

        if (! $user) {
            return;
        }

        if (! Hash::check($this->data['password'], $user->password)) {
            $fail('Invalid credentials');
        }
    }
}
