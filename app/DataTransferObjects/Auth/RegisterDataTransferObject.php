<?php
namespace App\DataTransferObjects\Auth;

use App\Http\Requests\Auth\UserRegisterRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RegisterDataTransferObject extends DataTransferObject
{

    public string $email;
    public string $password;
    public string $userType;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(UserRegisterRequest $userRegisterRequest): self
    {
        return new self([
            'email' => $userRegisterRequest->input('email'),
            'userType' => $userRegisterRequest->input('user_type'),
            'password' => $userRegisterRequest->input('password'),
        ]);
    }

}
