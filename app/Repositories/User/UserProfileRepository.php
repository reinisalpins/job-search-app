<?php

namespace App\Repositories\User;

use App\DataTransferObjects\User\ChangeUserPasswordData;
use App\DataTransferObjects\User\CreateUserProfileData;
use App\DataTransferObjects\User\GetUserProfileDataTransferObject;
use App\Models\User;
use App\Models\User\UserProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserProfileRepository
{
    public function __construct(
        private readonly UserProfile $userProfile,
        private readonly User $user,
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
        $userProfile->setLanguages($userProfileData->languages);

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
        $userProfile->setLanguages($userProfileData->languages);

        $userProfile->save();

        return $userProfile;
    }

    public function changeUserPassword(ChangeUserPasswordData $userPasswordData): JsonResponse
    {
        $user = $this->user->findOrFail($userPasswordData->userId);

        $newPassword = $userPasswordData->newPassword;
        $oldPassword = $userPasswordData->oldPassword;

        if (!Hash::check($oldPassword, $user->getPassword())) {
            return response()->json([
                'status' => 'error',
                'message' => 'The old password is incorrect.'
            ], 400);
        } else if ($oldPassword === $newPassword) {
            return response()->json([
                'status' => 'error',
                'message' => 'The new password cannot be the same as the old password.'
            ], 400);
        } else {
            $user->setPassword(Hash::make($newPassword));
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password changed successfully.'
            ], 200);
        }
    }

}
