<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id'];

    // Связь с пользователем
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Связь с товарами в корзине
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // Вычисление общей суммы
    public function getTotalPrice(): float
    {
        return $this->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
    }

    // Вычисление общего количества товаров
    public function getTotalQuantity(): int
    {
        return $this->items->sum('quantity');
    }
}
