<?php

namespace App\DataTransferObjects\Listing;

use App\Http\Requests\Listing\CreateListingRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateListingData extends DataTransferObject
{
    public int $userId;
    public string $listingType;
    public string $title;
    public string $location;
    public string $employmentType;
    public string $salaryRange;
    public string $description;

    public static function fromRequest(CreateListingRequest $request): self
    {
        return new self([
            'userId' => $request->input('userId'),
            'listingType' => $request->input('listingType'),
            'title' => $request->input('title'),
            'location' => $request->input('location'),
            'employmentType' => $request->input('employmentType'),
            'salaryRange' => $request->input('salaryRange'),
            'description' => $request->input('description'),
        ]);
    }
}
