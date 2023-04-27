<?php

namespace App\Http\Requests\Employer;

use App\DataTransferObjects\Employer\CreateEmployerProfileData;
use App\Enums\User\UserTypeEnum;
use App\Helpers\Rules\RulesHelper;
use Illuminate\Foundation\Http\FormRequest;

class CreateEmployerProfileRequest extends FormRequest
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

    public function rules(): array
    {
        return [
            'user_id' => [
                RulesHelper::REQUIRED,
                RulesHelper::INTEGER,
                RulesHelper::existsOnDatabase('users', 'id'),
                RulesHelper::uniqueOnDatabase('employer_profiles', 'user_id')
            ],
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

    public function dataTransferObject(): CreateEmployerProfileData
    {
        return CreateEmployerProfileData::fromRequest($this);
    }
}
