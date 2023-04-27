<?php

namespace App\Http\Requests\Employer;

use App\DataTransferObjects\Employer\GetEmployerProfileData;
use App\Enums\User\UserTypeEnum;
use App\Helpers\Rules\RulesHelper;
use Illuminate\Foundation\Http\FormRequest;

class GetEmployerProfileRequest extends FormRequest
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

        ];
    }

    public function getUserId(): int
    {
        return $this->route('userId');
    }

    public function dataTransferObject(): GetEmployerProfileData
    {
        return GetEmployerProfileData::fromRequest($this);
    }
}
