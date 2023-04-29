<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Listing\CreateJobListingRequest;
use App\Repositories\Listing\ListingRepository;

class ListingController extends Controller
{
    public function __construct(private readonly ListingRepository $listingRepository)
    {
    }

    public function createJobListing(CreateJobListingRequest $request): void
    {
        $this->listingRepository->saveJobListing($request->dataTransferObject());
    }
}
