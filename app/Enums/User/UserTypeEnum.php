<?php

namespace App\Enums\User;

enum UserTypeEnum: string
{
    case JOB_SEEKER = 'job_seeker';
    case EMPLOYER = 'employer';
    case ADMIN = 'admin';
}
