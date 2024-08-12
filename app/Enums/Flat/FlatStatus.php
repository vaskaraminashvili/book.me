<?php

namespace App\Enums\Flat;

enum FlatStatus: string
{

    case Active = 'Active';
    case NotActive = 'not active';

    public function getColor(): string
    {
        return match ($this) {
            self::Active => 'warning',
            self::NotActive => 'danger',
        };
    }

}
