<?php

namespace App\Models\Employer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ID = 'id';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const COMPANY_NAME = 'company';
    public const COMPANY_PHONE = 'phone';

    protected $fillable = [
        self::EMAIL,
        self::PASSWORD,
        self::COMPANY_NAME,
        self::COMPANY_PHONE,
    ];

    public function getEmail(): string
    {
        return $this->{self::EMAIL};
    }

    public function setEmail(string $email): self
    {
        $this->{self::EMAIL} = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->{self::PASSWORD};
    }

    public function setPassword(string $password): self
    {
        $this->{self::PASSWORD} = $password;
        return $this;
    }

    public function setCompany(string $company): self
    {
        $this->{self::COMPANY_NAME} = $company;
        return $this;
    }

    public function getCompany(): string
    {
        return $this->{self::COMPANY_NAME};
    }

    public function setCompanyPhone(string $number): self
    {
        $this->{self::COMPANY_PHONE} = $number;
        return $this;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(EmployerProfile::class, 'auth_id');
    }
}
