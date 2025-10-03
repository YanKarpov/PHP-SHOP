<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина покупок</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .cart-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .cart-header {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .cart-header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .items-count {
            background: #e74c3c;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: normal;
        }

        .cart-content {
            padding: 30px;
        }

        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto auto;
            gap: 20px;
            align-items: center;
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            border-color: #3498db;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.15);
        }

        .product-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .product-name {
            font-weight: 700;
            font-size: 1.2em;
            color: #2c3e50;
        }

        .product-price {
            color: #7f8c8d;
            font-size: 0.95em;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 5px;
            border-radius: 10px;
            border: 1px solid #e1e8ed;
        }

        .quantity-btn {
            background: #3498db;
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: bold;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn:hover {
            background: #2980b9;
            transform: scale(1.1);
        }

        .quantity-btn.decrease {
            background: #e74c3c;
        }

        .quantity-btn.decrease:hover {
            background: #c0392b;
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            border: none;
            background: transparent;
            font-size: 1.1em;
            font-weight: 600;
            color: #2c3e50;
        }

        .quantity-input:focus {
            outline: none;
            background: #ecf0f1;
            border-radius: 5px;
        }

        .item-total {
            font-weight: 700;
            font-size: 1.3em;
            color: #27ae60;
            text-align: center;
        }

        .delete-btn {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .delete-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
        }

        .cart-summary {
            background: linear-gradient(135deg, #ecf0f1, #bdc3c7);
            padding: 25px;
            border-radius: 15px;
            text-align: center;
        }

        .total-amount {
            font-size: 2.2em;
            font-weight: 800;
            color: #2c3e50;
            margin: 15px 0;
        }

        .checkout-btn {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            border: none;
            padding: 18px 40px;
            border-radius: 12px;
            font-size: 1.2em;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(39, 174, 96, 0.3);
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: #7f8c8d;
        }

        .empty-cart-icon {
            font-size: 4em;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-cart h2 {
            font-size: 1.8em;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .continue-shopping {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .continue-shopping:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        /* Анимации */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .cart-item {
            animation: fadeIn 0.5s ease forwards;
        }

        .cart-item:nth-child(1) { animation-delay: 0.1s; }
        .cart-item:nth-child(2) { animation-delay: 0.2s; }
        .cart-item:nth-child(3) { animation-delay: 0.3s; }

        /* Адаптивность */
        @media (max-width: 768px) {
            .cart-item {
                grid-template-columns: 1fr;
                gap: 15px;
                text-align: center;
            }
            
            .quantity-controls {
                justify-content: center;
            }
            
            .cart-header h1 {
                font-size: 2em;
                flex-direction: column;
                gap: 10px;
            }
        }

        .debug-info {
            background: #34495e;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            font-family: monospace;
            font-size: 0.9em;
        }
        .clear-btn {
        background: #ff4d4f;
        border: none;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.2s;
    }

.clear-btn:hover {
    background: #d9363e;
}
    </style>
</head>
<body>
    <div class="cart-container">
        <div class="cart-header">
            <h1>
                🛒 Ваша корзина
                @if(isset($cart) && $cart->items->count() > 0)
                    <span class="items-count">{{ $cart->items->count() }} позиций</span>
                @endif
            </h1>
        </div>

        <div class="cart-content">
            @if(isset($cart) && $cart->items->count() > 0)
                <div class="cart-items">
                    @foreach($cart->items as $item)
                        <div class="cart-item">
                            <div class="product-info">
                                <div class="product-name">{{ $item->product->name }}</div>
                                <div class="product-price">{{ $item->price }} ₽ за шт.</div>
                            </div>

                            <div class="quantity-controls">
                                <form action="{{ route('cart.decrease', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="quantity-btn decrease">-</button>
                                </form>

                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" 
                                           class="quantity-input" onchange="this.form.submit()">
                                </form>

                                <form action="{{ route('cart.increase', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="quantity-btn">+</button>
                                </form>
                            </div>

                            <div class="item-total">
                                {{ $item->quantity * $item->price }} ₽
                            </div>

                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">
                                    🗑️ Удалить
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="cart-summary">
                    <div style="font-size: 1.3em; color: #2c3e50; margin-bottom: 10px;">Общая сумма</div>
                    <div class="total-amount">
                        {{ $cart->items->sum(function($item) { return $item->quantity * $item->price; }) }} ₽
                    </div>
                    <a href="#" class="checkout-btn">
                        💳 Перейти к оформлению
                    </a>
                </div>
            @else
                <div class="empty-cart">
                    <div class="empty-cart-icon">🛒</div>
                    <h2>Ваша корзина пуста</h2>
                    <p>Добавьте товары из каталога, чтобы сделать покупки</p>
                    <a href="{{ url('/') }}" class="continue-shopping">
                        🏪 Продолжить покупки
                    </a>
                </div>
            @endif
        </div>

        <!-- Отладочная информация -->
        @if(env('APP_DEBUG'))
        <div class="debug-info">
            <strong>Отладка:</strong><br>
            Переменная $cart: {{ isset($cart) ? 'существует' : 'не существует' }}<br>
            @if(isset($cart))
                Items count: {{ $cart->items->count() }} | 
                Cart ID: {{ $cart->id }} |
                User ID: {{ $cart->user_id }}
            @endif
        </div>
        @endif
    </div>

    <script>
        // Плавная анимация при загрузке
        document.addEventListener('DOMContentLoaded', function() {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>