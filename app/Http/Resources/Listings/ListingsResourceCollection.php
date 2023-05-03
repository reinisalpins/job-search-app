<?php

namespace App\Http\Resources\Listings;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ListingsResourceCollection extends ResourceCollection
{
    public $collects = ListingResource::class;
}
