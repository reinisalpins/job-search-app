<?php

namespace App\Http\Resources\Listings;

use App\Models\Listings\JobListing;
use Illuminate\Http\Resources\Json\JsonResource;

class JobListingResource extends JsonResource
{
    /**
     * @var JobListing
     */
    public $resource = JobListing::class;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
          'employment_type' => $this->resource->getEmploymentType(),
          'salary_range' => $this->resource->getSalaryRange(),
          'description' => $this->resource->getDescription(),
        ];
    }
}
