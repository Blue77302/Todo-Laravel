<?php

namespace App\Enums;

enum UserStatus: int
{
    const PENDING = 0;
    const APPROVED = 1;
    const DENIED = 2;
    const LOCKED = 3;
}