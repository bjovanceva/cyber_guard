<?php

namespace App\Enums;
enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case REVIEWER = 'reviewer';
    case USER = 'user';
}

