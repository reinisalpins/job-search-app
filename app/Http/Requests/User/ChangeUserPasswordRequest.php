<?php

namespace App\Http\Requests\User;

use App\DataTransferObjects\User\ChangeUserPasswordData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ChangeUserPasswordRequest extends FormRequest
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
            'current_password' => ['required', 'string'],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ];
    }

    public function getUserId(): int
    {
        return $this->route('userId');
    }

    /**
     * @throws UnknownProperties
     */
    public function dataTransferObject(): ChangeUserPasswordData
    {
        return ChangeUserPasswordData::fromRequest($this);
    }
}
