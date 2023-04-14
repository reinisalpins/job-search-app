<?php

namespace App\DataTransferObjects\User;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\User\GetUserProfileInfoRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GetUserProfileDataTransferObject extends DataTransferObject
{
    public int $userId;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(GetUserProfileInfoRequest $request): self
    {
        return new self([
           'userId' => $request->getUserId()
        ]);
    }
}
