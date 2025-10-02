<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class AdminStoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        return view('admin.stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:120',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'map_url' => 'nullable|url|max:1024',
            'working_hours' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        Store::create($request->all());

        return redirect()->route('admin.stores.index')->with('success', 'Магазин создан успешно.');
    }

    public function show(Store $store)
    {
        return view('admin.stores.show', compact('store'));
    }

    public function edit(Store $store)
    {
        return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:120',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'map_url' => 'nullable|url|max:1024',
            'working_hours' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $store->update($request->all());

        return redirect()->route('admin.stores.index')->with('success', 'Магазин обновлен успешно.');
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('admin.stores.index')->with('success', 'Магазин удален успешно.');
    }
}
