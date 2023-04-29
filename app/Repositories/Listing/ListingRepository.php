<?php

namespace App\Repositories\Listing;

use App\DataTransferObjects\Listing\CreateJobListingData;
use App\Models\Listings\JobListing;
use App\Models\Listings\Listing;

class ListingRepository
{
    public function saveJobListing(CreateJobListingData $jobListingData): void
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
    }
}
