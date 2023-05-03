<?php

namespace App\Http\Requests\Listing\JobListing;

use App\DataTransferObjects\Listing\JobListing\UpdateJobListingData;
use App\Enums\Listings\ListingTypeEnum;
use App\Helpers\Rules\RulesHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateJobListingRequest extends FormRequest
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
            'listingType' => [RulesHelper::REQUIRED, new Enum(ListingTypeEnum::class)],
            'title' => [RulesHelper::REQUIRED, RulesHelper::STRING, RulesHelper::max(255)],
            'location' => [RulesHelper::REQUIRED, RulesHelper::STRING, RulesHelper::max(255)],
            'employmentType' => [RulesHelper::STRING, RulesHelper::REQUIRED],
            'salaryRange' => [RulesHelper::REQUIRED, RulesHelper::STRING],
            'description' => [RulesHelper::REQUIRED, RulesHelper::STRING]
        ];
    }

    public function dataTransferObject(): UpdateJobListingData
    {
        return UpdateJobListingData::fromRequest($this);
    }

    public function getListingId(): int
    {
        return $this->route('listingId');
    }
}
