<?php

namespace App\Http\Requests\User;

use App\DataTransferObjects\User\GetUserProfileDataTransferObject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GetUserProfileInfoRequest extends FormRequest
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

