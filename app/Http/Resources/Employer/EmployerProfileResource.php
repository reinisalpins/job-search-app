<?php

namespace App\Http\Resources\Employer;

use App\Models\Employer\EmployerProfile;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployerProfileResource extends JsonResource
{
    /**
     * @var EmployerProfile
     */
    public $resource = EmployerProfile::class;

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
            'company_name' => $this->resource->getCompanyName(),
            'phone' => $this->resource->getPhone(),
            'about' => $this->resource->getAbout(),
            'location' => $this->resource->getLocation(),
            'website_url' => $this->resource->getWebsiteUrl(),
        ];
    }
}
