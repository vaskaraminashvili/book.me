<?php

namespace App\Enums\Rent;

enum PaymentStatus: string
{

    case NotPaid = 'Not paid';
    case BPaid = 'B paid';
    case Partial = 'Partial';
    case Paid = 'Paid';

    public function getColors(): string
    {
        return match ($this) {
            self::NotPaid => 'danger',
            self::BPaid => 'info',
            self::Partial => 'warning',
            self::Paid => 'success',
        };
    }

}
