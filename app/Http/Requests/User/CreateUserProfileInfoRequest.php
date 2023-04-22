<?php

namespace App\Http\Requests\User;

use App\DataTransferObjects\User\CreateUserProfileData;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserProfileInfoRequest extends FormRequest
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

    public function dataTransferObject(): CreateUserProfileData
    {
        return CreateUserProfileData::fromRequest($this);
    }
}
