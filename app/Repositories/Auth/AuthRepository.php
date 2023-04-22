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

    public function register(RegisterDataTransferObject $dataTransferObject): string
    {
        $user = new User();
        $user->setFirstName($dataTransferObject->first_name);
        $user->setLastName($dataTransferObject->last_name);
        $user->setPhone($dataTransferObject->phone);
        $user->setEmail($dataTransferObject->email);
        $user->setPassword(Hash::make($dataTransferObject->password));

        $user->save();

        return $user->createToken('my-app-token')->plainTextToken;
    }
}
