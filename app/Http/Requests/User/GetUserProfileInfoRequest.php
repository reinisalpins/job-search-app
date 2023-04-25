<?php

namespace App\Http\Requests\User;

use App\DataTransferObjects\User\GetUserProfileDataTransferObject;
use App\Models\User\UserProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GetUserProfileInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $userId = $this->getUserId();
        return UserProfile::where('user_id', $userId)->exists();
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
    public function dataTransferObject(): GetUserProfileDataTransferObject
    {
        return GetUserProfileDataTransferObject::fromRequest($this);
    }
}

