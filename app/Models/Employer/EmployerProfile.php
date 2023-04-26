<?php

namespace App\Models\Employer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployerProfile extends Model
{
    use HasFactory;

    public const AUTH_ID = 'auth_id';
    public const COMPANY_WEBSITE = 'company_website';
    public const COMPANY_LOGO = 'company_logo';
    public const COMPANY_DESCRIPTION = 'company_description';

    protected $fillable = [
        self::AUTH_ID,
        self::COMPANY_WEBSITE,
        self::COMPANY_LOGO,
        self::COMPANY_DESCRIPTION,
    ];

    public function getAuthId(): int
    {
        return $this->{self::AUTH_ID};
    }

    public function setAuthId(int $auth_id): self
    {
        $this->{self::AUTH_ID} = $auth_id;
        return $this;
    }

    public function getCompanyWebsite(): ?string
    {
        return $this->{self::COMPANY_WEBSITE};
    }

    public function setCompanyWebsite(?string $company_website): self
    {
        $this->{self::COMPANY_WEBSITE} = $company_website;
        return $this;
    }

    public function getCompanyLogo(): ?string
    {
        return $this->{self::COMPANY_LOGO};
    }

    public function setCompanyLogo(?string $company_logo): self
    {
        $this->{self::COMPANY_LOGO} = $company_logo;
        return $this;
    }

    public function getCompanyDescription(): ?string
    {
        return $this->{self::COMPANY_DESCRIPTION};
    }

    public function setCompanyDescription(?string $company_description): self
    {
        $this->{self::COMPANY_DESCRIPTION} = $company_description;
        return $this;
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class, 'auth_id');
    }
}
