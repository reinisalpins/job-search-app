<?php
namespace App\DataTransferObjects\Auth;

use App\Http\Requests\Auth\UserRegisterRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RegisterDataTransferObject extends DataTransferObject
{
    public string $first_name;
    public string $last_name;
    public string $phone;
    public string $email;
    public string $password;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(UserRegisterRequest $userRegisterRequest): self
    {
        return new self([
            'first_name' => $userRegisterRequest->input('first_name'),
            'last_name' => $userRegisterRequest->input('last_name'),
            'phone' => $userRegisterRequest->input('phone'),
            'email' => $userRegisterRequest->input('email'),
            'password' => $userRegisterRequest->input('password'),
        ]);
    }

}
