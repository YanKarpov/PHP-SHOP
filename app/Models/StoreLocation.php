\
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreLocation extends Model
{
    protected $fillable = [
        'name','city','address','phone','email','lat','lng','hours','is_active'
    ];

    protected $casts = [
        'hours' => 'array',
        'is_active' => 'boolean',
    ];
}
