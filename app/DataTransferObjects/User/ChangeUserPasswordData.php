<?php

namespace App\DataTransferObjects\User;

use App\Http\Requests\User\ChangeUserPasswordRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ChangeUserPasswordData extends DataTransferObject
{
    public ?int $userId;
    public ?string $newPassword;
    public ?string $oldPassword;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(ChangeUserPasswordRequest $request): self
    {
        return new self([
            'userId' => $request->getUserId(),
            'newPassword' => $request->input('new_password'),
            'oldPassword' => $request->input('current_password')
        ]);
    }
}
