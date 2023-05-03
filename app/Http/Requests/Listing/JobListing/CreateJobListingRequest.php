<?php

namespace App\Http\Requests\Listing\JobListing;

use App\DataTransferObjects\Listing\JobListing\CreateJobListingData;
use App\Enums\Listings\ListingTypeEnum;
use App\Helpers\Rules\RulesHelper;
use Illuminate\Foundation\Http\FormRequest;

class CreateJobListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userId' => [RulesHelper::existsOnDatabase('users', 'id'), RulesHelper::REQUIRED],
            'listingType' => [RulesHelper::REQUIRED, RulesHelper::IN . ListingTypeEnum::JOB->value],
            'title' => [RulesHelper::REQUIRED, RulesHelper::STRING, RulesHelper::max(255)],
            'location' => [RulesHelper::REQUIRED, RulesHelper::STRING, RulesHelper::max(255)],
            'employmentType' => [RulesHelper::STRING, RulesHelper::REQUIRED],
            'salaryRange' => [RulesHelper::REQUIRED, RulesHelper::STRING],
            'description' => [RulesHelper::REQUIRED, RulesHelper::STRING]
        ];
    }

    public function dataTransferObject(): CreateJobListingData
    {
        return CreateJobListingData::fromRequest($this);
    }
}
