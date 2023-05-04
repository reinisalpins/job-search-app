<?php

namespace App\Models\JobSeeker;

use App\Models\JobSeeker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobSeekerProfile extends Model
{
    use HasFactory;

    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const SKILLS = 'skills';
    public const EXPERIENCE = 'experience';
    public const EDUCATION = 'education';
    public const LANGUAGES = 'languages';
    public const LOCATION = 'location';

    protected $fillable = [self::USER_ID, self::SKILLS, self::EXPERIENCE, self::EDUCATION, self::LOCATION, self::LANGUAGES];

    protected $casts = [
        self::USER_ID => 'integer',
        self::SKILLS => 'array',
        self::EXPERIENCE => 'string',
        self::EDUCATION => 'string',
        self::LOCATION => 'string',
        self::LANGUAGES => 'array'
    ];

    public function getId(): int
    {
        return $this->{self::ID};
    }

    public function getUserId(): int
    {
        return $this->{self::USER_ID};
    }

    public function setUserId(int $userId): void
    {
        $this->{self::USER_ID} = $userId;
    }

    public function getSkills(): ?array
    {
        return $this->{self::SKILLS};
    }

    public function setSkills(?array $skills): void
    {
        $this->{self::SKILLS} = $skills;
    }

    public function getExperience(): ?string
    {
        return $this->{self::EXPERIENCE};
    }

    public function setExperience(string $experience): void
    {
        $this->{self::EXPERIENCE} = $experience;
    }

    public function getEducation(): ?string
    {
        return $this->{self::EDUCATION};
    }

    public function setEducation(string $education): void
    {
        $this->{self::EDUCATION} = $education;
    }

    public function getLocation(): ?string
    {
        return $this->{self::LOCATION};
    }

    public function setLocation(?string $location): void
    {
        $this->{self::LOCATION} = $location;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLanguages(): ?array
    {
        return $this->{self::LANGUAGES};
    }

    public function setLanguages(?array $languages): void
    {
        $this->{self::LANGUAGES} = $languages;
    }
}


