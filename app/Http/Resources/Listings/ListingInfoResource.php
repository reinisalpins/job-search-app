<?php

namespace App\Http\Resources\Listings;

use App\Models\Listings\ListingInfo;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingInfoResource extends JsonResource
{
    /**
     * @var ListingInfo
     */
    public $resource = ListingInfo::class;

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
