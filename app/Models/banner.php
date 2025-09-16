<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'alt_text',
        'link_url',
        'target',
        'position',
        'type',
        'is_active',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Типы баннеров
    const TYPE_MAIN = 'main';
    const TYPE_SIDEBAR = 'sidebar';
    const TYPE_FOOTER = 'footer';

    public static function getTypes()
    {
        return [
            self::TYPE_MAIN => 'Основной',
            self::TYPE_SIDEBAR => 'Боковая панель',
            self::TYPE_FOOTER => 'Футер'
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function($q) {
                        $q->whereNull('start_date')
                          ->orWhere('start_date', '<=', now());
                    })
                    ->where(function($q) {
                        $q->whereNull('end_date')
                          ->orWhere('end_date', '>=', now());
                    });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('position')->orderBy('created_at', 'desc');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}