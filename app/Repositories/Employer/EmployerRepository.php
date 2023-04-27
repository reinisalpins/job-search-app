<?php

namespace App\Repositories\Employer;

use App\DataTransferObjects\Employer\CreateEmployerProfileData;
use App\DataTransferObjects\Employer\GetEmployerProfileData;
use App\DataTransferObjects\Employer\UpdateEmployerProfileData;
use App\Models\Employer\EmployerProfile;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class EmployerRepository
{
    public function __construct(
        private readonly User            $user,
        private readonly EmployerProfile $employerProfile
    )
    {
    }

    public function setEmployerProfile(CreateEmployerProfileData $employerProfileData): EmployerProfile
    {
        $employerProfile = new EmployerProfile();

        $employerProfile->setUserId($employerProfileData->userId);
        $employerProfile->setCompanyName($employerProfileData->companyName);
        $employerProfile->setPhone($employerProfileData->phone);
        $employerProfile->setAbout($employerProfileData->about);
        $employerProfile->setLocation($employerProfileData->location);
        $employerProfile->setWebsiteUrl($employerProfileData->websiteUrl);

        $employerProfile->save();

        return $employerProfile;
    }

    public function updateEmployerProfile(UpdateEmployerProfileData $employerProfileData): EmployerProfile
    {
        $employerProfile = $this->employerProfile->findByUserId($employerProfileData->userId);

        $employerProfile->setUserId($employerProfileData->userId);
        $employerProfile->setCompanyName($employerProfileData->companyName);
        $employerProfile->setPhone($employerProfileData->phone);
        $employerProfile->setAbout($employerProfileData->about);
        $employerProfile->setLocation($employerProfileData->location);
        $employerProfile->setWebsiteUrl($employerProfileData->websiteUrl);

        $employerProfile->save();

        return $employerProfile;
    }

    public function getEmployerProfile(GetEmployerProfileData $employerProfileData): EmployerProfile | null
    {
        return $this->employerProfile->findByUserId($employerProfileData->userId);
    }
}
