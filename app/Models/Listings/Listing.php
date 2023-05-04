<?php

namespace App\Models\Listings;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const LISTING_TYPE_ID = 'listing_type_id';
    public const TITLE = 'title';
    public const LOCATION = 'location';
    public const DATE_POSTED = 'date_posted';
    public const LISTING_INFO = 'listingInfo';
    public const USER_RELATION = 'user';

    protected $fillable = [
        self::USER_ID,
        self::LISTING_TYPE_ID,
        self::TITLE,
        self::LOCATION,
        self::DATE_POSTED,
    ];

    protected $casts = [
        self::USER_ID => 'integer',
        self::LISTING_TYPE_ID => 'integer',
        self::TITLE => 'string',
        self::LOCATION => 'string',
        self::DATE_POSTED => 'datetime',
    ];

    public function getId(): int
    {
        return $this->{self::ID};
    }

    public function getUserId(): int
    {
        return $this->{self::USER_ID};
    }

    public function getListingTypeId(): int
    {
        return $this->{self::LISTING_TYPE_ID};
    }

    public function getTitle(): string
    {
        return $this->{self::TITLE};
    }

    public function getLocation(): string
    {
        return $this->{self::LOCATION};
    }

    public function getDatePosted(): \DateTimeInterface
    {
        return $this->{self::DATE_POSTED};
    }

    public function setUserId(int $userId): self
    {
        $this->{self::USER_ID} = $userId;
        return $this;
    }

    public function setListingTypeId(int $listingTypeId): self
    {
        $this->{self::LISTING_TYPE_ID} = $listingTypeId;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->{self::TITLE} = $title;
        return $this;
    }

    public function setLocation(string $location): self
    {
        $this->{self::LOCATION} = $location;
        return $this;
    }

    public function setDatePosted(\DateTimeInterface $datePosted): self
    {
        $this->{self::DATE_POSTED} = $datePosted;
        return $this;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function relatedUser(): User
    {
        return $this->{self::USER_RELATION};
    }

    public function listingType(): BelongsTo
    {
        return $this->belongsTo(ListingType::class, 'listing_type_id');
    }

    public function listingInfo(): HasOne
    {
        return $this->hasOne(ListingInfo::class, 'listing_id');
    }

    public function relatedListingInfo(): ListingInfo
    {
        return $this->{self::LISTING_INFO};
    }

}
