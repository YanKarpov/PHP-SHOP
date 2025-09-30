<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Получить корзину текущего пользователя/сессии
     */
    public function getCart(Request $request): JsonResponse
    {
        try {
            $cart = $this->getOrCreateCart($request);
            $cart->load('items.product');

            return response()->json([
                'success' => true,
                'data' => [
                    'cart' => $cart,
                    'total_price' => $cart->getTotalPrice(),
                    'total_quantity' => $cart->getTotalQuantity(),
                    'items_count' => $cart->items->count(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении корзины'
            ], 500);
        }
    }

    /**
     * Добавить товар в корзину
     */
    public function addItem(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'sometimes|integer|min:1'
            ]);

            $cart = $this->getOrCreateCart($request);
            $product = Product::findOrFail($request->product_id);
            $quantity = $request->input('quantity', 1);

            // Проверяем есть ли товар в корзине
            $existingItem = $cart->items()
                ->where('product_id', $product->id)
                ->first();

            if ($existingItem) {
                $existingItem->increment('quantity', $quantity);
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price
                ]);
            }

            $cart->touch();
            $cart->load('items.product');

            return response()->json([
                'success' => true,
                'message' => 'Товар добавлен в корзину',
                'data' => [
                    'cart' => $cart,
                    'total_price' => $cart->getTotalPrice(),
                    'total_quantity' => $cart->getTotalQuantity(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при добавлении товара'
            ], 500);
        }
    }

    /**
     * Удалить товар из корзины
     */
    public function removeItem(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $cart = $this->getOrCreateCart($request);
            
            $cart->items()
                ->where('product_id', $request->product_id)
                ->delete();

            $cart->touch();
            $cart->load('items.product');

            return response()->json([
                'success' => true,
                'message' => 'Товар удален из корзины',
                'data' => [
                    'cart' => $cart,
                    'total_price' => $cart->getTotalPrice(),
                    'total_quantity' => $cart->getTotalQuantity(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении товара'
            ], 500);
        }
    }

    /**
     * Очистить корзину
     */
    public function clearCart(Request $request): JsonResponse
    {
        try {
            $cart = $this->getOrCreateCart($request);
            $cart->items()->delete();
            $cart->touch();

            return response()->json([
                'success' => true,
                'message' => 'Корзина очищена',
                'data' => [
                    'cart' => $cart,
                    'total_price' => 0,
                    'total_quantity' => 0,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при очистке корзины'
            ], 500);
        }
    }

    /**
     * Вспомогательный метод для получения корзины
     */
    private function getOrCreateCart(Request $request): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            $sessionId = $request->session()->getId();
            return Cart::firstOrCreate(['session_id' => $sessionId]);
        }
    }
}