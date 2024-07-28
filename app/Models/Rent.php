<?php

namespace App\Models;

use App\Enums\Rent\PaymentStatus;
use App\Enums\Rent\RentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rent extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'lessee',
            'comment',
            'description',
            'date_from',
            'date_to',
            'status',
            'payment_status',
            'flat_id',
        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'id'             => 'integer',
            'date_from'      => 'date',
            'date_to'        => 'date',
            'status'         => RentStatus::class,
            'payment_status' => PaymentStatus::class,
        ];

    public function flat(): HasOne
    {
        return $this->hasOne(Flat::class);
    }

}
