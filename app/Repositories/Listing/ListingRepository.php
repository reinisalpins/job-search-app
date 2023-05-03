<?php

namespace App\Repositories\Listing;

use App\DataTransferObjects\Listing\JobListing\CreateJobListingData;
use App\DataTransferObjects\Listing\JobListing\UpdateJobListingData;
use App\Http\Resources\Listings\ListingResource;
use App\Http\Resources\Listings\ListingsResourceCollection;
use App\Models\Listings\JobListing;
use App\Models\Listings\Listing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListingRepository
{
    public function saveJobListing(CreateJobListingData $jobListingData): ListingResource
    {
        $listing = new Listing();
        $listing->setUserId($jobListingData->userId);
        $listing->setListingTypeId($jobListingData->listingType);
        $listing->setTitle($jobListingData->title);
        $listing->setLocation($jobListingData->location);
        $listing->setDatePosted(now());

        $listing->save();

        $jobListing = new JobListing();
        $jobListing->setListingId($listing->getId());
        $jobListing->setEmploymentType($jobListingData->employmentType);
        $jobListing->setSalaryRange($jobListingData->salaryRange);
        $jobListing->setDescription($jobListingData->description);

        $jobListing->save();

        return new ListingResource($listing);
    }

    public function updateJobListing(UpdateJobListingData $jobListingData): ListingResource
    {
        $listing = Listing::findOrFail($jobListingData->listingId);
        $listing->setListingTypeId($jobListingData->listingType);
        $listing->setTitle($jobListingData->title);
        $listing->setLocation($jobListingData->location);

        $listing->save();

        $jobListing = JobListing::where('listing_id', $listing->getId())->firstOrFail();
        $jobListing->setEmploymentType($jobListingData->employmentType);
        $jobListing->setSalaryRange($jobListingData->salaryRange);
        $jobListing->setDescription($jobListingData->description);

        $jobListing->save();

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

    public function showListing(int $listingId): ListingResource|JsonResponse
    {
        $listing = Listing::find($listingId);

        if ($listing) {
            return new ListingResource($listing);
        } else {
            return response()->json(['error' => 'Listing not found.'], 404);
        }
    }

    public function showAllJobListings(): ListingsResourceCollection
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
