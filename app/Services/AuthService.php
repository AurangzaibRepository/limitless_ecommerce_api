<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class AuthService
{
    public function register(array $data): void
    {
        $data['password'] = hashPassword($data['password']);
        User::create($data);
    }

    public function getUser(string $email): array
    {
        $user = User::firstWhere('email', $email);

        return [
            'name' => "{$user->first_name} {$user->last_name}",
            'email' => $user->email,
            'api_token' => $this->generateAPIToken($user),
        ];
    }

    private function generateAPIToken(User $user): string
    {
        $plainToken = Str::random(120);

        // Save hash token in database
        $user->forceFill([
            'api_token' => hash('sha256', $plainToken),
        ])->save();

        return $plainToken;
    }
}
