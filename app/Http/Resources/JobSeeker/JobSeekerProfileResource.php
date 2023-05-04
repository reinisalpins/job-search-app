<?php

namespace App\Http\Resources\JobSeeker;

use App\Models\JobSeeker\JobSeekerProfile;
use Illuminate\Http\Resources\Json\JsonResource;

class JobSeekerProfileResource extends JsonResource
{
    /**
     * @var JobSeekerProfile
     */

    public $resource = JobSeekerProfile::class;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->getId(),
            'user_id' => $this->resource->getUserId(),
            'skills' => $this->resource->getSkills(),
            'experience' => $this->resource->getExperience(),
            'education' => $this->resource->getEducation(),
            'languages' => $this->resource->getLanguages(),
            'location' => $this->resource->getLocation(),
        ];
    }
}
