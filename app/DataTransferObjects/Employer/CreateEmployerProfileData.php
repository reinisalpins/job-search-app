<?php

namespace App\DataTransferObjects\Employer;

use App\Http\Requests\Employer\CreateEmployerProfileRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateEmployerProfileData extends DataTransferObject
{
    public int $userId;
    public string $companyName;
    public ?string $phone;
    public ?string $about;
    public ?string $location;
    public ?string $websiteUrl;

    public static function fromRequest(CreateEmployerProfileRequest $request): self
    {
        return new self([
            'userId' => $request->input('user_id'),
            'companyName' => $request->input('company_name'),
            'phone' => $request->input('phone'),
            'about' => $request->input('about'),
            'location' => $request->input('location'),
            'websiteUrl' => $request->input('website_url'),
        ]);
    }
}
