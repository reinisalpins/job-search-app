<?php

namespace App\Models;

use App\Models\Employer\EmployerProfile;
use App\Models\JobSeeker\JobSeekerProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ID = 'id';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const USER_TYPE = 'user_type';
    public const EMPLOYER_PROFILE_RELATION = 'employerProfile';

    protected $fillable = [
        self::EMAIL,
        self::PASSWORD,
        self::USER_TYPE
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userProfile(): HasOne
    {
        return $this->hasOne(JobSeekerProfile::class, 'user_id');
    }

    public function employerProfile(): HasOne
    {
        return $this->hasOne(EmployerProfile::class, 'user_id');
    }

    public function relatedEmployerProfile(): EmployerProfile
    {
        return $this->{self::EMPLOYER_PROFILE_RELATION};
    }

    public function getId(): int
    {
        return $this->{self::ID};
    }

    public function getEmail(): string
    {
        return $this->{self::EMAIL};
    }

    public function setEmail(string $email): void
    {
        $this->{self::EMAIL} = $email;
    }

    public function getPassword(): string
    {
        return $this->{self::PASSWORD};
    }

    public function setPassword(string $password): void
    {
        $this->{self::PASSWORD} = $password;
    }

    public function setUserType(string $type): void
    {
        $this->{self::USER_TYPE} = $type;
    }

    public function getUserType(): string
    {
        return $this->{self::USER_TYPE};
    }
}
