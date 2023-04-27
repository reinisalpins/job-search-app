<?php

namespace App\Http\Requests\Employer;

use App\DataTransferObjects\Employer\UpdateEmployerProfileData;
use App\Enums\User\UserTypeEnum;
use App\Helpers\Rules\RulesHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $loggedInUserId = $this->user()->id;
        $requestedUserId = $this->getUserId();

        return $this->user()->user_type === UserTypeEnum::EMPLOYER->value && $loggedInUserId === $requestedUserId;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => [
                RulesHelper::REQUIRED,
                RulesHelper::STRING,
                RulesHelper::max(255)
            ],
            'phone' => [
                RulesHelper::NULLABLE,
                RulesHelper::STRING,
                RulesHelper::max(15),
            ],
            'about' => [
                RulesHelper::NULLABLE,
                RulesHelper::STRING
            ],
            'location' => [
                RulesHelper::NULLABLE,
                RulesHelper::STRING,
                RulesHelper::max(255)
            ],
            'website_url' => [
                RulesHelper::NULLABLE,
                RulesHelper::STRING,
                RulesHelper::max(255),
                RulesHelper::URL
            ]
        ];
    }

    public function getUserId(): int
    {
        return $this->route('userId');
    }

    public function dataTransferObject(): UpdateEmployerProfileData
    {
        return UpdateEmployerProfileData::fromRequest($this);
    }
}
