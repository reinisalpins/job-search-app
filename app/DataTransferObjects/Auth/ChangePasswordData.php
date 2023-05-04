<?php

namespace App\DataTransferObjects\Auth;

use App\Http\Requests\Auth\ChangePasswordRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ChangePasswordData extends DataTransferObject
{
    public ?int $userId;
    public ?string $newPassword;
    public ?string $oldPassword;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(ChangePasswordRequest $request): self
    {
        return new self([
            'userId' => $request->getUserId(),
            'newPassword' => $request->input('new_password'),
            'oldPassword' => $request->input('current_password')
        ]);
    }
}
