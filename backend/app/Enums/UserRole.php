<?php

namespace App\Enums;

enum UserRole:String
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN_PROJECT = 'admin_project';
}
