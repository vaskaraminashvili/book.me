<?php

namespace App\Models;

use App\Enums\Rent\PaymentStatus;
use App\Enums\Rent\RentStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

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

    public static function setRates($get, $set)
    {
        $number_of_days = self::calculateDaysDiff($get('date'));
        if ($get('daily_rate')) {
            if ($number_of_days > 1) {
                $full_rate = $number_of_days
                    * $get('daily_rate');
                return $set('rate', $full_rate);
            }
        } elseif ($get('rate')) {
            if ($number_of_days > 1) {
                $daily_rate = intval($get('rate')
                    / $number_of_days);
                return $set('daily_rate', $daily_rate);
            }
        }
    }

    public static function calculateDaysDiff($date): int
    {
        $number_of_days = 1;
        if (Str::contains($date, ' to ')) {
            $dates_array = explode(
                ' to ',
                $date
            );
            $end = Carbon::parse($dates_array[1]);
            $start = Carbon::parse($dates_array[0]);
            $number_of_days = intval($end->diffInDays($start, true)) + 1;
        }
        return $number_of_days;
    }

    public function flat(): HasOne
    {
        return $this->hasOne(Flat::class);
    }

}
