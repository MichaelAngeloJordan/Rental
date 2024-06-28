<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Owner = 'owner';
    case Driver = 'driver';
    case Customer = 'customer';

    public static function toArray(): array
    {
        return [
            self::Admin => 'Admin',
            self::Owner => 'Owner',
            self::Driver => 'Driver',
            self::Customer => 'Customer',
        ];
    }
}
