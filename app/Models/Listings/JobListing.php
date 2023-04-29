<?php

namespace App\Models\Listings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobListing extends Model
{
    use HasFactory;

    public const ID = 'id';
    public const LISTING_ID = 'listing_id';
    public const EMPLOYMENT_TYPE = 'employment_type';
    public const SALARY_RANGE = 'salary_range';
    public const DESCRIPTION = 'description';

    protected $fillable = [self::LISTING_ID, self::EMPLOYMENT_TYPE, self::SALARY_RANGE, self::DESCRIPTION];

    protected $casts = [
        self::LISTING_ID => 'integer',
        self::EMPLOYMENT_TYPE => 'string',
        self::SALARY_RANGE => 'string',
        self::DESCRIPTION => 'string',
    ];

    public function getId(): int
    {
        return $this->{self::ID};
    }

    public function getListingId(): int
    {
        return $this->{self::LISTING_ID};
    }

    public function getEmploymentType(): string
    {
        return $this->{self::EMPLOYMENT_TYPE};
    }

    public function getSalaryRange(): string
    {
        return $this->{self::SALARY_RANGE};
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

    public function setEmploymentType(string $employmentType): self
    {
        $this->{self::EMPLOYMENT_TYPE} = $employmentType;
        return $this;
    }

    public function setSalaryRange(string $salaryRange): self
    {
        $this->{self::SALARY_RANGE} = $salaryRange;
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
