<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Listing\DeleteListingRequest;
use App\Http\Requests\Listing\JobListing\CreateJobListingRequest;
use App\Http\Requests\Listing\JobListing\UpdateJobListingRequest;
use App\Http\Requests\Listing\ShowAllEmployerListingsRequest;
use App\Http\Requests\Listing\ShowListingRequest;
use App\Http\Resources\Listings\ListingResource;
use App\Http\Resources\Listings\ListingsResourceCollection;
use App\Repositories\Listing\ListingRepository;
use Illuminate\Http\JsonResponse;

class ListingController extends Controller
{
    public function __construct(private readonly ListingRepository $listingRepository)
    {
    }

    public function createJobListing(CreateJobListingRequest $request): ListingResource
    {
        return $this->listingRepository->saveJobListing($request->dataTransferObject());
    }

    public function updateJobListing(UpdateJobListingRequest $request): ListingResource
    {
        return $this->listingRepository->updateJobListing($request->dataTransferObject());
    }

    public function deleteListing(DeleteListingRequest $request): JsonResponse
    {
        return $this->listingRepository->deleteListing($request->getListingId());
    }

    public function showListing(ShowListingRequest $request): ListingResource | JsonResponse
    {
        return $this->listingRepository->showListing($request->getListingId());
    }

    public function showAllJobListings(): ListingsResourceCollection
    {
        return $this->listingRepository->showAllJobListings();
    }

    public function showAllEmployersListings(ShowAllEmployerListingsRequest $request): ListingsResourceCollection
    {
        return $this->listingRepository->showAllEmployersListings($request->getEmployerId());
    }
}
