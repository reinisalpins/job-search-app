<?php

declare(strict_types=1);

namespace App\Repositories\Auth;

use App\DataTransferObjects\Auth\ChangePasswordData;
use App\DataTransferObjects\Auth\EmployerRegisterDataTransferObject;
use App\DataTransferObjects\Auth\RegisterDataTransferObject;
use App\Models\Employer\Employer;
use App\Models\JobSeeker;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function __construct(
        private readonly User $user,
        private readonly Employer $employer,
    )
    {
    }

    public function register(RegisterDataTransferObject $dataTransferObject): string
    {
        $user = new User();
        $user->setEmail($dataTransferObject->email);
        $user->setPassword(Hash::make($dataTransferObject->password));
        $user->setUserType($dataTransferObject->userType);

        $user->save();

        return $user->createToken('my-app-token')->plainTextToken;
    }

    public function changePassword(ChangePasswordData $userPasswordData): JsonResponse
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
