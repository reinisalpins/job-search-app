<?php

namespace App\Http\Requests\Listing;

use App\DataTransferObjects\Listing\UpdateListingData;
use App\Helpers\Rules\RulesHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateListingRequest extends FormRequest
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
            'title' => [RulesHelper::REQUIRED, RulesHelper::STRING, RulesHelper::max(255)],
            'location' => [RulesHelper::REQUIRED, RulesHelper::STRING, RulesHelper::max(255)],
            'employmentType' => [RulesHelper::STRING, RulesHelper::REQUIRED],
            'salaryRange' => [RulesHelper::REQUIRED, RulesHelper::STRING],
            'description' => [RulesHelper::REQUIRED, RulesHelper::STRING]
        ];
    }

    public function dataTransferObject(): UpdateListingData
    {
        return UpdateListingData::fromRequest($this);
    }

    public function getListingId(): int
    {
        return $this->route('listingId');
    }
}
