<?php

namespace App\Enums\Rent;

enum RentStatus: string
{

    case Draft = 'Draft';
    case Cancelled = 'Cancelled';
    case Booked = 'Booked';

    public function getColor(): string
    {
        return match ($this) {
            self::Draft => 'warning',
            self::Cancelled => 'danger',
            self::Booked => 'success',
        };
    }

}
