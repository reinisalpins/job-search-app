<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobSeeker\CreateJobSeekerProfileRequest;
use App\Http\Requests\JobSeeker\GetJobSeekerProfileRequest;
use App\Http\Resources\JobSeeker\JobSeekerProfileResource;
use App\Repositories\JobSeeker\JobSeekerRepository;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class JobSeekerController extends Controller
{
    public function __construct(private readonly JobSeekerRepository $jobSeekerRepository)
    {
    }

    /**
     * @throws UnknownProperties
     */
    public function getJobSeekerProfileInformation(GetJobSeekerProfileRequest $request): JobSeekerProfileResource
    {
        $jobSeekerProfile = $this->jobSeekerRepository->showJobSeekerProfile($request->dataTransferObject());
        return new JobSeekerProfileResource($jobSeekerProfile);
    }

    /**
     * @throws UnknownProperties
     */
    public function setJobSeekerProfileInformation(CreateJobSeekerProfileRequest $request): JobSeekerProfileResource
    {
        $jobSeekerProfile = $this->jobSeekerRepository->setJobSeekerProfile($request->dataTransferObject());
        return new JobSeekerProfileResource($jobSeekerProfile);
    }

    public function patchJobSeekerProfileInformation(CreateJobSeekerProfileRequest $request): JobSeekerProfileResource
    {
        $jobSeekerProfile = $this->jobSeekerRepository->editJobSeekerProfile($request->dataTransferObject());
        return new JobSeekerProfileResource($jobSeekerProfile);
    }

    /**
     * @throws UnknownProperties
     */
}
