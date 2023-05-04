<?php

namespace App\Repositories\Listing;

use App\DataTransferObjects\Listing\CreateListingData;
use App\DataTransferObjects\Listing\UpdateListingData;
use App\Http\Resources\Listings\ListingResource;
use App\Http\Resources\Listings\ListingsResourceCollection;
use App\Models\Listings\ListingInfo;
use App\Models\Listings\Listing;
use Illuminate\Http\JsonResponse;

class ListingRepository
{
    public function saveListing(CreateListingData $createListingData): ListingResource
    {
        $listing = new Listing();
        $listing->setUserId($createListingData->userId);
        $listing->setListingTypeId($createListingData->listingType);
        $listing->setTitle($createListingData->title);
        $listing->setLocation($createListingData->location);
        $listing->setDatePosted(now());

        $listing->save();

        $listingInfo = new ListingInfo();
        $listingInfo->setListingId($listing->getId());
        $listingInfo->setEmploymentType($createListingData->employmentType);
        $listingInfo->setSalaryRange($createListingData->salaryRange);
        $listingInfo->setDescription($createListingData->description);

        $listingInfo->save();

        return new ListingResource($listing);
    }

    public function updateListing(UpdateListingData $updateListingData): ListingResource
    {
        $listing = Listing::findOrFail($updateListingData->listingId);
        $listing->setListingTypeId($updateListingData->listingType);
        $listing->setTitle($updateListingData->title);
        $listing->setLocation($updateListingData->location);

        $listing->save();

        $listingInfo = ListingInfo::where('listing_id', $listing->getId())->firstOrFail();
        $listingInfo->setEmploymentType($updateListingData->employmentType);
        $listingInfo->setSalaryRange($updateListingData->salaryRange);
        $listingInfo->setDescription($updateListingData->description);

        $listingInfo->save();

        return new ListingResource($listing);
    }

    public function deleteListing(int $listingId): JsonResponse
    {
        $listing = Listing::find($listingId);

        if ($listing) {
            $listing->delete();
            return response()->json(['message' => 'Listing has been soft deleted successfully.']);
        } else {
            return response()->json(['error' => 'Listing not found.'], 404);
        }
    }

    public function showSelectedEmployerListing(int $listingId): ListingResource|JsonResponse
    {
        $listing = Listing::find($listingId);

        if ($listing) {
            return new ListingResource($listing);
        } else {
            return response()->json(['error' => 'Listing not found.'], 404);
        }
    }

    public function showAllListings(): ListingsResourceCollection
    {
        $listings = Listing::all();

        return new ListingsResourceCollection($listings);
    }

    public function showAllEmployersListings(int $employerId): ListingsResourceCollection
    {
        $listings = Listing::where(Listing::USER_ID, $employerId)->get();

        return new ListingsResourceCollection($listings);
    }
}
