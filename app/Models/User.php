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
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const USER_TYPE = 'user_type';

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

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function getId(): int
    {
        return $this->{self::ID};
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
