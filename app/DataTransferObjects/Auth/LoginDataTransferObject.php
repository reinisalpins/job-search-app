<?php
namespace App\DataTransferObjects\Auth;

use App\Http\Requests\Auth\EmployerLoginRequest;
use Spatie\DataTransferObject\DataTransferObject;

class LoginDataTransferObject extends DataTransferObject
{
    public string $email;
    public string $password;

    public static function fromRequest(EmployerLoginRequest $userRegisterRequest): self
    {
        return new self([
            'email' => $userRegisterRequest->input('email'),
            'password' => $userRegisterRequest->input('password'),
        ]);
    }
}

