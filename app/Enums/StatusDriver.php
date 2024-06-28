<?php

namespace App\Enums;

enum StatusDriver: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Pending = 'pending';
    case Suspended = 'suspended';
    case Banned = 'banned';

    public static function toArray(): array
    {
        return [
            self::Active => 'Active',
            self::Inactive => 'Inactive',
            self::Pending => 'Pending',
            self::Suspended => 'Suspended',
            self::Banned => 'Banned',
        ];
    }
}
