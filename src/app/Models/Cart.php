<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'session_id'];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь с товарами в корзине
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Вычисление общей суммы (бизнес-логика в модели!)
    public function getTotalPrice()
    {
        return $this->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
    }

    // Вычисление общего количества
    public function getTotalQuantity()
    {
        return $this->items->sum('quantity');
    }
}