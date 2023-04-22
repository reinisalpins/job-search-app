<?php

namespace App\Models;

use App\Models\User\UserProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ID = 'id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const PHONE = 'phone';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';

    protected $fillable = [
        self::FIRST_NAME,
        self::LAST_NAME,
        self::PHONE,
        self::EMAIL,
        self::PASSWORD,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function getId(): int
    {
        return $this->{self::ID};
    }

    public function getFirstName(): string
    {
        return $this->{self::FIRST_NAME};
    }

    public function setFirstName(string $firstName): void
    {
        $this->{self::FIRST_NAME} = $firstName;
    }

    public function getLastName(): string
    {
        return $this->{self::LAST_NAME};
    }

    public function setLastName(string $lastName): void
    {
        $this->{self::LAST_NAME} = $lastName;
    }

    public function getPhone(): string
    {
        return $this->{self::PHONE};
    }

    public function setPhone(string $phone): void
    {
        $this->{self::PHONE} = $phone;
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
}
