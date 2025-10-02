<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'street',
        'city',
        'postal_code',
        'phone',
        'email',
        'map_url',
        'working_hours',
        'is_active',
    ];

    protected $casts = [
        'working_hours' => 'array',
        'is_active' => 'boolean',
    ];

    public function getFullAddressAttribute()
    {
        $address = $this->street;
        if ($this->city) {
            $address .= ', ' . $this->city;
        }
        if ($this->postal_code) {
            $address .= ', ' . $this->postal_code;
        }
        return $address;
    }

    public function getTelephoneHrefAttribute()
    {
        return 'tel:' . $this->phone;
    }
}
