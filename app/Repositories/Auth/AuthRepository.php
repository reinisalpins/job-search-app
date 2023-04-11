<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use App\DataTransferObjects\Auth\RegisterDataTransferObject;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function __construct(
        private readonly User $user,
    )
    {
    }

    public function register(RegisterDataTransferObject $dataTransferObject)
    {
        $payload = [
            'first_name' => $dataTransferObject->first_name,
            'last_name' => $dataTransferObject->last_name,
            'phone' => $dataTransferObject->phone,
            'email' => $dataTransferObject->email,
            'password' => Hash::make($dataTransferObject->password),
        ];

        $user = User::create($payload);

        return $user->createToken('my-app-token')->plainTextToken;
    }
}
