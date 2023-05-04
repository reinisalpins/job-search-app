<?php

namespace App\Http\Requests\JobSeeker;

use App\DataTransferObjects\JobSeeker\GetJobSeekerProfileData;
use App\Models\JobSeeker\JobSeekerProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GetJobSeekerProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $userId = $this->getUserId();
        return JobSeekerProfile::where('user_id', $userId)->exists();
    }

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function getUserId(): int
    {
        return $this->route('userId');
    }

    /**
     * @throws UnknownProperties
     */
    public function dataTransferObject(): GetJobSeekerProfileData
    {
        return GetJobSeekerProfileData::fromRequest($this);
    }
}

