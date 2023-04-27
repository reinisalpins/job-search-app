<?php

namespace App\Http\Requests\Auth;

use App\DataTransferObjects\Auth\RegisterDataTransferObject;
use App\Enums\User\UserTypeEnum;
use App\Helpers\Rules\RulesHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                RulesHelper::REQUIRED,
                RulesHelper::STRING,
                RulesHelper::EMAIL,
                RulesHelper::max(255),
                'unique:users'
            ],
            'password' => [
                RulesHelper::STRING,
                RulesHelper::REQUIRED,
                RulesHelper::min(6),
                RulesHelper::CONFIRMED
            ],
            'user_type' => [
                RulesHelper::REQUIRED,
                new Enum(UserTypeEnum::class)
            ]
        ];
    }

    /**
     * @throws UnknownProperties
     */
    public function dataTransferObject(): RegisterDataTransferObject
    {
        return RegisterDataTransferObject::fromRequest($this);
    }
}
