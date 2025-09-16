<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    // Список всех товаров
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Форма создания товара
    public function create()
    {
        return view('admin.products.create');
    }

    // Сохранение нового товара
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно создан');
    }

    // Просмотр товара
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Форма редактирования товара
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Обновление товара
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно обновлен');
    }

    // Удаление товара
    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успешно удален');
    }
    
    // Переключение статуса товара
    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        
        return back()->with('success', 'Статус товара изменен');
    }
}