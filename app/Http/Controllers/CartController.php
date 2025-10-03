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


public function index(Request $request)
{
    if (Auth::check()) {
        // Авторизованный пользователь
        $cart = Cart::with(['items.product'])
            ->firstOrCreate(
                ['user_id' => Auth::id()],
                ['session_id' => $request->session()->getId()]
            );
    } else {
        // Гость
        $cart = Cart::with(['items.product'])
            ->firstOrCreate(
                ['session_id' => $request->session()->getId()]
            );
    }
    dump(Cart::with(['items.product'])
            ->firstOrCreate(['session_id' => $request->session()->getId()]));
    dump($request->session());

    return view('cart.index', compact('cart'));
}
protected function getOrCreateCart(Request $request)
{
    if (Auth::check()) {
            // Для авторизованного пользователя
            return Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['session_id' => $request->session()->getId()]
            );
        }

        // Для гостя (по session_id)
        return Cart::firstOrCreate(
            ['session_id' => $request->session()->getId()]
        );
    }

public function add(Request $request, Product $product)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $cart = $this->getOrCreateCart($request);

    // Проверяем, есть ли уже товар
    $item = $cart->items()->where('product_id', $product->id)->first();

    if ($item) {
        $item->increment('quantity', $request->quantity);
    } else {
        $cart->items()->create([
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
            'price'      => $product->price,
        ]);
    }

    return back()->with('success', 'Товар добавлен в корзину');
}


public function test()
{
    $cart = Cart::with(['items.product'])->where('user_id', 1)->first();
    
    // Проверим что действительно возвращаем view
    $view = view('cart.test', compact('cart'));
    dump($cart);
    dump($view);
    
    // Для отладки
    \Log::info('Returning view with cart', ['cart_id' => $cart->id]);
    
    return $view;
}


public function increase(CartItem $item)
{
    $item->increment('quantity');
    return back();
}

public function decrease(CartItem $item)
{
    if ($item->quantity > 1) {
        $item->decrement('quantity');
    } else {
        // Если количество стало 0 — удаляем товар из корзины
        $item->delete();
    }
    return back();
}


public function update(Request $request, CartItem $item)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $item->update([
        'quantity' => $request->input('quantity')
    ]);

    return back()->with('success', 'Количество обновлено');
}

public function destroy(CartItem $item)
{
    $item->delete();
    return back()->with('success', 'Товар удалён из корзины');
}



  
}