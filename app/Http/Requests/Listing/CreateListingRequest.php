<?php

namespace App\Http\Requests\Listing;

use App\DataTransferObjects\Listing\CreateListingData;
use App\Enums\Listings\ListingTypeEnum;
use App\Helpers\Rules\RulesHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateListingRequest extends FormRequest
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
            'userId' => [RulesHelper::existsOnDatabase('users', 'id'),
                RulesHelper::REQUIRED,
                RulesHelper::existsOnDatabase('employer_profiles', 'user_id')
            ],
            'listingType' => [RulesHelper::REQUIRED, new Enum(ListingTypeEnum::class)],
            'title' => [RulesHelper::REQUIRED, RulesHelper::STRING, RulesHelper::max(255)],
            'location' => [RulesHelper::REQUIRED, RulesHelper::STRING, RulesHelper::max(255)],
            'employmentType' => [RulesHelper::STRING, RulesHelper::REQUIRED],
            'salaryRange' => [RulesHelper::REQUIRED, RulesHelper::STRING],
            'description' => [RulesHelper::REQUIRED, RulesHelper::STRING]
        ];
    }

    public function dataTransferObject(): CreateListingData
    {
        return CreateListingData::fromRequest($this);
    }
}
