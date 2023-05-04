<?php

namespace App\Http\Requests\JobSeeker;

use App\DataTransferObjects\JobSeeker\CreateJobSeekerProfileData;
use App\Enums\User\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateJobSeekerProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->user_type === UserTypeEnum::JOB_SEEKER;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id|',
            'skills' => 'required|array',
            'skills.*' => 'required|string',
            'experience' => 'required|string',
            'education' => 'required|string',
            'languages' => 'required|array',
            'location' => 'required|string|max:255',
        ];
    }

    public function getUserId(): int
    {
        return $this->route('userId');
    }

    public function dataTransferObject(): CreateJobSeekerProfileData
    {
        return CreateJobSeekerProfileData::fromRequest($this);
    }
}
