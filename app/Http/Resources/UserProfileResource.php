<?php

namespace App\Http\Resources;

use App\Models\User\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * @var UserProfile
     */

    public $resource = UserProfile::class;
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
            'location' => $this->resource->getLocation(),
        ];
    }
}
