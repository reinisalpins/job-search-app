<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\CreateEmployerProfileRequest;
use App\Http\Requests\Employer\GetEmployerProfileRequest;
use App\Http\Requests\Employer\UpdateEmployerProfileRequest;
use App\Http\Resources\Employer\EmployerProfileResource;
use App\Repositories\Employer\EmployerRepository;
use Illuminate\Http\JsonResponse;

class EmployerController extends Controller
{
    public function __construct(private readonly EmployerRepository $employerRepository)
    {
    }

    public function setEmployerProfileInformation(CreateEmployerProfileRequest $request): EmployerProfileResource
    {
        $employerProfile = $this->employerRepository->setEmployerProfile($request->dataTransferObject());

        return new EmployerProfileResource($employerProfile);
    }

    public function updateEmployerProfileInformation(UpdateEmployerProfileRequest $request): EmployerProfileResource
    {
        $employerProfile = $this->employerRepository->updateEmployerProfile($request->dataTransferObject());

        return new EmployerProfileResource($employerProfile);
    }

    public function getEmployerProfileInformation(GetEmployerProfileRequest $request): EmployerProfileResource | JsonResponse
    {
        $employerProfile = $this->employerRepository->getEmployerProfile($request->dataTransferObject());

        if ($employerProfile) {
            return new EmployerProfileResource($employerProfile);
        }else {
            return response()->json(['status' => 'User profile not set yet',], 200);
        }
    }
}
