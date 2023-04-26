<?php

namespace App\Http\Requests\Auth;

use App\DataTransferObjects\Auth\RegisterDataTransferObject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use App\Helpers\Rules\ValidationRuleHelper;
use App\Enums\User\UserTypeEnum;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                ValidationRuleHelper::REQUIRED,
                ValidationRuleHelper::STRING,
                ValidationRuleHelper::EMAIL,
                ValidationRuleHelper::max(255),
                'unique:users'
            ],
            'password' => [
                ValidationRuleHelper::STRING,
                ValidationRuleHelper::REQUIRED,
                ValidationRuleHelper::min(6),
                'confirmed'
            ],
            'user_type' => [
                ValidationRuleHelper::REQUIRED,
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
