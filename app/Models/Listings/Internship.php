<?php

namespace App\Models\Listings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Internship extends Model
{
    use HasFactory;

    public const ID = 'id';
    public const LISTING_ID = 'listing_id';
    public const DURATION = 'duration';
    public const STIPEND = 'stipend';
    public const DESCRIPTION = 'description';

    protected $fillable = [self::LISTING_ID, self::DURATION, self::STIPEND, self::DESCRIPTION];
    protected $casts = [
        self::LISTING_ID => 'integer',
        self::DURATION => 'string',
        self::STIPEND => 'string',
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

    public function getDuration(): string
    {
        return $this->{self::DURATION};
    }

    public function getStipend(): string
    {
        return $this->{self::STIPEND};
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

    public function setDuration(string $duration): self
    {
        $this->{self::DURATION} = $duration;
        return $this;
    }

    public function setStipend(string $stipend): self
    {
        $this->{self::STIPEND} = $stipend;
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
