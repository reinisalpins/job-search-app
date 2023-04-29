<?php

namespace App\Models\Listings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreelanceListing extends Model
{
    use HasFactory;

    public const ID = 'id';
    public const LISTING_ID = 'listing_id';
    public const PROJECT_TYPE = 'project_type';
    public const BUDGET = 'budget';
    public const DESCRIPTION = 'description';

    protected $fillable = [self::LISTING_ID, self::PROJECT_TYPE, self::BUDGET, self::DESCRIPTION];

    protected $casts = [
        self::LISTING_ID => 'integer',
        self::PROJECT_TYPE => 'string',
        self::BUDGET => 'string',
        self::DESCRIPTION => 'string',
    ];

// Getters and Setters
    public function getId(): int
    {
        return $this->{self::ID};
    }

    public function getListingId(): int
    {
        return $this->{self::LISTING_ID};
    }

    public function getProjectType(): string
    {
        return $this->{self::PROJECT_TYPE};
    }

    public function getBudget(): string
    {
        return $this->{self::BUDGET};
    }

    public function getDescription(): string
    {
        return $this->{self::DESCRIPTION};
    }

    public function setListingId(int $listingId): self
    {
        $this->{self::LISTING_ID} = $listingId;
        return $this;
    }

    public function setProjectType(string $projectType): self
    {
        $this->{self::PROJECT_TYPE} = $projectType;
        return $this;
    }

    public function setBudget(string $budget): self
    {
        $this->{self::BUDGET} = $budget;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->{self::DESCRIPTION} = $description;
        return $this;
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
