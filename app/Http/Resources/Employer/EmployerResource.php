<?php

namespace App\Http\Resources\Employer;

use App\Models\Employer\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployerResource extends JsonResource
{
    /**
     * @var User
     */
    public $resource = User::class;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->resource->getId(),
            'email' => $this->resource->getEmail(),
            'related_profile' => EmployerProfileResource::make($this->resource->relatedEmployerProfile())
        ];
    }
}
