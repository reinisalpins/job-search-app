<?php

namespace App\DataTransferObjects\JobSeeker;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\JobSeeker\GetJobSeekerProfileRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GetJobSeekerProfileData extends DataTransferObject
{
    public int $userId;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(GetJobSeekerProfileRequest $request): self
    {
        return new self([
           'userId' => $request->getUserId()
        ]);
    }
}
