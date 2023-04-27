<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use App\DataTransferObjects\Auth\EmployerRegisterDataTransferObject;
use App\DataTransferObjects\Auth\LoginDataTransferObject;
use App\DataTransferObjects\Auth\RegisterDataTransferObject;
use App\Models\Employer\Employer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthRepository
{
    public function __construct(
        private readonly User $user,
        private readonly Employer $employer,
    )
    {
    }

    public function register(RegisterDataTransferObject $dataTransferObject): string
    {
        $user = new User();
        $user->setEmail($dataTransferObject->email);
        $user->setPassword(Hash::make($dataTransferObject->password));
        $user->setUserType($dataTransferObject->userType);

        $user->save();

        return $user->createToken('my-app-token')->plainTextToken;
    }

}
