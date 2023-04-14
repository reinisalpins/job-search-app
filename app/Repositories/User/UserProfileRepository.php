<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\DataTransferObjects\User\CreateUserProfileData;
use App\DataTransferObjects\User\GetUserProfileDataTransferObject;
use App\Models\User\UserProfile;

class UserProfileRepository
{
    public function __construct(
        private readonly UserProfile $userProfile,
    )
    {
    }

    public function showUserProfile(GetUserProfileDataTransferObject $dataTransferObject): UserProfile
    {
        return $this->userProfile
            ->where(UserProfile::USER_ID, '=', $dataTransferObject->userId)->first();
    }

    public function setUserProfile(CreateUserProfileData $userProfileData): UserProfile
    {
        $userProfile = $this->userProfile;

        $userProfile->setUserId($userProfileData->userId);
        $userProfile->setSkills($userProfileData->skills);
        $userProfile->setExperience($userProfileData->experience);
        $userProfile->setEducation($userProfileData->education);
        $userProfile->setLocation($userProfileData->location);

        $userProfile->save();

        return $userProfile;
    }

    public function editUserProfile(CreateUserProfileData $userProfileData): UserProfile
    {
        $userProfile = $this->userProfile
            ->where(UserProfile::USER_ID, '=', $userProfileData->userId)->first();

        $userProfile->setSkills($userProfileData->skills);
        $userProfile->setExperience($userProfileData->experience);
        $userProfile->setEducation($userProfileData->education);
        $userProfile->setLocation($userProfileData->location);

        $userProfile->save();

        return $userProfile;
    }
}
