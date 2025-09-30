<!DOCTYPE html>
<html>
<head>
    <title>Тест корзины</title>
</head>
<body>
    <h1>Тестирование корзины</h1>
    
    <div id="cart-info">
        <p>Загрузка...</p>
    </div>

    <button onclick="addToCart(1)">Добавить iPhone в корзину</button>
    <button onclick="getCart()">Обновить корзину</button>
    <button onclick="clearCart()">Очистить корзину</button>

    <script>
        async function getCart() {
            const response = await fetch('/api/cart');
            const data = await response.json();
            document.getElementById('cart-info').innerHTML = `
                <p>Товаров: ${data.data.total_quantity}</p>
                <p>Общая сумма: ${data.data.total_price}</p>
                <p>Позиций: ${data.data.items_count}</p>
            `;
        }

        async function addToCart(productId) {
            await fetch('/api/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ product_id: productId, quantity: 1 })
            });
            getCart();
        }

        async function clearCart() {
            await fetch('/api/cart/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            getCart();
        }

        // Загружаем корзину при старте
        getCart();
    </script>
</body>
</html>