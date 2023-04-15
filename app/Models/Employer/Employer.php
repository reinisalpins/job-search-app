<?php

namespace App\Models\Employer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employer extends Model
{
    use HasFactory;

    public const EMAIL = 'email';
    public const PASSWORD = 'password';

    protected $fillable = [
        self::EMAIL,
        self::PASSWORD,
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

    public function profile(): HasOne
    {
        return $this->hasOne(EmployerProfile::class, 'auth_id');
    }
}
