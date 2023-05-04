<?php

namespace App\DataTransferObjects\Listing;

use App\Http\Requests\Listing\UpdateListingRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateListingData extends DataTransferObject
{
    public int $listingId;
    public string $listingType;
    public string $title;
    public string $location;
    public string $employmentType;
    public string $salaryRange;
    public string $description;

    public static function fromRequest(UpdateListingRequest $request): self
    {
        return new self([
            'listingId' => $request->getListingId(),
            'listingType' => $request->input('listingType'),
            'title' => $request->input('title'),
            'location' => $request->input('location'),
            'employmentType' => $request->input('employmentType'),
            'salaryRange' => $request->input('salaryRange'),
            'description' => $request->input('description'),
        ]);
    }
}
