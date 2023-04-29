<?php

namespace App\Models\Listings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListingType extends Model
{
    use HasFactory;

    public const ID = 'id';
    public const NAME = 'name';

    protected $fillable = [self::NAME];

    protected $casts = [self::NAME => 'string'];


    public function getId(): int
    {
        return $this->{self::ID};
    }

    public function getName(): string
    {
        return $this->{self::NAME};
    }

    public function setName(string $name): self
    {
        $this->{self::NAME} = $name;
        return $this;
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'listing_type_id');
    }
}
