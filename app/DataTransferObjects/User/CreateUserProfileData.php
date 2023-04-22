<?php

namespace App\DataTransferObjects\User;

use App\Http\Requests\User\CreateUserProfileInfoRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserProfileData extends DataTransferObject
{
    public int $userId;
    public ?array $skills;
    public ?string $experience;
    public ?string $education;
    public ?string $location;
    public ?array $languages;

    public static function fromRequest(CreateUserProfileInfoRequest $request): self
    {
        return new self([
            'userId' => $request->getUserId(),
            'skills' => $request->input('skills'),
            'experience' => $request->input('experience'),
            'education' => $request->input('education'),
            'languages' => $request->input('languages'),
            'location' => $request->input('location'),
        ]);
    }
}
