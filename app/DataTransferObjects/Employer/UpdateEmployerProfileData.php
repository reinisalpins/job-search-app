<?php

namespace App\DataTransferObjects\Employer;

use App\Http\Requests\Employer\UpdateEmployerProfileRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateEmployerProfileData extends DataTransferObject
{
    public int $userId;
    public string $companyName;
    public ?string $phone;
    public ?string $about;
    public ?string $location;
    public ?string $websiteUrl;

    public static function fromRequest(UpdateEmployerProfileRequest $request): self
    {
        return new self([
            'userId' => $request->getUserId(),
            'companyName' => $request->input('company_name'),
            'phone' => $request->input('phone'),
            'about' => $request->input('about'),
            'location' => $request->input('location'),
            'websiteUrl' => $request->input('website_url'),
        ]);
    }
}
