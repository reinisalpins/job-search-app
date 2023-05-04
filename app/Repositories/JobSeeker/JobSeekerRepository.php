<?php

namespace App\Repositories\JobSeeker;

use App\DataTransferObjects\JobSeeker\CreateJobSeekerProfileData;
use App\DataTransferObjects\JobSeeker\GetJobSeekerProfileData;
use App\Models\JobSeeker;
use App\Models\JobSeeker\JobSeekerProfile;

class JobSeekerRepository
{
    public function __construct(
        private readonly JobSeekerProfile $jobSeekerProfile,
        private readonly User             $user,
    )
    {
    }

    public function showJobSeekerProfile(GetJobSeekerProfileData $dataTransferObject): JobSeekerProfile
    {
        return $this->jobSeekerProfile
            ->where(JobSeekerProfile::USER_ID, '=', $dataTransferObject->userId)->first();
    }

    public function setJobSeekerProfile(CreateJobSeekerProfileData $userProfileData): JobSeekerProfile
    {
        $userProfile = $this->jobSeekerProfile;

        $userProfile->setUserId($userProfileData->userId);
        $userProfile->setSkills($userProfileData->skills);
        $userProfile->setExperience($userProfileData->experience);
        $userProfile->setEducation($userProfileData->education);
        $userProfile->setLocation($userProfileData->location);
        $userProfile->setLanguages($userProfileData->languages);

        $userProfile->save();

        return $userProfile;
    }

    public function editJobSeekerProfile(CreateJobSeekerProfileData $userProfileData): JobSeekerProfile
    {
        $userProfile = $this->jobSeekerProfile
            ->where(JobSeekerProfile::USER_ID, '=', $userProfileData->userId)->first();

        $userProfile->setSkills($userProfileData->skills);
        $userProfile->setExperience($userProfileData->experience);
        $userProfile->setEducation($userProfileData->education);
        $userProfile->setLocation($userProfileData->location);
        $userProfile->setLanguages($userProfileData->languages);

        $userProfile->save();

        return $userProfile;
    }
}
