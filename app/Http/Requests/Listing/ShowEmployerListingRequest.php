<?php

namespace App\Http\Requests\Listing;

use App\Helpers\Rules\RulesHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class ShowEmployerListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $userIdBelongsToListing = RulesHelper::userIdBelongsToListing($this->getListingId());
        $result = $userIdBelongsToListing(null, $this->getEmployerId(), function ($message) {
            throw new AuthorizationException($message);
        });

        return $result !== false;
    }

    public function rules(): array
    {
        return [
           //
        ];
    }

    public function getListingId(): int
    {
        return $this->route('listingId');
    }

    public function getEmployerId(): int
    {
        return $this->route('userId');
    }
}
