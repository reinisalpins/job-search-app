<?php

namespace App\Models\Employer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployerProfile extends Model
{
    use HasFactory;

    public const ID  = 'id';
    public const USER_ID = 'user_id';
    public const COMPANY_NAME = 'company_name';
    public const PHONE = 'phone';
    public const ABOUT = 'about';
    public const LOCATION = 'location';
    public const WEBSITE_URL = 'website_url';

    protected $fillable = [
        self::USER_ID,
        self::COMPANY_NAME,
        self::PHONE,
        self::ABOUT,
        self::LOCATION,
        self::WEBSITE_URL,
    ];

    public function getId(): int
    {
        return $this->{self::ID};
    }

    public function getUserId(): int
    {
        return $this->{self::USER_ID};
    }

    public function setUserId(int $user_id): self
    {
        $this->{self::USER_ID} = $user_id;
        return $this;
    }

    public function getCompanyName(): string
    {
        return $this->{self::COMPANY_NAME};
    }

    public function setCompanyName(string $company_name): self
    {
        $this->{self::COMPANY_NAME} = $company_name;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->{self::PHONE};
    }

    public function setPhone(?string $phone): self
    {
        $this->{self::PHONE} = $phone;
        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->{self::ABOUT};
    }

    public function setAbout(?string $about): self
    {
        $this->{self::ABOUT} = $about;
        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->{self::LOCATION};
    }

    public function setLocation(?string $location): self
    {
        $this->{self::LOCATION} = $location;
        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->{self::WEBSITE_URL};
    }

    public function setWebsiteUrl(?string $website_url): self
    {
        $this->{self::WEBSITE_URL} = $website_url;
        return $this;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function findByUserId(int $user_id): ?self
    {
        return self::where('user_id', $user_id)->first();
    }

}
