<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserProfileInfoRequest;
use App\Http\Requests\User\GetUserProfileInfoRequest;
use App\Http\Resources\UserProfileResource;
use App\Repositories\User\UserProfileRepository;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserController extends Controller
{
    public function __construct(private readonly UserProfileRepository $userProfileRepository)
    {
    }

    /**
     * @throws UnknownProperties
     */
    public function getUserProfileInformation(GetUserProfileInfoRequest $request): UserProfileResource
    {
        $userProfile = $this->userProfileRepository->showUserProfile($request->dataTransferObject());
        return new UserProfileResource($userProfile);
    }

    /**
     * @throws UnknownProperties
     */
    public function setUserProfileInformation(CreateUserProfileInfoRequest $request): UserProfileResource
    {
        $userProfile = $this->userProfileRepository->setUserProfile($request->dataTransferObject());
        return new UserProfileResource($userProfile);
    }

    public function patchUserProfileInformation(CreateUserProfileInfoRequest $request): UserProfileResource
    {
        $userProfile = $this->userProfileRepository->editUserProfile($request->dataTransferObject());
        return new UserProfileResource($userProfile);
    }
}
