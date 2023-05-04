<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Listing\CreateListingRequest;
use App\Http\Requests\Listing\DeleteListingRequest;
use App\Http\Requests\Listing\ShowAllEmployerListingsRequest;
use App\Http\Requests\Listing\ShowEmployerListingRequest;
use App\Http\Requests\Listing\UpdateListingRequest;
use App\Http\Resources\Listings\ListingResource;
use App\Http\Resources\Listings\ListingsResourceCollection;
use App\Repositories\Listing\ListingRepository;
use Illuminate\Http\JsonResponse;

class ListingController extends Controller
{
    public function __construct(private readonly ListingRepository $listingRepository)
    {
    }

    public function createListing(CreateListingRequest $request): ListingResource
    {
        return $this->listingRepository->saveListing($request->dataTransferObject());
    }

    public function updateListing(UpdateListingRequest $request): ListingResource
    {
        return $this->listingRepository->updateListing($request->dataTransferObject());
    }

    public function deleteSelectedListing(DeleteListingRequest $request): JsonResponse
    {
        return $this->listingRepository->deleteListing($request->getListingId());
    }

    public function getSelectedEmployerListing(ShowEmployerListingRequest $request): ListingResource | JsonResponse
    {
        return $this->listingRepository->showSelectedEmployerListing($request->getListingId());
    }

    public function getAllJobListings(): ListingsResourceCollection
    {
        return $this->listingRepository->showAllListings();
    }

    public function getAllEmployersListings(ShowAllEmployerListingsRequest $request): ListingsResourceCollection
    {
        return $this->listingRepository->showAllEmployersListings($request->getEmployerId());
    }
}
