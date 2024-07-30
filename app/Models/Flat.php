<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flat extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'title',
            'status',
        ];

    // 'id',
    //        'title',
    //        'description',
    //        'date_from',
    //        'date_to',
    //        'amount',
    //        'currency',
    //        'lessee_id',
    //        'lessor_id',
    //        'property_id',
    //        'status',
    //        'bedrooms',
    //        'bathrooms',
    //        'floor_area',
    //        'furnished',
    //        'pets_allowed',
    //        'smoking_allowed',
    //        'parking_spaces',
    //        'amenities',
    //        'address',
    //        'city',
    //        'state',
    //        'zip_code',
    //        'country',
    //        'latitude',
    //        'longitude',
    //        'security_deposit',
    //        'utilities_included',
    //        'lease_terms',
    //        'payment_frequency',
    //        'created_at',
    //        'updated_at',
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'id' => 'integer',
        ];

    public function rents(): HasMany
    {
        return $this->hasMany(Rent::class);
    }

}
