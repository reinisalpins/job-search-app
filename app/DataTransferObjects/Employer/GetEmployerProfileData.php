<?php

namespace App\DataTransferObjects\Employer;

use App\Http\Requests\Employer\GetEmployerProfileRequest;
use Spatie\DataTransferObject\DataTransferObject;

class GetEmployerProfileData extends DataTransferObject
{
    public int $userId;

    public static function fromRequest(GetEmployerProfileRequest $request): self
    {
        return new self([
            'userId' => $request->getUserId()
        ]);
    }
}
