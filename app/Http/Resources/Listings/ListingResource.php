<?php

namespace App\Http\Resources\Listings;

use App\Http\Resources\Employer\EmployerResource;
use App\Models\Listings\Listing;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    /**
     * @var Listing
     */
    public $resource = Listing::class;

    public function toArray($request): array
    {
        return [
            'listing_id' => $this->resource->getId(),
            'title' => $this->resource->getTitle(),
            'location' => $this->resource->getLocation(),
            'listing_type' => $this->resource->getListingTypeId(),
            'related_listing' => JobListingResource::make($this->resource->relatedJobListing()),
            'related_employer' => EmployerResource::make($this->resource->relatedUser()),
            'date_posted' => $this->resource->getDatePosted()
        ];
    }
}
